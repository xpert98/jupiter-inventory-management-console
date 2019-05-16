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

    if (isset($_GET['buId'])) { 

        include 'cisLib.php';

        $cis = new cis;

        $buId = htmlentities($_GET["buId"], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $cisData = $cis->getCISDataById("businessUnit", $buId);

    }

?>
<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="far fa-building" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

        <form action="processEditMetadataItem.php?dataType=businessUnits" method="POST">
            <div style="width: 800px;">

                <div class="form-group">
                    <label for="businessUnitName">Business Unit Name</label>
                    <input type="text" class="form-control" id="businessUnitName" name="businessUnitName" value="<?php echo $cisData[0]['businessunitname']; ?>" required>
                </div>

                <input type="hidden" id="buId" name="buId" value="<?php echo $buId; ?>">

                <button type="submit" class="btn btn-primary">Save Business Unit</button>
            </div>
        </form>

    </div>
</div>

<?php
}
?>