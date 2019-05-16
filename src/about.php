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

?>

<h1><i class="fas fa-robot"></i> About</h1>

<div class="jumbotron">

    <p class="lead">License Information</p>
    <p>Jupiter Inventory Management Console<br>Copyright (C) 2019 Matt Stanchek
    <p>This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
    <p>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
    <p>You should have received a copy of the GNU General Public License along with this program.  If not, see <https://www.gnu.org/licenses/>.
    <hr class="my-4">
    <p>Font Awesome Free - <a href="https://fontawesome.com" target="_blank">https://fontawesome.com</a>
    <p>License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
    <hr class="my-4">
    <p>Bootstrap - <a href="https://getbootstrap.com/" target="_blank">https://getbootstrap.com</a>
    <p>Copyright 2011-2019 The Bootstrap Authors (<a href="https://github.com/twbs/bootstrap/graphs/contributors" target="_blank">https://github.com/twbs/bootstrap/graphs/contributors</a>)
    <p>Licensed under MIT (<a href="https://github.com/twbs/bootstrap/blob/master/LICENSE" target="_blank">https://github.com/twbs/bootstrap/blob/master/LICENSE</a>)
    <hr class="my-4">
    <p>bootstrap-table - <a href="https://bootstrap-table.com" target="_blank">https://bootstrap-table.com</a>
    <p>wenzhixin (<a href="http://wenzhixin.net.cn/" target="_blank">http://wenzhixin.net.cn</a>)
    <p>Licensed under MIT
</div>

<?php
}

include 'footer.php';
?>