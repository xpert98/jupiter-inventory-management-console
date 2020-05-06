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

?>

<html>
<head>
    <title>Setup</title>
</head>
<body>

<?php

session_start();

if (!empty($_POST)) {

    $hashedPassword = password_hash($_POST['adminpass'], PASSWORD_DEFAULT);

    $userName = 'admin';
    $firstName = 'Jupiter';
    $lastName = 'Admin';

    $conn = pg_connect("host=".$_POST['dbhost']." dbname=".$_POST['schema']." user=".$_POST['dbuser']." password=".$_POST['dbpass']."");
    $userResult = pg_prepare($conn, "adduser", 'insert into jmcuser (username, password, firstname, lastname) values ($1, $2, $3, $4)');
    $userResult = pg_execute($conn, "adduser", array($userName, $hashedPassword, $firstName, $lastName));
    $userResultError = pg_result_error($userResult);

    echo $userResultError;

    if ($userResultError == '') {
        echo 'The admin user has been set up successfully.';
    }
    else {
        echo "Failure adding user";
    }

}
else {
    echo "Setup failure";
}

?>

</body>
</html>