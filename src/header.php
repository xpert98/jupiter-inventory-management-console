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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-table.min.css" rel="stylesheet">
    <link href="/css/all.min.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-png" href="/images/favicon.png" />

    <title>Jupiter Management Console</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="index.php"><img id="logo" src="/images/jupiter-small.png" alt="Jupiter" style="width: 40px; height:40px; padding: 0; margin: 0" /></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
        if (isset($_SESSION['username'])) {
        ?>
        <ul class="navbar-nav mr-auto">
            <li id="antecessors" class="nav-item">
                <a class="nav-link" href="antecessors.php"><i class="fas fa-puzzle-piece"></i> Antecessors</a>
            </li>
            <li id="applications" class="nav-item">
                <a class="nav-link" href="applications.php"><i class="fas fa-cubes"></i> Application Inventory</a>
            </li>
            <li id="admin" class="nav-item">
                <a class="nav-link" href="admin.php"><i class="fas fa-toolbox"></i> Administration</a>
            </li>
        </ul>

        <ul class="navbar-nav">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="about.php">About</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                </div>
            </li>
        </ul>
        <?php
        }
        ?>
    </div>


</nav>

<script type="text/javascript">
function setCurrentPageActive() {
    document.getElementById('<?php echo $currentPage; ?>').className = "nav-item active";
}
setCurrentPageActive();
</script>

<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap-table.min.js"></script>

<div style="padding: 20px;">
