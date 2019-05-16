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
    if (isset($_POST['userName']) && isset($_POST['userPassword'])) {

        include 'db.php';

        $hashedPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);

        $firstName = '';
        $lastName = '';

        if (isset($_POST['userFirstName'])) {
            $firstName = $_POST['userFirstName'];
        } 
        
        if (isset($_POST['userLastName'])) {
            $lastName = $_POST['userLastName'];
        }

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $userResult = pg_prepare($conn, "adduser", 'insert into jmcuser (username, password, firstname, lastname) values ($1, $2, $3, $4)');
        $userResult = pg_execute($conn, "adduser", array($_POST["userName"], $hashedPassword, $firstName, $lastName));
        $userResultError = pg_result_error($userResult);

        if ($userResultError == '') {
            echo '<script type="text/javascript">location.href = \'admin.php?tab=users\';</script>';
        }
        else {
            echo "failure adding user";
        }

    }
}

?>