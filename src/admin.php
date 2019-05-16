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

$currentPage = "admin";
include 'header.php';

if (isset($_SESSION['username'])) {

include 'db.php';

$conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
$configResult = pg_prepare($conn, "getconfig", 'select * from config');
$configResult = pg_execute($conn, "getconfig", array());
$configResultError = pg_result_error($configResult);

$configItems = array();

if (empty($configResultError)) {
    while ($row = pg_fetch_assoc($configResult)) {
        array_push($configItems, $row);
    }
}
else {
    echo "database error";
}

echo '<script>var configItems='.json_encode($configItems).'</script>';

?>

<h1><i class="fas fa-toolbox"></i> Administration</h1>

<ul class="nav nav-tabs">
    <li class="nav-item" id="adminHomeTab">
        <a class="nav-link active" id="adminHomeLink" href="admin.php">Admin Home</a>
    </li>
    <li class="nav-item" id="adminCollectorsTab">
        <a class="nav-link" id="adminCollectorsLink" href="admin.php?tab=collectors">Antecessor Collectors</a>
    </li>
    <li class="nav-item" id="adminCISTab">
        <a class="nav-link" id="adminCISLink" href="admin.php?tab=cis">Curated Inventory Service</a>
    </li>
    <li class="nav-item" id="adminMetadataTab">
        <a class="nav-link" id="adminMetadataLink" href="admin.php?tab=metadata">Application Metadata</a>
    </li>
    <li class="nav-item" id="adminUsersTab">
        <a class="nav-link" id="adminUsersLink" href="admin.php?tab=users">Users</a>
    </li>
    <li class="nav-item" id="adminIntegrationsTab">
        <a class="nav-link" id="adminIntegrationsLink" href="admin.php?tab=integrations">Integrations</a>
    </li>
</ul>

<script>
$('#adminCollectorsTab').click(function(){
    activateCollectorsTab();
});

$('#adminCISTab').click(function(){
    activateCISTab();
});

$('#adminUsersTab').click(function(){
    activateUsersTab();
});

$('#adminMetadataTab').click(function(){
    activateMetadataTab();
});

$('#adminIntegrationsTab').click(function(){
    activateIntegrationsTab();
});

function activateCollectorsTab() {
    $('#adminCollectorsLink').attr('class', 'nav-link active');
    $('#adminIntegrationsLink').attr('class', 'nav-link');
    $('#adminHomeLink').attr('class', 'nav-link'); 
    $('#adminCISLink').attr('class', 'nav-link'); 
    $('#adminUsersLink').attr('class', 'nav-link'); 
    $('#adminMetadataLink').attr('class', 'nav-link'); 
}

function activateCISTab() {
    $('#adminCISLink').attr('class', 'nav-link active');
    $('#adminIntegrationsLink').attr('class', 'nav-link'); 
    $('#adminCollectorsLink').attr('class', 'nav-link');
    $('#adminHomeLink').attr('class', 'nav-link');  
    $('#adminUsersLink').attr('class', 'nav-link'); 
    $('#adminMetadataLink').attr('class', 'nav-link'); 
}

function activateUsersTab() {
    $('#adminUsersLink').attr('class', 'nav-link active');
    $('#adminIntegrationsLink').attr('class', 'nav-link');
    $('#adminCISLink').attr('class', 'nav-link');
    $('#adminCollectorsLink').attr('class', 'nav-link');
    $('#adminHomeLink').attr('class', 'nav-link');  
    $('#adminMetadataLink').attr('class', 'nav-link'); 
}

function activateMetadataTab() {
    $('#adminMetadataLink').attr('class', 'nav-link active'); 
    $('#adminIntegrationsLink').attr('class', 'nav-link');
    $('#adminUsersLink').attr('class', 'nav-link'); 
    $('#adminCISLink').attr('class', 'nav-link');
    $('#adminCollectorsLink').attr('class', 'nav-link');
    $('#adminHomeLink').attr('class', 'nav-link');  
}

function activateIntegrationsTab() {
    $('#adminIntegrationsLink').attr('class', 'nav-link active'); 
    $('#adminMetadataLink').attr('class', 'nav-link'); 
    $('#adminUsersLink').attr('class', 'nav-link'); 
    $('#adminCISLink').attr('class', 'nav-link');
    $('#adminCollectorsLink').attr('class', 'nav-link');
    $('#adminHomeLink').attr('class', 'nav-link');
}

var qParams = new URLSearchParams(location.search);
if (qParams.get('tab') == 'collectors') {
    activateCollectorsTab();
}
else if (qParams.get('tab') == 'cis') {
    activateCISTab();
}
else if (qParams.get('tab') == 'users') {
    activateUsersTab();
}
else if (qParams.get('tab') == 'metadata') {
    activateMetadataTab();
}
else if (qParams.get('tab') == 'integrations') {
    activateIntegrationsTab();
}
</script>

<div id="adminContent" style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; padding: 10px;">

<?php
if (isset($_GET["tab"])) {

    if ($_GET["tab"] === 'collectors') {
        include 'adminCollectors.php';
    }
    elseif ($_GET["tab"] === 'cis') {
        include 'adminCIS.php';
    }
    elseif ($_GET["tab"] === 'integrations') {
        include 'adminIntegrations.php';
    }
    elseif ($_GET["tab"] === 'users') {
        if (!isset($_GET["action"])) {
            include 'adminUsers.php';
        }
        else {
            if ($_GET["action"] === 'add') {
                include 'adminAddUserForm.php';
            }
            elseif ($_GET["action"] === 'edit') {
                include 'adminEditUserForm.php';
            }
            elseif ($_GET["action"] === 'delete') {
                include 'adminDeleteUser.php';
            }
        }
    }
    elseif ($_GET["tab"] === 'metadata') {
        if (!isset($_GET["dataType"])) {
            include 'adminMetadata.php';
        }
        else {
            if ($_GET["dataType"] === 'businessUnits') {
                if (!isset($_GET["action"])) {
                    include 'adminBusinessUnits.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddBusinessUnitForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditBusinessUnitForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteBusinessUnit.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'exposureLevels') {
                if (!isset($_GET["action"])) {
                    include 'adminExposureLevels.php';
                }
                    else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddExposureLevelForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditExposureLevelForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteExposureLevel.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'codeLanguages') {
                if (!isset($_GET["action"])) {
                    include 'adminCodeLanguages.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddCodeLanguageForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditCodeLanguageForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteCodeLanguage.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'lifecycleStages') {
                if (!isset($_GET["action"])) {
                    include 'adminLifeCycleStages.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddLifecycleStageForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditLifecycleStageForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteLifecycleStage.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'applicationOwners') {
                if (!isset($_GET["action"])) {
                    include 'adminApplicationOwners.php';
                }
                    else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddApplicationOwnerForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditApplicationOwnerForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteApplicationOwner.php';
                    }
                    }
            }
            elseif ($_GET["dataType"] === 'dataClassifications') {
                if (!isset($_GET["action"])) {
                    include 'adminDataClassifications.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddDataClassificationForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditDataClassificationForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteDataClassification.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'riskLevels') {
                if (!isset($_GET["action"])) {
                    include 'adminRiskLevels.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddRiskLevelForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditRiskLevelForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteRiskLevel.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'applicationTypes') {
                if (!isset($_GET["action"])) {
                    include 'adminApplicationTypes.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddApplicationTypeForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditApplicationTypeForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteApplicationType.php';
                    }
                }
            }
            elseif ($_GET["dataType"] === 'deploymentEnvironments') {
                if (!isset($_GET["action"])) {
                    include 'adminDeploymentEnvironments.php';
                }
                else {
                    if ($_GET["action"] === 'add') {
                        include 'adminAddDeploymentEnvironmentForm.php';
                    }
                    elseif ($_GET["action"] === 'edit') {
                        include 'adminEditDeploymentEnvironmentForm.php';
                    }
                    elseif ($_GET["action"] === 'delete') {
                        include 'adminDeleteDeploymentEnvironment.php';
                    }
                }
            }
        }

    }

}
else {
?>

    <div class="card" style="margin-top: 25px;">
        <div class="card-header">
            Jupiter Application Inventory Management System Console Administration
        </div>
        <div class="card-body">
            <h5 class="card-title">Manage Jupiter Services and Inventory Data</h5>
            <p class="card-text">The Jupiter Application Inventory Management System Console requires a connection to at least one Collector Service and the Curated Inventory Service.</p>
            <p class="card-text">Application metadata provides data integrity for Curated Inventory gold records.</p>
            <p class="card-text">Use the tabs above to manage services and metadata.</p>
        </div>
    </div>

<?php
}
?>

</div>



<?php
}
include 'footer.php';
?>