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
    include 'db.php';

    $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");

    //update collector set primarycollector = $1 where id = $2'

    $updateUrlResult = pg_prepare($conn, "updatecisurl", 'update config set settingvalue = $1 where settingname= $2');
    $updateUrlResult = pg_execute($conn, "updatecisurl", array($_POST["cisUrl"], "CIS_URL"));
    $updateUrlResultError = pg_result_error($updateUrlResult);

    $updateTokenResult = pg_prepare($conn, "updatecistoken", 'update config set settingvalue = $1 where settingname= $2');
    $updateTokenResult = pg_execute($conn, "updatecistoken", array($_POST["apiToken"], "CIS_TOKEN"));
    $updateTokenResultError = pg_result_error($updateTokenResult);


    if (empty($updateUrlResultError) || empty($updateTokenResultError)) {
        echo '<div class="alert alert-success" role="alert">Service configured successfully!</div>';
    }
    else {
        echo '<div class="alert alert-danger" role="alert">Service configuration failed.  Error #702</div>';    
    }

}

include 'footer.php';

?>