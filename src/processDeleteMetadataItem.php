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

include 'header.php';

if (isset($_SESSION['username'])) {

    include 'cisLib.php';

    $cis = new cis;

    switch ($_GET['dataType']) {
        case "codeLanguages":
            $metaDataType = "codeLanguages";
            $endPoint = "language";
            $endPointId = $_POST['languageId'];
            $modalLabel = "Code Language";
            break;
        case "applicationOwners":
            $metaDataType = "applicationOwners";
            $endPoint = "owner";
            $endPointId = $_POST['ownerId'];
            $modalLabel = "Application Owner";
            break;
        case "lifecycleStages":
            $metaDataType = "lifecycleStages";
            $endPoint = "lifecycleStage";
            $endPointId = $_POST['lifecycleStageId'];
            $modalLabel = "Lifecycle Stage";
            break;
        case "applicationTypes":
            $metaDataType = "applicationTypes";
            $endPoint = "type";
            $endPointId = $_POST['typeId'];
            $modalLabel = "Application Type";
            break;
        case "businessUnits":
            $metaDataType = "businessUnits";
            $endPoint = "businessUnit";
            $endPointId = $_POST['buId'];
            $modalLabel = "Business Unit";
            break;
        case "dataClassifications":
            $metaDataType = "dataClassifications";
            $endPoint = "dataClassification";
            $endPointId = $_POST['dataClassificationId'];
            $modalLabel = "Data Classification";
            break;
        case "deploymentEnvironments":
            $metaDataType = "deploymentEnvironments";
            $endPoint = "deploymentEnvironment";
            $endPointId = $_POST['deploymentEnvironmentId'];
            $modalLabel = "Deployment Environment";
            break;
        case "riskLevels":
            $metaDataType = "riskLevels";
            $endPoint = "riskLevel";
            $endPointId = $_POST['riskLevelId'];
            $modalLabel = "Risk Level";
            break;
        case "exposureLevels":
            $metaDataType = "exposureLevels";
            $endPoint = "exposure";
            $endPointId = $_POST['exposureId'];
            $modalLabel = "Exposure Level";
            break;
        }

    $cisResponseCode = $cis->deleteCISDataById($endPoint, $endPointId);
    
    
?>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><?php echo $modalLabel; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <?php
            if ($cisResponseCode === 200) {
                echo '<div class="alert alert-success" role="alert">'.$modalLabel.' deleted successfully!</div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">'.$modalLabel.' delete failed.  Error #8002</div>'; 
            }
            ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href = 'admin.php?tab=metadata&dataType=<?php echo $metaDataType; ?>';">Close</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#deleteModal').modal('show');
    });
</script>

<?php
}
include 'footer.php';
?>