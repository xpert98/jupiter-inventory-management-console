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

session_destroy();
?>

<div class="jumbotron">
    <p class="lead">You are logged out.</p>
    <hr class="my-4">
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="index.php" role="button">Log In</a>
    </p>
</div>

<?php
include 'footer.php';
?>