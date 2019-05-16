<?

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
    $updateResult = pg_prepare($conn, "setprimary", 'update collector set primarycollector = $1 where id = $2');
    $updateResult = pg_execute($conn, "setprimary", array($_POST["primaryToggle"], $_POST["id"]));
    $updateResultError = pg_result_error($updateResult);

?>

<div class="modal fade" id="setPrimaryCollectorModal" tabindex="-1" role="dialog" aria-labelledby="newCollectorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCollectorModalLabel">Collector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <?php
            if ($updateResultError == '') {
                echo '<div class="alert alert-success" role="alert">Set as primary successfully!</div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">Collector configuration failed.  Error #604</div>'; 
            }
            ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href = 'collectors.php';">Close</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#setPrimaryCollectorModal').modal('show');
    });
</script>

<?php
}
include 'footer.php';
?>