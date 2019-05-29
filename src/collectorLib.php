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

class collector {

    function getCollectorList() {

        include 'db.php';
        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $collectorResult = pg_prepare($conn, "getcollectorlist", 'select * from collector');
        $collectorResult = pg_execute($conn, "getcollectorlist", array());
        $collectorResultError = pg_result_error($collectorResult);

        $numCollectors = pg_numrows($collectorResult);

        $collectorDetails = array();
        while ($row = pg_fetch_assoc($collectorResult)) {
            $collectorDetails = array('id' => $row['id'], 'url' => $row['url'], 'primary' => $row['primarycollector']);
        }

        pg_close($conn);        

        return array($collectorDetails);


    }

    function getPrimaryCollectorConnectionInfo() {

        include 'db.php';

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $collectorResult = pg_prepare($conn, "getcollectorinfo", 'select url, apitoken from collector where primarycollector = true');
        $collectorResult = pg_execute($conn, "getcollectorinfo", array());
        $collectorResultError = pg_result_error($collectorResult);
    
        $collectorRow = pg_fetch_assoc($collectorResult);

        $collectorBaseUrl = $collectorRow['url'];
        $apiToken = $collectorRow['apitoken'];

        pg_close($conn);

        return array('collectorBaseUrl' => $collectorBaseUrl, 'apiToken' => $apiToken);

    }

    function validateNewCollector($collectorUrl, $collectorToken) {

        $collectorUrl = $_POST["collectorUrl"] . "/inventoryItem";

        $ch = curl_init($collectorUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$collectorToken
        ));
        
        $collectorInstanceData = curl_exec($ch);

        curl_close($ch);

        return $collectorInstanceData;

    }

    function createCollector($collectorInstanceData, $collectorUrl, $apiToken) {

        include 'db.php';
        $decodedInstanceData = json_decode($collectorInstanceData);
        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $insertResult = pg_prepare($conn, "addcollector", 'insert into collector (id, apitoken, url) values ($1, $2, $3)');
        $insertResult = pg_execute($conn, "addcollector", array($decodedInstanceData->{'instanceId'}, $apiToken, $collectorUrl));
        $insertResultError = pg_result_error($insertResult);
        
        return $insertResultError;

        pg_close($conn);

    }

    function deleteAntecessor($antecessorId) {

        $collectorConnectionInfo = $this->getPrimaryCollectorConnectionInfo();
    
        $collectorUrl = $collectorConnectionInfo['collectorBaseUrl'].'/inventoryItem/'.$antecessorId.'/delete';
        $ch = curl_init($collectorUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$collectorConnectionInfo['apiToken']
        ));
        $data = curl_exec($ch);
    
        $responseCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    
        curl_close($ch);

        return $responseCode;

    }

    function getAntecessorList() {

        $collectorConnectionInfo = $this->getPrimaryCollectorConnectionInfo();

        $collectorUrl = $collectorConnectionInfo['collectorBaseUrl'].'/inventoryItem/list';
        $ch = curl_init($collectorUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$collectorConnectionInfo['apiToken']
        ));

        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;

    }

    function getCISDataById($antecessorId) {

        $collectorConnectionInfo = $this->getPrimaryCollectorConnectionInfo();

        $collectorUrl = $collectorConnectionInfo['collectorBaseUrl'].'/inventoryItem/'.$antecessorId;
        $ch = curl_init($collectorUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$collectorConnectionInfo['apiToken']
        ));

        $data = curl_exec($ch);
        
        curl_close($ch);

        return $data;

    }

}

?>