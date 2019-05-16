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

    switch ($_GET['dataType']) {
        case "codeLanguages":
            $metaDataType = "codeLanguages";
            $endPoint = "language";
            $endPointId = $_POST['languageId'];
            $payload = array('id' => $_POST['languageId'], 'languageName' => $_POST['languageName']);
            $messageLabel = "Code Language";
            break;
        case "applicationOwners":
            $metaDataType = "applicationOwners";
            $endPoint = "owner";
            $endPointId = $_POST['ownerId'];
            $payload = array('id' => $_POST['ownerId'], 'ownerName' => $_POST['ownerName']);
            $messageLabel = "Application Owner";
            break;
        case "lifecycleStages":
            $metaDataType = "lifecycleStages";
            $endPoint = "lifecycleStage";
            $endPointId = $_POST['lifecycleStageId'];
            $payload = array('id' => $_POST['lifecycleStageId'], 'lifecycleStageName' => $_POST['lifecycleStageName']);
            $messageLabel = "Lifecycle Stage";
            break;
        case "applicationTypes":
            $metaDataType = "applicationTypes";
            $endPoint = "type";
            $endPointId = $_POST['typeId'];
            $payload = array('id' => $_POST['typeId'], 'typeName' => $_POST['typeName']);
            $messageLabel = "Application Type";
            break;
        case "businessUnits":
            $metaDataType = "businessUnits";
            $endPoint = "businessUnit";
            $endPointId = $_POST['buId'];
            $payload = array('id' => $_POST['buId'], 'businessUnitName' => $_POST['businessUnitName']);
            $messageLabel = "Business Unit";
            break;
        case "dataClassifications":
            $metaDataType = "dataClassifications";
            $endPoint = "dataClassification";
            $endPointId = $_POST['dataClassificationId'];
            $payload = array('id' => $_POST['dataClassificationId'], 'dataClassificationName' => $_POST['dataClassificationName']);
            $messageLabel = "Data Classification";
            break;
        case "deploymentEnvironments":
            $metaDataType = "deploymentEnvironments";
            $endPoint = "deploymentEnvironment";
            $endPointId = $_POST['deploymentEnvironmentId'];
            $payload = array('id' => $_POST['deploymentEnvironmentId'], 'deploymentEnvironmentName' => $_POST['deploymentEnvironmentName']);
            $messageLabel = "Deployment Environment";
            break;
        case "riskLevels":
            $metaDataType = "riskLevels";
            $endPoint = "riskLevel";
            $endPointId = $_POST['riskLevelId'];
            $payload = array('id' => $_POST['riskLevelId'], 'riskLevelName' => $_POST['riskLevelName']);
            $messageLabel = "Risk Level";
            break;
        case "exposureLevels":
            $metaDataType = "exposureLevels";
            $endPoint = "exposure";
            $endPointId = $_POST['exposureId'];
            $payload = array('id' => $_POST['exposureId'], 'exposureName' => $_POST['exposureLevelName']);
            $messageLabel = "Exposure Level";
            break;
        }

        $jsonPayload = json_encode($payload);

        $cisResponseCode = $cis->updateCISDataRecord($endPoint, $endPointId, $jsonPayload);

        if ($cisResponseCode === 200) {
            echo '<script type="text/javascript">location.href = \'admin.php?tab=metadata&dataType='.$metaDataType.'\';</script>';
        }
        else {
            echo "failure editing ".$messageLabel;
        }

}
else {
    echo "failure editing ".$messageLabel;
}

?>
