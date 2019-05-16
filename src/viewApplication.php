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

    if (isset($_GET['appId'])) { 

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
        echo "\n";
        echo 'var ownerData = '.json_encode($ownerListData).';';
        echo "\n";
        echo 'var businessUnitData = '.json_encode($businessUnitListData).';';
        echo "\n";
        echo 'var codeLanguageData = '.json_encode($codeLanguageListData).';';
        echo "\n";
        echo 'var applicationTypeData = '.json_encode($applicationTypeListData).';';
        echo "\n";
        echo 'var exposureLevelData = '.json_encode($exposureLevelListData).';';
        echo "\n";
        echo 'var dataClassificationData = '.json_encode($dataClassificationListData).';';
        echo "\n";
        echo 'var deploymentEnvironmentData = '.json_encode($deploymentEnvironmentListData).';';
        echo "\n";
        echo 'var riskLevelData = '.json_encode($riskLevelListData).';';
        echo "\n";
        echo 'var lifecycleStageData = '.json_encode($lifecycleStageListData).';';
        echo "\n";
        echo 'var currentPrimaryOwnerId = '.$applicationData[0]['primaryownerid'].';';
        echo "\n";
        echo 'var currentBusinessUnitId = '.$applicationData[0]['businessunitid'].';';
        echo "\n";
        echo 'var currentPrimaryLanguageId = '.$applicationData[0]['primarylanguageid'].';';
        echo "\n";
        echo 'var currentTypeId = '.$applicationData[0]['typeid'].';';
        echo "\n";
        echo 'var currentExposureId = '.$applicationData[0]['exposureid'].';';
        echo "\n";
        echo 'var currentDataClassificationId = '.$applicationData[0]['dataclassificationid'].';';
        echo "\n";
        echo 'var currentDeploymentEnvironmentId = '.$applicationData[0]['deploymentenvironmentid'].';';
        echo "\n";
        echo 'var currentRiskLevelId = '.$applicationData[0]['risklevelid'].';';
        echo "\n";
        echo 'var currentLifecycleStageId = '.$applicationData[0]['lifecyclestageid'].';';
        echo "\n";
        echo '</script>';
    }

?>

<h1><i class="fas fa-cube"></i> View Application Details</h1>

<div class="container">


    <div class="row" style="margin-bottom: 30px;">

        <div class="col">

            <form action="processEditApplication.php" method="POST">
                

                <div class="form-group">
                    <label for="appId">Application ID</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['id']; ?></div>
                </div>

                <div class="form-group">
                    <label for="commonName">Common Name</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['commonname']; ?></div>
                </div>

                <div class="form-group">
                    <label for="primaryOwner">Primary Owner</label>
                    <div class="input-group-text" id="primaryOwnerName"></div>
                </div>

                <div class="form-group">
                    <label for="secondaryOwners">Secondary Owner(s)</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['secondaryowners']; ?></div>
                </div>

                <div class="form-group">
                    <label for="aliases">Aliases</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['aliases']; ?></div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['description']; ?></div>
                </div>

                <div class="form-group">
                    <label for="codeRepoUrl">Code Repo URL</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['coderepourl']; ?></div>
                </div>
                <div class="form-group">
                    <label for="binaryRepoUrl">Binary Repo URL</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['binaryrepourl']; ?></div>
                </div>

                <div class="form-group">
                    <label for="primaryLanguage">Primary Language</label>
                    <div class="input-group-text" id="primaryLanguageName"></div>
                </div>
                <div class="form-group">
                    <label for="secondaryLanguages">Secondary Languages</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['secondarylanguages']; ?></div>
                </div>
                <div class="form-group">
                    <label for="typeId">Application Type</label>
                    <div class="input-group-text" id="typeName"></div>
                </div>

                <div class="form-group">
                    <label for="businessUnitId">Business Unit</label>
                    <div class="input-group-text" id="businessUnitName"></div>
                </div>
                <div class="form-group">
                    <label for="exposureId">Exposure Level</label>
                    <div class="input-group-text" id="exposureName"></div>
                </div>
                <div class="form-group">
                    <label for="numUsers">Number of Users</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['numusers']; ?></div>
                </div>
                <div class="form-group">
                    <label for="dataClassification">Data Classification</label>
                    <div class="input-group-text" id="dataClassificationName"></div>
                </div>
                <div class="form-group">
                    <label for="deploymentEnvironmentId">Deployment Environment</label>
                    <div class="input-group-text" id="deploymentEnvironmentName"></div>
                </div>
                <div class="form-group">
                    <label for="deploymentEnvUrl">Deployment Environment URL</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['deploymentenvironmenturl']; ?></div>
                </div>
                <div class="form-group">
                    <label for="riskLevel">Risk Level</label>
                    <div class="input-group-text" id="riskLevelName"></div>
                </div>
                <div class="form-group">
                    <label for="regulations">Regulations</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['regulations']; ?></div>
                </div>
                <div class="form-group">
                    <label for="chatChannel">Chat Channel</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['chatchannel']; ?></div>
                </div>
                <div class="form-group">
                    <label for="agileScrumBoardUrl">Agile Scrum Board URL</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['agilescrumboardurl']; ?></div>
                </div>
                <div class="form-group">
                    <label for="buildServerUrl">Build Server URL</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['buildserverurl']; ?></div>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['age']; ?></div>
                </div>
                <div class="form-group">
                    <label for="lifecycleStage">Lifecycle Stage</label>
                    <div class="input-group-text" id="lifecycleStageName"></div>
                </div>


            </form>

        </div>
    </div>

</div>

<script>
for (i in ownerData) {
    if(currentPrimaryOwnerId === ownerData[i].id) {
        $("#primaryOwnerName").text(ownerData[i].ownername);
    }
}
for (i in businessUnitData) {
    if(currentBusinessUnitId === businessUnitData[i].id) {
        $("#businessUnitName").text(businessUnitData[i].businessunitname);
    }
}
for (i in codeLanguageData) {
    if(currentPrimaryLanguageId === codeLanguageData[i].id) {
        $("#primaryLanguageName").text(codeLanguageData[i].languagename);
    }
}
for (i in applicationTypeData) {
    if(currentTypeId === applicationTypeData[i].id) {
        $("#typeName").text(applicationTypeData[i].typename);
    }
    
}
for (i in exposureLevelData) {
    if(currentExposureId === exposureLevelData[i].id) {
        $("#exposureName").text(exposureLevelData[i].exposurename);
    }
}
for (i in dataClassificationData) {
    if(currentDataClassificationId === dataClassificationData[i].id) {
        $("#dataClassificationName").text(dataClassificationData[i].dataclassificationname);
    }
}
for (i in deploymentEnvironmentData) {
    if(currentDeploymentEnvironmentId === deploymentEnvironmentData[i].id) {
        $("#deploymentEnvironmentName").text(deploymentEnvironmentData[i].deploymentenvironmentname);
    }
}
for (i in riskLevelData) {
    if(currentRiskLevelId === riskLevelData[i].id) {
        $("#riskLevelName").text(riskLevelData[i].risklevelname);
    }
}
for (i in lifecycleStageData) {
    if(currentLifecycleStageId === lifecycleStageData[i].id) {
        $("#lifecycleStageName").text(lifecycleStageData[i].lifecyclestagename);
    }
    
}
</script>
<?php
}

include 'footer.php';

?>