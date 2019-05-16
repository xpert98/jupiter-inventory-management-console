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
?>

<div class="jumbotron">
    <h1 class="display-4">Jupiter Application Inventory Management System</h1>
    <p class="lead">DevOps-powered Application Inventory</p>
    <div class="container">
        <div class="row">
            <div class="col">
                <img id="logo" src="/images/jupiter.png" height="300px" width="300px">
            </div>
            <div class="col" style="padding-top: 60px;">
            <?php
            if (isset($_SESSION['username'])) {
                echo "Welcome, ".$_SESSION['username'];
            }
            else {
            ?>
                <form action="processLogin.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>