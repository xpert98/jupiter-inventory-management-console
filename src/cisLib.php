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

class cis {

    function getCISConnectionInfo() {

        include 'db.php';

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $cisUrlResult = pg_prepare($conn, "getcisurl", 'select settingvalue from config where settingname=$1');
        $cisUrlResult = pg_execute($conn, "getcisurl", array('CIS_URL'));
        $cisUrlResultError = pg_result_error($cisUrlResult);

        $cisUrlRow = pg_fetch_assoc($cisUrlResult);

        $cisBaseUrl = $cisUrlRow['settingvalue'];

        $cisTokenResult = pg_prepare($conn, "getcistoken", 'select settingvalue from config where settingname=$1');
        $cisTokenResult = pg_execute($conn, "getcistoken", array('CIS_TOKEN'));
        $cisTokenResultError = pg_result_error($cisTokenResult);

        $cisTokenRow = pg_fetch_assoc($cisTokenResult);

        $cisToken = $cisTokenRow['settingvalue'];

        pg_close($conn);

        return array('cisBaseUrl' => $cisBaseUrl, 'cisToken' => $cisToken);

    }

    function getCISDataList($endPoint) {

        $cisConnectionInfo = $this->getCISConnectionInfo();

        $curatedInventorySvcUrl = $cisConnectionInfo['cisBaseUrl'].'/'.$endPoint.'/list';

        $ch = curl_init($curatedInventorySvcUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$cisConnectionInfo['cisToken']
        ));

        $data = curl_exec($ch);
        curl_close($ch);

        $decoded = json_decode($data,true);
    
        $ra = array();
    
        foreach($decoded['result'] as $elem) {
            array_push($ra, $elem);
        }

        return $ra;

    }

    function getCISDataById($endPoint, $endPointId) {

        $cisConnectionInfo = $this->getCISConnectionInfo();

        $curatedInventorySvcUrl = $cisConnectionInfo['cisBaseUrl'].'/'.$endPoint.'/'.$endPointId;

        $ch = curl_init($curatedInventorySvcUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$cisConnectionInfo['cisToken']
        ));

        $data = curl_exec($ch);
        curl_close($ch);

        $decoded = json_decode($data,true);
    
        $ra = array();
    
        foreach($decoded['result'] as $elem) {
            array_push($ra, $elem);
        }

        return $ra;

    }

    function deleteCISDataById($endPoint, $endPointId) {

        $cisConnectionInfo = $this->getCISConnectionInfo();

        $curatedInventorySvcUrl = $cisConnectionInfo['cisBaseUrl'].'/'.$endPoint.'/'.$endPointId;

        $ch = curl_init($curatedInventorySvcUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$cisConnectionInfo['cisToken']
        ));
        $data = curl_exec($ch);
    
        $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        curl_close($ch);

        return $httpResponseCode;

    }

    function createCISDataRecord($endPoint, $payload) {

        $cisConnectionInfo = $this->getCISConnectionInfo();

        $curatedInventorySvcUrl = $cisConnectionInfo['cisBaseUrl'].'/'.$endPoint.'/create';

        $ch = curl_init($curatedInventorySvcUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$cisConnectionInfo['cisToken']
        ));
        $data = curl_exec($ch);

        $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $httpResponseCode;
    }

    function updateCISDataRecord($endPoint, $endPointId, $payload) {

        $cisConnectionInfo = $this->getCISConnectionInfo();

        $curatedInventorySvcUrl = $cisConnectionInfo['cisBaseUrl'].'/'.$endPoint.'/'.$endPointId;

        $ch = curl_init($curatedInventorySvcUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$cisConnectionInfo['cisToken']
        ));
        $data = curl_exec($ch);

        $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $httpResponseCode;

    }

}

?>