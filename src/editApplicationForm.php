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

$currentPage = "applications";
include 'header.php';

if (isset($_SESSION['username'])) {

    if (isset($_GET['appId'])) {

        $appId = htmlentities($_GET["appId"], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        include 'cisLib.php';

        $cis = new cis;

        $applicationData = $cis->getCISDataById('application', $_GET['appId']);

        $ownerListData = $cis->getCISDataList('owner');

        $businessUnitListData = $cis->getCISDataList('businessUnit');

        $codeLanguageListData = $cis->getCISDataList('language');

        $applicationTypeListData = $cis->getCISDataList('type');

        $exposureLevelListData = $cis->getCISDataList('exposure');

        $dataClassificationListData = $cis->getCISDataList('dataClassification');

        $deploymentEnvironmentListData = $cis->getCISDataList('deploymentEnvironment');

        $riskLevelListData = $cis->getCISDataList('riskLevel');

        $lifecycleStageListData = $cis->getCISDataList('lifecycleStage');

        echo '<script>';
        echo 'var ownerData = '.json_encode($ownerListData).';';
        echo 'var businessUnitData = '.json_encode($businessUnitListData).';';
        echo 'var codeLanguageData = '.json_encode($codeLanguageListData).';';
        echo 'var applicationTypeData = '.json_encode($applicationTypeListData).';';
        echo 'var exposureLevelData = '.json_encode($exposureLevelListData).';';
        echo 'var dataClassificationData = '.json_encode($dataClassificationListData).';';
        echo 'var deploymentEnvironmentData = '.json_encode($deploymentEnvironmentListData).';';
        echo 'var riskLevelData = '.json_encode($riskLevelListData).';';
        echo 'var lifecycleStageData = '.json_encode($lifecycleStageListData).';';
        echo '</script>';

    }

?>
<h1><i class="fas fa-cube"></i> Edit Application</h1>

<div class="container">


    <div class="row" style="margin-bottom: 30px;">

        <div class="col">

        <form action="processEditApplication.php" method="POST">


                <div class="form-group">
                    <label for="appId">Application ID</label>
                    <div><?php echo $applicationData[0]['id']; ?></div>
                    <input type="hidden" id="appId" name="appId" value="<?php echo $applicationData[0]['id']; ?>">
                </div>

                <div class="form-group">
                    <label for="commonName">Common Name</label>
                    <input type="text" class="form-control" id="commonName" name="commonName" value="<?php echo $applicationData[0]['commonname']; ?>" required>
                    
                </div>

                <div class="form-group">
                    <label for="primaryOwnerId">Primary Owner</label>
                    <input type="hidden" id="currentPrimaryOwnerId" value="<?php echo $applicationData[0]['primaryownerid']; ?>">
                    <select class="custom-select" id="primaryOwnerId" name="primaryOwnerId"><option></option></select>
                </div>

                <div class="form-group">
                    <label for="secondaryOwners">Secondary Owner(s)</label>
                    <input type="text" class="form-control" id="secondaryOwners" name="secondaryOwners" value="<?php echo $applicationData[0]['secondaryowners']; ?>">
                </div>

                <div class="form-group">
                    <label for="aliases">Aliases</label>
                    <textarea class="form-control" id="aliases" name="aliases" rows="2"><?php echo $applicationData[0]['aliases']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $applicationData[0]['description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="codeRepoUrl">Code Repo URL</label>
                    <input type="text" class="form-control" id="codeRepoUrl" name="codeRepoUrl" value="<?php echo $applicationData[0]['coderepourl']; ?>">
                </div>
                <div class="form-group">
                    <label for="binaryRepoUrl">Binary Repo URL</label>
                    <input type="text" class="form-control" id="binaryRepoUrl" name="binaryRepoUrl" value="<?php echo $applicationData[0]['binaryrepourl']; ?>">
                </div>

                <div class="form-group">
                    <label for="primaryLanguageId">Primary Language</label>
                    <input type="hidden" id="currentPrimaryLanguageId" value="<?php echo $applicationData[0]['primarylanguageid']; ?>">
                    <select class="custom-select" id="primaryLanguageId" name="primaryLanguageId"><option></option></select>
                </div>
                <div class="form-group">
                    <label for="secondaryLanguages">Secondary Languages</label>
                    <textarea class="form-control" id="secondaryLanguages" name="secondaryLanguages" rows="2"><?php echo $applicationData[0]['secondarylanguages']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="typeId">Application Type</label>
                    <input type="hidden" id="currentTypeId" value="<?php echo $applicationData[0]['typeid']; ?>">
                    <select class="custom-select" id="typeId" name="typeId"><option></option></select>
                </div>

                <div class="form-group">
                    <label for="businessUnitId">Business Unit</label>
                    <input type="hidden" id="currentBusinessUnitId" value="<?php echo $applicationData[0]['businessunitid']; ?>">
                    <select class="custom-select" id="businessUnitId" name="businessUnitId"><option></option></select>
                </div>
                <div class="form-group">
                    <label for="exposureId">Exposure Level</label>
                    <input type="hidden" id="currentExposureId" value="<?php echo $applicationData[0]['exposureid']; ?>">
                    <select class="custom-select" id="exposureId" name="exposureId"><option></option></select>
                </div>
                <div class="form-group">
                    <label for="numUsers">Number of Users</label>
                    <input type="text" class="form-control" id="numUsers" name="numUsers" value="<?php echo $applicationData[0]['numusers']; ?>">
                </div>
                <div class="form-group">
                    <label for="dataClassification">Data Classification</label>
                    <input type="hidden" id="currentDataClassificationId" value="<?php echo $applicationData[0]['dataclassificationid']; ?>">
                    <select class="custom-select" id="dataClassificationId" name="dataClassificationId"><option></option></select>
                </div>
                <div class="form-group">
                    <label for="deploymentEnvironmentId">Deployment Environment</label>
                    <input type="hidden" id="currentDeploymentEnvironmentId" value="<?php echo $applicationData[0]['deploymentenvironmentid']; ?>">
                    <select class="custom-select" id="deploymentEnvironmentId" name="deploymentEnvironmentId"><option></option></select>
                </div>
                <div class="form-group">
                    <label for="deploymentEnvironmentUrl">Deployment Environment URL</label>
                    <input type="text" class="form-control" id="deploymentEnvironmentUrl" name="deploymentEnvironmentUrl" value="<?php echo $applicationData[0]['deploymentenvironmenturl']; ?>">
                </div>
                <div class="form-group">
                    <label for="riskLevel">Risk Level</label>
                    <input type="hidden" id="currentRiskLevelId" value="<?php echo $applicationData[0]['risklevelid']; ?>">
                    <select class="custom-select" id="riskLevelId" name="riskLevelId"><option></option></select>
                </div>
                <div class="form-group">
                    <label for="regulations">Regulations</label>
                    <input type="text" class="form-control" id="regulations" name="regulations" value="<?php echo $applicationData[0]['regulations']; ?>">
                </div>
                <div class="form-group">
                    <label for="chatChannel">Chat Channel</label>
                    <input type="text" class="form-control" id="chatChannel" name="chatChannel" value="<?php echo $applicationData[0]['chatchannel']; ?>">
                </div>
                <div class="form-group">
                    <label for="agileScrumBoardUrl">Agile Scrum Board URL</label>
                    <input type="text" class="form-control" id="agileScrumBoardUrl" name="agileScrumBoardUrl" value="<?php echo $applicationData[0]['agilescrumboardurl']; ?>">
                </div>
                <div class="form-group">
                    <label for="buildServerUrl">Build Server URL</label>
                    <input type="text" class="form-control" id="buildServerUrl" name="buildServerUrl" value="<?php echo $applicationData[0]['buildserverurl']; ?>">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $applicationData[0]['age']; ?>">
                </div>
                <div class="form-group">
                    <label for="lifecycleStage">Lifecycle Stage</label>
                    <input type="hidden" id="currentLifecycleStageId" value="<?php echo $applicationData[0]['lifecyclestageid']; ?>">
                    <select class="custom-select" id="lifecycleStageId" name="lifecycleStageId"><option></option></select>
                </div>
                <input type="hidden" id="appId" name="appId" value="<?php echo $appId; ?>">

                <button type="submit" class="btn btn-primary">Save Application Record</button>

        </form>

    </div>
</div>

<script>
for (i in ownerData) {
    if($("#currentPrimaryOwnerId").val() == ownerData[i].id) {
        $("#primaryOwnerId").append('<option value="'+ownerData[i].id+'" selected>'+ownerData[i].ownername+'</option>');
    }
    else {
        $("#primaryOwnerId").append('<option value="'+ownerData[i].id+'">'+ownerData[i].ownername+'</option>');
    }
}
for (i in businessUnitData) {
    if($("#currentBusinessUnitId").val() == businessUnitData[i].id) {
        $("#businessUnitId").append('<option value="'+businessUnitData[i].id+'" selected>'+businessUnitData[i].businessunitname+'</option>');
    }
    else {
        $("#businessUnitId").append('<option value="'+businessUnitData[i].id+'">'+businessUnitData[i].businessunitname+'</option>');
    }
}
for (i in codeLanguageData) {
    if($("#currentPrimaryLanguageId").val() == codeLanguageData[i].id) {
        $("#primaryLanguageId").append('<option value="'+codeLanguageData[i].id+'" selected>'+codeLanguageData[i].languagename+'</option>');
    }
    else {
        $("#primaryLanguageId").append('<option value="'+codeLanguageData[i].id+'">'+codeLanguageData[i].languagename+'</option>');
    }
}
for (i in applicationTypeData) {
    if($("#currentTypeId").val() == applicationTypeData[i].id) {
        $("#typeId").append('<option value="'+applicationTypeData[i].id+'" selected>'+applicationTypeData[i].typename+'</option>');
    }
    else {
        $("#typeId").append('<option value="'+applicationTypeData[i].id+'">'+applicationTypeData[i].typename+'</option>');
    }
}
for (i in exposureLevelData) {
    if($("#currentExposureId").val() == exposureLevelData[i].id) {
        $("#exposureId").append('<option value="'+exposureLevelData[i].id+'" selected>'+exposureLevelData[i].exposurename+'</option>');
    }
    else {
        $("#exposureId").append('<option value="'+exposureLevelData[i].id+'">'+exposureLevelData[i].exposurename+'</option>');
    }
}
for (i in dataClassificationData) {
    if($("#currentDataClassificationId").val() == dataClassificationData[i].id) {
        $("#dataClassificationId").append('<option value="'+dataClassificationData[i].id+'" selected>'+dataClassificationData[i].dataclassificationname+'</option>');
    }
    else {
        $("#dataClassificationId").append('<option value="'+dataClassificationData[i].id+'">'+dataClassificationData[i].dataclassificationname+'</option>');
    }
}
for (i in deploymentEnvironmentData) {
    if($("#currentDeploymentEnvironmentId").val() == deploymentEnvironmentData[i].id) {
        $("#deploymentEnvironmentId").append('<option value="'+deploymentEnvironmentData[i].id+'" selected>'+deploymentEnvironmentData[i].deploymentenvironmentname+'</option>');
    }
    else {
        $("#deploymentEnvironmentId").append('<option value="'+deploymentEnvironmentData[i].id+'">'+deploymentEnvironmentData[i].deploymentenvironmentname+'</option>');
    }
}
for (i in riskLevelData) {
    if($("#currentRiskLevelId").val() == riskLevelData[i].id) {
        $("#riskLevelId").append('<option value="'+riskLevelData[i].id+'" selected>'+riskLevelData[i].risklevelname+'</option>');
    }
    else {
        $("#riskLevelId").append('<option value="'+riskLevelData[i].id+'">'+riskLevelData[i].risklevelname+'</option>');
    }
}
for (i in lifecycleStageData) {
    if($("#currentLifecycleStageId").val() == lifecycleStageData[i].id) {
        $("#lifecycleStageId").append('<option value="'+lifecycleStageData[i].id+'" selected>'+lifecycleStageData[i].lifecyclestagename+'</option>');
    }
    else {
        $("#lifecycleStageId").append('<option value="'+lifecycleStageData[i].id+'">'+lifecycleStageData[i].lifecyclestagename+'</option>');
    }
}
</script>
<?php
}

include 'footer.php';

?>