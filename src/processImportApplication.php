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

session_start();

if (!empty($_POST)) {

    include 'cisLib.php';

    $cis = new cis;

    $primaryLanguageId = 0;
    if (!empty($_POST['primaryLanguageId'])) {
        $primaryLanguageId = (int)$_POST['primaryLanguageId'];
    }

    $businessUnitId = 0;
    if (!empty($_POST['businessUnitId'])) {
        $businessUnitId = (int)$_POST['businessUnitId'];
    }

    $typeId = 0;
    if (!empty($_POST['typeId'])) {
        $typeId = (int)$_POST['typeId'];
    }

    $exposureId = 0;
    if (!empty($_POST['exposureId'])) {
        $exposureId = (int)$_POST['exposureId'];
    }

    $dataClassificationId = 0;
    if (!empty($_POST['dataClassificationId'])) {
        $dataClassificationId = (int)$_POST['dataClassificationId'];
    }

    $deploymentEnvironmentId = 0;
    if (!empty($_POST['deploymentEnvironmentId'])) {
        $deploymentEnvironmentId = (int)$_POST['deploymentEnvironmentId'];
    }

    $riskLevelId = 0;
    if (!empty($_POST['riskLevelId'])) {
        $riskLevelId = (int)$_POST['riskLevelId'];
    }

    $lifecycleStageId = 0;
    if (!empty($_POST['lifecycleStageId'])) {
        $lifecycleStageId = (int)$_POST['lifecycleStageId'];
    }

    $numUsers = 0;
    if (!empty($_POST['numUsers'])) {
        $numUsers = (int)$_POST['numUsers'];
    }

    $age = 0;
    if (!empty($_POST['age'])) {
        $age = (int)$_POST['age'];
    }

    $payload = array(
        'commonName' => $_POST['commonName'],
        'primaryOwnerId' => $_POST['primaryOwnerId'],
        'businessUnitId' => $businessUnitId,
        'primaryLanguageId' => $primaryLanguageId,
        'aliases' => $_POST['aliases'],
        'description' => $_POST['description'],
        'codeRepoUrl' => $_POST['codeRepoUrl'],
        'binaryRepoUrl' => $_POST['binaryRepoUrl'],
        'secondaryLanguages' => $_POST['secondaryLanguages'],
        'typeId' => $typeId,
        'secondaryOwners' => $_POST['secondaryOwners'],
        'exposureId' => $exposureId,
        'numUsers' => $numUsers,
        'dataClassificationId' => $dataClassificationId,
        'deploymentEnvironmentId' => $deploymentEnvironmentId,
        'deploymentEnvironmentUrl' => $_POST['deploymentEnvironmentUrl'],
        'riskLevelId' => $riskLevelId,
        'regulations' => $_POST['regulations'],
        'chatChannel' => $_POST['chatChannel'],
        'agileScrumBoardUrl' => $_POST['agileScrumBoardUrl'],
        'buildServerUrl' => $_POST['buildServerUrl'],
        'age' => $age,
        'lifecycleStageId' => $lifecycleStageId
    );

    $jsonPayload = json_encode($payload);

    $cisResponseCode = $cis->createCISDataRecord('application', $jsonPayload);

    if ($cisResponseCode === 200) {
        echo '<script type="text/javascript">location.href = \'applications.php\';</script>';
    }
    else {
        echo "failure adding application";
    }

}
else {
    echo "failure adding application";
}

?>
