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

    include 'db.php';
    
    if (isset($_POST['userPassword']) && isset($_POST['userId'])) {

        $hashedPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $userResult = pg_prepare($conn, "updatepassword", 'update jmcuser set password = $1 where id = $2');
        $userResult = pg_execute($conn, "updatepassword", array($hashedPassword, $_POST["userId"]));
        $userResultError = pg_result_error($userResult);
    
        if ($userResultError != '') {
            echo "failure updating user password";
        }
    }

    if (isset($_POST['userFirstName']) && isset($_POST['userLastName']) && isset($_POST['userId'])) {
        $firstName = $_POST['userFirstName'];
        $lastName = $_POST['userLastName'];
    

        $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
        $userResult = pg_prepare($conn, "updatename", 'update jmcuser set firstname = $1, lastname = $2 where id = $3');
        $userResult = pg_execute($conn, "updatename", array($_POST["userFirstName"], $_POST["userLastName"], $_POST["userId"]));
        $userResultError = pg_result_error($userResult);

        if ($userResultError == '') {
            echo '<script type="text/javascript">location.href = \'admin.php?tab=users\';</script>';
        }
        else {
            echo "failure editing user first and last name";
        }

    }
    else {
        echo "failure editing user";
    }
}
else {
    echo "failure editing user";
}

?>
