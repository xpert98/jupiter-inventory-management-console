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

$currentPage = "admin";
include 'header.php';

if (isset($_SESSION['username'])) {

    include 'fortify.php';

    $fortify = new fortify;

    $fortifyPassword = '';

    if (isset($_POST["fortifyPassword"])) {
        $fortifyPassword = $_POST["fortifyPassword"];
    }

    $fortifyUpdateStatus = $fortify->updateSSCInfo($_POST["fortifyUrl"], $_POST["fortifyUser"], $fortifyPassword);

    if ($fortifyUpdateStatus === "success") {
        echo '<div class="alert alert-success" role="alert">Fortify configured successfully!</div>';
    }
    else {
        echo '<div class="alert alert-danger" role="alert">Fortify configuration failed.  Error #1202</div>';    
    }

}

include 'footer.php';

?>