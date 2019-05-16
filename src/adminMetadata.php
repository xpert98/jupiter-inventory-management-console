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

if (isset($_SESSION['username'])) {
?>

<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="fas fa-table" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="far fa-building" style="font-size: 44px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Business Units</h5>
            <a href="admin.php?tab=metadata&dataType=businessUnits" class="btn btn-primary">Manage Business Units</a>
            
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-radiation" style="font-size: 40px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Exposure Levels</h5>
            <a href="admin.php?tab=metadata&dataType=exposureLevels" class="btn btn-primary">Manage Exposure Levels</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-code" style="font-size: 32px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Code Languages</h5>
            <a href="admin.php?tab=metadata&dataType=codeLanguages" class="btn btn-primary">Manage Code Languages</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="far fa-map" style="font-size: 36px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Lifecycle Stages</h5>
            <a href="admin.php?tab=metadata&dataType=lifecycleStages" class="btn btn-primary">Manage Lifecycle Stages</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-user-tie" style="font-size: 44px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Application Owners</h5>
            <a href="admin.php?tab=metadata&dataType=applicationOwners" class="btn btn-primary">Manage Application Owners</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-dna" style="font-size: 40px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Data Classifications</h5>
            <a href="admin.php?tab=metadata&dataType=dataClassifications" class="btn btn-primary">Manage Data Classifications</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-exclamation-circle" style="font-size: 40px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Risk Levels</h5>
            <a href="admin.php?tab=metadata&dataType=riskLevels" class="btn btn-primary">Manage Risk Levels</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-chess" style="font-size: 40px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Application Types</h5>
            <a href="admin.php?tab=metadata&dataType=applicationTypes" class="btn btn-primary">Manage Application Types</a>
        </div>
    </div>

    <div class="row" style="margin-bottom: 40px; margin-left: 30px;">
        <div class="col-md-auto" style="padding-top: 20px;">
            <i class="fas fa-dungeon" style="font-size: 40px;"></i>
        </div>
        <div class="col-md-auto">

            <h5>Deployment Environments</h5>
            <a href="admin.php?tab=metadata&dataType=deploymentEnvironments" class="btn btn-primary">Manage Deployment Environments</a>
        </div>
    </div>

    </div>
</div>

<?php
}
?>