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

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="fas fa-box" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

        <form action="configureCIS.php" method="POST">
            <div style="width: 800px;">

                <div class="form-group">
                    <label for="cisUrl">URL</label>
                    <input type="text" class="form-control" id="cisUrl" name="cisUrl">
                </div>
                <div class="form-group">
                    <label for="apiToken">API Token</label>
                    <textarea class="form-control" id="apiToken" name="apiToken" rows="2" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

        <script>
        for (var i=0; i<configItems.length; i++) {
            if (configItems[i]['settingname'] == "CIS_URL") {
                $('#cisUrl').val(configItems[i]['settingvalue']);
            }
            if (configItems[i]['settingname'] == "CIS_TOKEN") {
                $('#apiToken').val(configItems[i]['settingvalue']);
            }
        }
        </script>
    </div>
</div>

<?php
}
?>