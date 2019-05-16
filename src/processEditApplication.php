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

    $payload = array(
        'id' => $_POST['appId'],
        'commonName' => $_POST['commonName'],
        'primaryOwnerId' => $_POST['primaryOwnerId'],
        'businessUnitId' => $_POST['businessUnitId'],
        'primaryLanguageId' => $_POST['primaryLanguageId'],
        'aliases' => $_POST['aliases'],
        'description' => $_POST['description'],
        'codeRepoUrl' => $_POST['codeRepoUrl'],
        'binaryRepoUrl' => $_POST['binaryRepoUrl'],
        'secondaryLanguages' => $_POST['secondaryLanguages'],
        'typeId' => $_POST['typeId'],
        'secondaryOwners' => $_POST['secondaryOwners'],
        'exposureId' => $_POST['exposureId'],
        'numUsers' => $_POST['numUsers'],
        'dataClassificationId' => $_POST['dataClassificationId'],
        'deploymentEnvironmentId' => $_POST['deploymentEnvironmentId'],
        'deploymentEnvironmentUrl' => $_POST['deploymentEnvironmentUrl'],
        'riskLevelId' => $_POST['riskLevelId'],
        'regulations' => $_POST['regulations'],
        'chatChannel' => $_POST['chatChannel'],
        'agileScrumBoardUrl' => $_POST['agileScrumBoardUrl'],
        'buildServerUrl' => $_POST['buildServerUrl'],
        'age' => $_POST['age'],
        'lifecycleStageId' => $_POST['lifecycleStageId']
    );

    $jsonPayload = json_encode($payload);

    $cisResponseCode = $cis->updateCISDataRecord('application', $_POST['appId'], $jsonPayload);

    if ($cisResponseCode === 200) {
        echo '<script type="text/javascript">location.href = \'applications.php\';</script>';
    }
    else {
        echo "failure editing application";
    }

}
else {
    echo "failure editing application";
}

?>
