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
        <i class="fas fa-cog" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

        <form action="configureFortify.php" method="POST">
            <div style="width: 800px;">

                <div class="form-group">
                    <label for="fortifyUrl">Fortify Software Security Center URL</label>
                    <input type="text" class="form-control" id="fortifyUrl" name="fortifyUrl">
                </div>
                <div class="form-group">
                    <label for="fortifyUser">Fortify Software Security Center User</label>
                    <input type="text" class="form-control" id="fortifyUser" name="fortifyUser">
                </div>
                <div class="form-group">
                    <label for="fortifyPassword">Fortify Software Security Center Password</label>
                    <input type="password" class="form-control" id="fortifyPassword" name="fortifyPassword">
                </div>

                <button type="submit" class="btn btn-primary">Save Configuration</button>
            </div>
        </form>

        <script>
        for (var i=0; i<configItems.length; i++) {
            if (configItems[i]['settingname'] == "FORTIFY_URL") {
                $('#fortifyUrl').val(configItems[i]['settingvalue']);
            }
            if (configItems[i]['settingname'] == "FORTIFY_USERNAME") {
                $('#fortifyUser').val(configItems[i]['settingvalue']);
            }
        }
        </script>
    </div>
</div>

<?php
}
?>