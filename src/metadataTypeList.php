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
if (isset($_SESSION['username'])) {
    
    include 'cisLib.php';

    switch ($_GET['dataType']) {
        case "codeLanguages":
            $endPoint = "language";
            break;
        case "applicationOwners":
            $endPoint = "owner";
            break;
        case "lifecycleStages":
            $endPoint = "lifecycleStage";
            break;
        case "applicationTypes":
            $endPoint = "type";
            break;
        case "businessUnits":
            $endPoint = "businessUnit";;
            break;
        case "dataClassifications":
            $endPoint = "dataClassification";
            break;
        case "deploymentEnvironments":
            $endPoint = "deploymentEnvironment";
            break;
        case "riskLevels":
            $endPoint = "riskLevel";
            break;
        case "exposureLevels":
            $endPoint = "exposure";
            break;
        }

    $cis = new cis;

    $cisResponseData = $cis->getCISDataList($endPoint);

    echo json_encode($cisResponseData);

}

?>