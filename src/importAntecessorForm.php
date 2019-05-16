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

$currentPage = "antecessors";
include 'header.php';

if (isset($_SESSION['username'])) {

    include 'collectorLib.php';

    $collector = new collector;

    $antecessorData = $collector->getCISDataById($_POST['aId']);                
    
    $commonName = htmlentities($_POST["commonName"], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $primaryOwner = htmlentities($_POST["primaryOwner"], ENT_QUOTES | ENT_HTML5, 'UTF-8');

    echo '<script>';
    echo "\n";
    echo 'var importCommonName = "'.$commonName.'";';
    echo "\n";
    echo 'var importPrimaryOwner = "'.$primaryOwner.'";';
    echo "\n";
    echo 'var remainingImportPayload = ['.$antecessorData.'];';
    echo "\n";
    echo '</script>';
    echo "\n";

    include 'cisLib.php';

    $cis = new cis;

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
    echo '</script>';
    echo "\n";

}

?>

<h1><i class="fas fa-puzzle-piece"></i> Import Antecessor</h1>

<div class="alert alert-info" role="alert">
    <p>Import Antecessor data to create Application records.  Data captured by a Collector Service instance can be copied into Application record fields using the <i class="fas fa-angle-double-right"></i> incon.
    <p>Some data requires referential integrity because there can be relationships among applications (e.g. one owner, multiple applications) or because consistency is needed for reporting and analysis purposes.  For those fields, ensure the data (such as an application owner) has been added to the relevant list in the Application Metadata section.
</div>

<form action="processImportApplication.php" method="POST">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Common Name</label>
                    <div class="input-group-text" id="importCommonName">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importCommonName','commonName')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="commonName">Application Common Name</label>
                    <input type="text" class="form-control" id="commonName" name="commonName" aria-describedby="commonNameHelp">
                    <small id="commonNameHelp" class="form-text text-muted">The most widely known or current name of the application</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Primary Owner</label>
                    <div class="input-group-text" id="importPrimaryOwner">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">

            </div>
            <div class="col">
                <div class="form-group">
                    <label for="primaryOwnerId">Primary Application Owner</label>
                    <select class="custom-select" id="primaryOwnerId" name="primaryOwnerId" aria-describedby="primaryOwnerIdHelp" required><option></option></select>
                    <small id="primaryOwnerIdHelp" class="form-text text-muted">A person who has ultimate responsibility for the direction or well-being of the application</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Secondary Owner(s)</label>
                    <div class="input-group-text" id="importSecondaryOwners">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importSecondaryOwners','secondaryOwners')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="secondaryOwners">Secondary Application Owner(s)</label>
                    <input type="text" class="form-control" id="secondaryOwners" name="secondaryOwners" aria-describedby="secondaryOwnersHelp">
                    <small id="secondaryOwnersHelp" class="form-text text-muted">Other people who may be delegates of the Primary Owner</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Aliases</label>
                    <div class="input-group-text" id="importAliases">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importAliases','aliases')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="aliases">Aliases</label>
                    <textarea class="form-control" id="aliases" name="aliases" rows="2" aria-describedby="aliasesHelp"></textarea>
                    <small id="aliasesHelp" class="form-text text-muted">Other names the application might have or have had previously</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Description</label>
                    <div class="input-group-text" id="importDescription">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importDescription','description')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" aria-describedby="descriptionHelp"></textarea>
                    <small id="descriptionHelp" class="form-text text-muted">A brief synopsis of the application’s purpose for existing</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Code Repo URL</label>
                    <div class="input-group-text" id="importCodeRepoUrl">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importCodeRepoUrl','codeRepoUrl')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="codeRepoUrl">Code Repo URL</label>
                    <input type="text" class="form-control" id="codeRepoUrl" name="codeRepoUrl" aria-describedby="codeRepoUrlHelp">
                    <small id="codeRepoUrlHelp" class="form-text text-muted">The location where the application’s code is stored and versioned</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Binary Repo URL</label>
                    <div class="input-group-text" id="importBinaryRepoUrl">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importBinaryRepoUrl','binaryRepoUrl')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="binaryRepoUrl">Binary Repo URL</label>
                    <input type="text" class="form-control" id="binaryRepoUrl" name="binaryRepoUrl" aria-describedby="binaryRepoUrlHelp">
                    <small id="binaryRepoUrlHelp" class="form-text text-muted">The location where build artifacts are stored and versioned</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Primary Language</label>
                    <div class="input-group-text" id="importPrimaryLanguage">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="primaryLanguageId">Primary Language</label>
                    <select class="custom-select" id="primaryLanguageId" name="primaryLanguageId" aria-describedby="primaryLanguageIdHelp"><option></option></select>
                    <small id="primaryLanguageIdHelp" class="form-text text-muted">The most prominent programming language used in the application’s codebase</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Secondary Languages</label>
                    <div class="input-group-text" id="importSecondaryLanguages">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importSecondaryLanguages','secondaryLanguages')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="secondaryLanguages">Secondary Languages</label>
                    <textarea class="form-control" id="secondaryLanguages" name="secondaryLanguages" rows="2" aria-describedby="secondaryLanguagesHelp"></textarea>
                    <small id="secondaryLanguagesHelp" class="form-text text-muted">Additional programming languages used in the application’s codebase</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Application Type</label>
                    <div class="input-group-text" id="importTypeName">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="typeId">Application Type</label>
                    <select class="custom-select" id="typeId" name="typeId" aria-describedby="typeIdHelp"><option></option></select>
                    <small id="typeIdHelp" class="form-text text-muted">Applications might have a particular role inside of an application ecosystem, such as a microservice, user interface, batch job, etc.</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Business Unit</label>
                    <div class="input-group-text" id="importBusinessUnit">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="businessUnitId">Business Unit</label>
                    <select class="custom-select" id="businessUnitId" name="businessUnitId" aria-describedby="businessUnitIdHelp"><option></option></select>
                    <small id="businessUnitIdHelp" class="form-text text-muted">Particularly important in large organizations, this is the specific group within the organization to which the application belongs</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Exposure Level</label>
                    <div class="input-group-text" id="importExposure">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="exposureId">Exposure Level</label>
                    <select class="custom-select" id="exposureId" name="exposureId" aria-describedby="exposureIdHelp"><option></option></select>
                    <small id="exposureIdHelp" class="form-text text-muted">Applications have varying ways they can be exposed &mdash; internal to the organization, publicly available on the internet, or to a select group of users</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Number of Users</label>
                    <div class="input-group-text" id="importNumUsers">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importNumUsers','numUsers')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="numUsers">Number of Users</label>
                    <input type="text" class="form-control" id="numUsers" name="numUsers" aria-describedby="numUsersHelp">
                    <small id="numUsersHelp" class="form-text text-muted">The number of users (or an estimate) of the application</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Data Classification</label>
                    <div class="input-group-text" id="importDataClassification">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="dataClassificationId">Data Classification</label>
                    <select class="custom-select" id="dataClassificationId" name="dataClassificationId" aria-describedby="dataClassificationIdHelp"><option></option></select>
                    <small id="dataClassificationIdHelp" class="form-text text-muted">Many organizations have a data risk classification hierarchy and applications may fall into one of the categories</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Deployment Environment</label>
                    <div class="input-group-text" id="importDeploymentEnvironment">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="deploymentEnvironmentId">Deployment Environment</label>
                    <select class="custom-select" id="deploymentEnvironmentId" name="deploymentEnvironmentId" aria-describedby="deploymentEnvironmentIdHelp"><option></option></select>
                    <small id="deploymentEnvironmentIdHelp" class="form-text text-muted">Because the Collector captures information at the build and deployment stages, the specific environment to which the build is destined can be recorded (e.g. QA, UAT, Production, etc.)</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Deployment Environment URL</label>
                    <div class="input-group-text" id="importDeploymentEnvironmentUrl">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importDeploymentEnvironmentUrl','deploymentEnvironmentUrl')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="deploymentEnvironmentUrl">Deployment Environment URL</label>
                    <input type="text" class="form-control" id="deploymentEnvironmentUrl" name="deploymentEnvironmentUrl" aria-describedby="deploymentEnvironmentUrlHelp">
                    <small id="deploymentEnvironmentUrlHelp" class="form-text text-muted">Correlating to the Deployment Environment, this is a URL for the application if it is a web application or service</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="riskLevel">Risk Level</label>
                    <div class="input-group-text" id="importRiskLevel">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="riskLevelId">Risk Level</label>
                    <select class="custom-select" id="riskLevelId" name="riskLevelId" aria-describedby="riskLevelIdHelp"><option></option></select>
                    <small id="riskLevelIdHelp" class="form-text text-muted">Many organizations have formal risk levels that determine prioritization of resources aside from data categorization (can be a factor of data classification and exposure)</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Regulations</label>
                    <div class="input-group-text" id="importRegulations">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importRegulations','regulations')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="regulations">Regulations</label>
                    <input type="text" class="form-control" id="regulations" name="regulations" aria-describedby="regulationsHelp">
                    <small id="regulationsHelp" class="form-text text-muted">Applicable regulations such as PCI, SOX, HIPPA, etc. can be listed</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Chat Channel</label>
                    <div class="input-group-text" id="importChatChannel">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importChatChannel','chatChannel')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="chatChannel">Chat Channel</label>
                    <input type="text" class="form-control" id="chatChannel" name="chatChannel" aria-describedby="chatChannelHelp">
                    <small id="chatChannelHelp" class="form-text text-muted">Many application development and support teams have a way to communicate with each other and to collaborate within their organization such as Slack or Glip</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Agile Scrum Board URL</label>
                    <div class="input-group-text" id="importAgilesSrumBoardUrl">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importAgilesSrumBoardUrl','agileScrumBoardUrl')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="agileScrumBoardUrl">Agile Scrum Board URL</label>
                    <input type="text" class="form-control" id="agileScrumBoardUrl" name="agileScrumBoardUrl" aria-describedby="agileScrumBoardUrlHelp">
                    <small id="agileScrumBoardUrlHelp" class="form-text text-muted">Development teams often keep a list of their in-flight work and backlog in a project tracking system such as Jira or Redmine</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Build Server URL</label>
                    <div class="input-group-text" id="importBuildServerUrl">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importBuildServerUrl','buildServerUrl')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="buildServerUrl">Build Server URL</label>
                    <input type="text" class="form-control" id="buildServerUrl" name="buildServerUrl" aria-describedby="buildServerUrlHelp">
                    <small id="buildServerUrlHelp" class="form-text text-muted">The CI server from which the recorded build or deployment originated</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Age</label>
                    <div class="input-group-text" id="importAge">&nbsp;</div>
                </div>
            </div>
            <div class="col-2" style="padding: 30px 0 0 70px;">
                <a href="javascript:void(0)" class="btn btn-dark" onclick="copyData('importAge','age')"><i class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" aria-describedby="ageHelp">
                    <small id="ageHelp" class="form-text text-muted">Applications can have a long life and understanding a given application’s age can help determine risk and gauge other implications</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Lifecycle Stage</label>
                    <div class="input-group-text" id="importLifecycleStage">&nbsp;</div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="lifecycleStageId">Lifecycle Stage</label>
                    <select class="custom-select" id="lifecycleStageId" name="lifecycleStageId" aria-describedby="lifecycleStageIdHelp"><option></option></select>
                    <small id="lifecycleStageIdHelp" class="form-text text-muted">Similar to age, an application can be New, in a Maintenance steady-state, or in Retirement</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-2"></div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Import Antecessor as Application</button>
            </div>
        </div>
    </div>

</form>

<script>
$('#importCommonName').text(importCommonName);
$('#importPrimaryOwner').text(importPrimaryOwner);

for (var key in remainingImportPayload) {
    if (remainingImportPayload.hasOwnProperty(key)) {
        if (remainingImportPayload[key].collectorInstanceId) {
            $('#collectorInstanceId').val(remainingImportPayload[key].collectorInstanceId);
        }
        if (remainingImportPayload[key].secondaryOwners) {
            $('#importSecondaryOwners').text(remainingImportPayload[key].secondaryOwners);
        }
        if (remainingImportPayload[key].aliases) {
            $('#importAliases').text(remainingImportPayload[key].aliases);
        }
        if (remainingImportPayload[key].description) {
            $('#importDescription').text(remainingImportPayload[key].description);
        }
        if (remainingImportPayload[key].codeRepoUrl) {
            $('#importCodeRepoUrl').text(remainingImportPayload[key].codeRepoUrl);
        }
        if (remainingImportPayload[key].binaryRepoUrl) {
            $('#importBinaryRepoUrl').text(remainingImportPayload[key].binaryRepoUrl);
        }
        if (remainingImportPayload[key].primaryLanguage) {
            $('#importPrimaryLanguage').text(remainingImportPayload[key].primaryLanguage);
        }
        if (remainingImportPayload[key].secondaryLanguages) {
            $('#importSecondaryLanguages').text(remainingImportPayload[key].secondaryLanguages);
        }
        if (remainingImportPayload[key].type) {
            $('#importType').text(remainingImportPayload[key].type);
        }
        if (remainingImportPayload[key].secondaryOwners) {
            $('#importSecondaryOwners').text(remainingImportPayload[key].secondaryOwners);
        }
        if (remainingImportPayload[key].businessUnit) {
            $('#importBusinessUnit').text(remainingImportPayload[key].businessUnit);
        }
        if (remainingImportPayload[key].exposure) {
            $('#importExposure').text(remainingImportPayload[key].exposure);
        }
        if (remainingImportPayload[key].numUsers) {
            $('#importNumUsers').text(remainingImportPayload[key].numUsers);
        }
        if (remainingImportPayload[key].dataClassification) {
            $('#importDataClassification').text(remainingImportPayload[key].dataClassification);
        }
        if (remainingImportPayload[key].deploymentEnv) {
            $('#importDeploymentEnvironment').text(remainingImportPayload[key].deploymentEnv);
        }
        if (remainingImportPayload[key].deploymentEnvUrl) {
            $('#importDeploymentEnvironmentUrl').text(remainingImportPayload[key].deploymentEnvUrl);
        }
        if (remainingImportPayload[key].riskLevel) {
            $('#importRiskLevel').text(remainingImportPayload[key].riskLevel);
        }
        if (remainingImportPayload[key].regulations) {
            $('#importRegulations').text(remainingImportPayload[key].regulations);
        }
        if (remainingImportPayload[key].chatChannel) {
            $('#importChatChannel').text(remainingImportPayload[key].chatChannel);
        }
        if (remainingImportPayload[key].agileScrumBoardUrl) {
            $('#importAgileScrumBoardUrl').text(remainingImportPayload[key].agileScrumBoardUrl);
        }
        if (remainingImportPayload[key].buildServerUrl) {
            $('#importBuildServerUrl').text(remainingImportPayload[key].buildServerUrl);
        }
        if (remainingImportPayload[key].age) {
            $('#importAge').text(remainingImportPayload[key].age);
        }
        if (remainingImportPayload[key].lifecycleStage) {
            $('#importLifecycleStage').text(remainingImportPayload[key].lifecycleStage);
        }
        if (remainingImportPayload[key].lastDeployDate) {
            $('#importLastDeployDate').text(remainingImportPayload[key].lastDeployDate);
        }
    }
}
for (i in ownerData) {
    $("#primaryOwnerId").append('<option value="'+ownerData[i].id+'">'+ownerData[i].ownername+'</option>');
}
for (i in codeLanguageData) {
    $("#primaryLanguageId").append('<option value="'+codeLanguageData[i].id+'">'+codeLanguageData[i].languagename+'</option>');
}
for (i in applicationTypeData) {
    $("#typeId").append('<option value="'+applicationTypeData[i].id+'">'+applicationTypeData[i].typename+'</option>');
}
for (i in businessUnitData) {
    $("#businessUnitId").append('<option value="'+businessUnitData[i].id+'">'+businessUnitData[i].businessunitname+'</option>');
}
for (i in exposureLevelData) {
    $("#exposureId").append('<option value="'+exposureLevelData[i].id+'">'+exposureLevelData[i].exposurename+'</option>');
}
for (i in dataClassificationData) {
    $("#dataClassificationId").append('<option value="'+dataClassificationData[i].id+'">'+dataClassificationData[i].dataclassificationname+'</option>');
}
for (i in deploymentEnvironmentData) {
    $("#deploymentEnvironmentId").append('<option value="'+deploymentEnvironmentData[i].id+'">'+deploymentEnvironmentData[i].deploymentenvironmentname+'</option>');
}
for (i in riskLevelData) {
    $("#riskLevelId").append('<option value="'+riskLevelData[i].id+'">'+riskLevelData[i].risklevelname+'</option>');
}
for (i in lifecycleStageData) {
    $("#lifecycleStageId").append('<option value="'+lifecycleStageData[i].id+'">'+lifecycleStageData[i].lifecyclestagename+'</option>');
}

function copyData(importField, applicationField) {
    document.getElementById(applicationField).value = document.getElementById(importField).innerHTML;
}

</script>

<?php
include 'footer.php';
?>