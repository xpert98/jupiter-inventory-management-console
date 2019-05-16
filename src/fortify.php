<?php

/*
Jupiter Inventory Management Console
Copyright (C) 2019 Matt Stanchek

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

class fortify {

    function getSSCUrl() {

        include 'db.php';

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $sscUrlResult = pg_prepare($conn, "getsscurl", 'select settingvalue from config where settingname=$1');
        $sscUrlResult = pg_execute($conn, "getsscurl", array('FORTIFY_URL'));
        $sscUrlResultError = pg_result_error($sscUrlResult);

        $sscUrlRow = pg_fetch_assoc($sscUrlResult);

        $sscBaseUrl = $sscUrlRow['settingvalue'];

        pg_close($conn);

        return $sscBaseUrl;

    }

    function updateSSCInfo($sscUrl, $sscUser, $sscPassword) {

        include 'db.php';

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");

        $updateUrlResult = pg_prepare($conn, "updatefortifyurl", 'update config set settingvalue = $1 where settingname= $2');
        $updateUrlResult = pg_execute($conn, "updatefortifyurl", array($sscUrl, "FORTIFY_URL"));
        $updateUrlResultError = pg_result_error($updateUrlResult);

        $updateUserResult = pg_prepare($conn, "updatefortifyuser", 'update config set settingvalue = $1 where settingname= $2');
        $updateUserResult = pg_execute($conn, "updatefortifyuser", array($sscUser, "FORTIFY_USERNAME"));
        $updateUserResultError = pg_result_error($updateUserResult);

        $updatePasswordResultError = '';
        if (!empty($sscPassword)) {

            include 'secret.php';

            $secret = new secret;

            $sscPasswordEnc = $secret->encryptString($sscPassword);

            $updatePasswordResult = pg_prepare($conn, "updatefortifypassword", 'update config set settingvalue = $1 where settingname= $2');
            $updatePasswordResult = pg_execute($conn, "updatefortifypassword", array($sscPasswordEnc, "FORTIFY_PASSWORD"));
            $updatePasswordResultError = pg_result_error($updateUserResult);
        }

        pg_close($conn);

        $status = '';
        if (empty($updateUrlResultError) || empty($updateUserResultError)) {
            if (empty($sscPassword)) {
                if (empty($updatePasswordResultError)) {
                    $status = "success";
                }
                else {
                    $status = "failure";
                }
            }
            else {
                $status = "success";
            }
        }
        else {
            $status = "failure";
        }

        return $status;

    }

    function getSSCUserCreds() {

        include 'db.php';

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");

        $sscUserResult = pg_prepare($conn, "getsscuser", 'select settingvalue from config where settingname=$1');
        $sscUserResult = pg_execute($conn, "getsscuser", array('FORTIFY_USERNAME'));
        $sscUserResultError = pg_result_error($sscUserResult);

        $sscUserRow = pg_fetch_assoc($sscUserResult);

        $sscUser = $sscUserRow['settingvalue'];

        $sscPasswordResult = pg_prepare($conn, "getsscpassword", 'select settingvalue from config where settingname=$1');
        $sscPasswordResult = pg_execute($conn, "getsscpassword", array('FORTIFY_PASSWORD'));
        $sscPasswordResultError = pg_result_error($sscPasswordResult);

        $sscPasswordRow = pg_fetch_assoc($sscPasswordResult);

        $sscPassword = $sscPasswordRow['settingvalue'];

        include 'secret.php';

        $secret = new secret;

        $sscPasswordDec = $secret->decryptString($sscPassword);

        pg_close($conn);

        return array('sscUser' => $sscUser, 'sscPassword' => $sscPasswordDec);

    }

    function getSSCAuthToken() {

        $fortifySSCBaseUrl = $this->getSSCUrl();
        $fortifySSCUrl = $fortifySSCBaseUrl.'/api/v1/tokens';

        $fortifySSCUser = $this->getSSCUserCreds();

        $creds = base64_encode($fortifySSCUser['sscUser'].':'.$fortifySSCUser['sscPassword']);

        $payload = json_encode(array('type' => 'UnifiedLoginToken'));
        
        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic '.$creds
        ));
        
        $data = curl_exec($ch);
        
        curl_close($ch);

        $sscAuthData = json_decode($data,true);

        $ra = array();

        foreach($sscAuthData['data'] as $chunk) {
            array_push($ra, $chunk);
        }

        $_SESSION['fortifyAuthToken'] = $ra[6];

    }

    function getSSCProjects() {

        if (!isset($_SESSION['fortifyAuthToken'])) {
            $this->getSSCAuthToken();
        }

        $fortifySSCBaseUrl = $this->getSSCUrl();

        $fortifySSCUrl = $fortifySSCBaseUrl."/api/v1/projects";

        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: FortifyToken '.$_SESSION['fortifyAuthToken']
        ));

        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;

    }

    function createNewProjectVersion($projName, $projVerName, $description, $issueTemplate) {

        if (!isset($_SESSION['fortifyAuthToken'])) {
            $this->getSSCAuthToken();
        }

        $fortifySSCBaseUrl = $this->getSSCUrl();

        $fortifySSCUrl = $fortifySSCBaseUrl."/api/v1/projectVersions";
        
        $newProject = array(
            "name" => $projVerName,
            "description" => $description,
            "active" => true,
            "committed" => false,
            "project" => array(
                "name" => $projName,
                "description" => $description,
                "issueTemplateId" => $issueTemplate
            ),
            "issueTemplateId" => $issueTemplate
        );

        $payload = json_encode($newProject);
        
        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: FortifyToken '.$_SESSION['fortifyAuthToken']
        ));
        
        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;
    }

    function setProjectVersionAttrs($projectVersionId, $accessibility, $businessRisk, $developmentPhase, $developmentStrategy) {

        $attributes = array(
            array(
                "attributeDefinitionId" => 5, 
                "values" => array(
                    array("guid" => $developmentPhase)
                )
            ),
            array(
                "attributeDefinitionId" => 6, 
                "values" => array(
                    array("guid" => $developmentStrategy)
                )
            ),
            array(
                "attributeDefinitionId" => 7, 
                "values" => array(
                    array("guid" => $accessibility)
                )
            ),
            array(
                "attributeDefinitionId" => 1, 
                "values" => array(
                    array("guid" => $businessRisk)
                )
            )
        );

        $attrPayload = json_encode($attributes);

        if (!isset($_SESSION['fortifyAuthToken'])) {
            $this->getSSCAuthToken();
        }

        $fortifySSCBaseUrl = $this->getSSCUrl();

        $fortifySSCUrl = $fortifySSCBaseUrl."/api/v1/projectVersions/".$projectVersionId.'/attributes';
        
        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $attrPayload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: FortifyToken '.$_SESSION['fortifyAuthToken']
        ));
        $data = curl_exec($ch);

        $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $httpResponseCode;

    }

    function commitProjectVersion($projectVersionId) {

        if (!isset($_SESSION['fortifyAuthToken'])) {
            $this->getSSCAuthToken();
        }

        $fortifySSCBaseUrl = $this->getSSCUrl();

        $fortifySSCUrl = $fortifySSCBaseUrl."/api/v1/projectVersions/".$projectVersionId;

        $payload = array("committed" => true);

        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: FortifyToken '.$_SESSION['fortifyAuthToken']
        ));
        $data = curl_exec($ch);

        $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $httpResponseCode;

    }

    function getAttributeDefinitions() {

        if (!isset($_SESSION['fortifyAuthToken'])) {
            $this->getSSCAuthToken();
        }

        $fortifySSCBaseUrl = $this->getSSCUrl();

        $fortifySSCUrl = $fortifySSCBaseUrl."/api/v1/attributeDefinitions?start=0&limit=200";

        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: FortifyToken '.$_SESSION['fortifyAuthToken']
        ));
        
        $attributeDefinitions = curl_exec($ch);

        curl_close($ch);

        return $attributeDefinitions;

    }


    function getIssueTemplates() {

        if (!isset($_SESSION['fortifyAuthToken'])) {
            $this->getSSCAuthToken();
        }

        $fortifySSCBaseUrl = $this->getSSCUrl();

        $fortifySSCUrl = $fortifySSCBaseUrl."/api/v1/issueTemplates?start=0&limit=200";

        $ch = curl_init($fortifySSCUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: FortifyToken '.$_SESSION['fortifyAuthToken']
        ));
        
        $issueTemplateData = curl_exec($ch);

        curl_close($ch);

        return $issueTemplateData;

    }

}

?>