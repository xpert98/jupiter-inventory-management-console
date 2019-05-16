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

        include 'cisLib.php';

        $cis = new cis;

        $applicationData = $cis->getCISDataById('application', $_GET['appId']);

        $businessUnitListData = $cis->getCISDataList('businessUnit');

        echo '<script>';
        echo "\n";
        echo 'var businessUnitData = '.json_encode($businessUnitListData).';';
        echo "\n";

        include 'fortify.php';

        $fortify = new fortify;

        $fortifyAttributeDefs = $fortify->getAttributeDefinitions();

        $decodedAttrs = json_decode($fortifyAttributeDefs,true);
    
        //$ra = array();

        foreach($decodedAttrs['data'] as $attr) {

            if ($attr['id'] === 7 || $attr['id'] === 5 || $attr['id'] === 6 || $attr['id'] === 1) {
                echo 'var '.$attr['guid'].' = ';

                $optArray = array();
                if (is_array($attr['options']) || is_object($attr['options'])) {
                    foreach($attr['options'] as $opt) {
                        $guidNameArr = array('guid' => $opt['guid'], 'name' => $opt['name']);
                        array_push($optArray, $guidNameArr);
                    }
                }

                echo json_encode($optArray);
                echo ';';
                echo "\n";
            }

        }


        $fortifyIssueTemplates = $fortify->getIssueTemplates();

        $decodedIssueTemplates = json_decode($fortifyIssueTemplates, true);

        echo 'var issueTemplates = ';

        $templateArray = array();

        foreach($decodedIssueTemplates['data'] as $template) {
            $templateDetailArray = array('id' => $template['id'], 'name' => $template['name']);
            array_push($templateArray, $templateDetailArray);
        }
        
        echo json_encode($templateArray).';';

        echo '</script>';
        echo "\n";
    }

?>
<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="fas fa-cog" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

        <div style="width: 800px;">

            <h4>Import to Fortify Software Security Center</h4>

            <form action="processImportToFortifySSC.php" method="POST">

                <div class="form-group">
                    <label for="appId">Application ID</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['id']; ?></div>
                </div>

                <div class="form-group">
                    <label for="commonName">Common Name</label>
                    <div class="input-group-text"><?php echo $applicationData[0]['commonname']; ?></div>
                </div>

                <div class="form-group">
                    <label for="sscProjName">Fortify Project Name</label>
                    <input type="text" class="form-control" id="sscProjName" name="sscProjName" required>
                    <div class="container">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm" onclick="setFortifyProjectNameByBU();">Suggest name based on Business Unit</a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm" onclick="setFortifyProjectNameByRepo();">Suggest name based on Code Repository</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sscProjVer">Fortify Project Version</label>
                    <input type="text" class="form-control" id="sscProjVer" name="sscProjVer" required>
                    <div class="container">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col">
                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm" onclick="setFortifyProjectVer();">Suggest version name</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label for="accessibility">Accessibility</label>
                    <select class="custom-select" id="accessibility" name="accessibility" required><option></option></select>
                </div>

                <div class="form-group">
                    <label for="businessRisk">Business Risk</label>
                    <select class="custom-select" id="businessRisk" name="businessRisk" required><option></option></select>
                </div>

                <div class="form-group">
                    <label for="devPhase">Development Phase</label>
                    <select class="custom-select" id="devPhase" name="devPhase" required><option></option></select>
                </div>

                <div class="form-group">
                    <label for="devStrategy">Development Strategy</label>
                    <select class="custom-select" id="devStrategy" name="devStrategy" required><option></option></select>
                </div>

                <div class="form-group">
                    <label for="issueTemplate">Issue Template</label>
                    <select class="custom-select" id="issueTemplate" name="issueTemplate" required><option></option></select>
                </div>

                <button type="submit" class="btn btn-primary">Import Application</button>

            </form>

        </div>

    </div>
</div>

<script>

function setFortifyProjectNameByBU() {
    
    var suggestedFortifySSCProjName = '<?php echo $applicationData[0]['commonname']; ?>';

    var businessUnitId = '<?php echo $applicationData[0]['businessunitid']; ?>';

    for (i in businessUnitData) {
        if(businessUnitData[i].id ===  businessUnitId) {
            suggestedFortifySSCProjName = businessUnitData[i].businessunitname + '_' + suggestedFortifySSCProjName.replace(/\s/g , "-");
        }
    }

    $('#sscProjName').val(suggestedFortifySSCProjName);
}

function setFortifyProjectNameByRepo() {

    var suggestedFortifySSCProjName = '<?php echo $applicationData[0]['commonname']; ?>';

    var repoUrl = '<?php echo $applicationData[0]['coderepourl']; ?>';

    var repoName = repoUrl.split("/").pop();

    suggestedFortifySSCProjName = repoName + '_' + suggestedFortifySSCProjName.replace(/\s/g , "-");

    $('#sscProjName').val(suggestedFortifySSCProjName);
}

function setFortifyProjectVer() {

    $('#sscProjVer').val("dev");

}

for (i in Accessibility) {
    $("#accessibility").append('<option value="'+Accessibility[i].guid+'">'+Accessibility[i].name+'</option>');
}

for (i in BusinessRisk) {
    $("#businessRisk").append('<option value="'+BusinessRisk[i].guid+'">'+BusinessRisk[i].name+'</option>');
}
for (i in DevPhase) {
    $("#devPhase").append('<option value="'+DevPhase[i].guid+'">'+DevPhase[i].name+'</option>');
}
for (i in DevStrategy) {
    $("#devStrategy").append('<option value="'+DevStrategy[i].guid+'">'+DevStrategy[i].name+'</option>');
}
for (i in issueTemplates) {
    $("#issueTemplate").append('<option value="'+issueTemplates[i].id+'">'+issueTemplates[i].name+'</option>');
}
</script>
<?php
}

include 'footer.php';

?>