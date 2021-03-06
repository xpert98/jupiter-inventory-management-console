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

    if (isset($_GET['typeId'])) { 

        include 'cisLib.php';

        $cis = new cis;

        $typeId = htmlentities($_GET["typeId"], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $cisData = $cis->getCISDataById("type", $typeId);

    }

?>
<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="fas fa-chess" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

        <form action="processEditMetadataItem.php?dataType=applicationTypes" method="POST">
            <div style="width: 800px;">

                <div class="form-group">
                    <label for="typeName">Application Type Name</label>
                    <input type="text" class="form-control" id="typeName" name="typeName" value="<?php echo $cisData[0]['typename']; ?>" required>
                </div>

                <input type="hidden" id="typeId" name="typeId" value="<?php echo $typeId; ?>">

                <button type="submit" class="btn btn-primary">Save Application Type</button>
            </div>
        </form>

    </div>
</div>

<?php
}
?>