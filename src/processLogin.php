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

session_start();

if (!empty($_POST)) {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        include 'db.php';

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $userResult = pg_prepare($conn, "getuser", 'select id, username, password from jmcuser where username = $1');
        $userResult = pg_execute($conn, "getuser", array($_POST["username"]));
        $userResultError = pg_result_error($userResult);

        if ($userResultError == '') {
            $row = pg_fetch_assoc($userResult);
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                echo '<script type="text/javascript">location.href = \'index.php\';</script>';
            }
            else {
                echo "login failure";
            }
        }
        else {
            echo "login failure";
        }

    }
    else {
        echo "login failure";
    }
}
else {
    echo "login failure";
}

?>