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


    include 'collectorLib.php';

    $collector = new collector;

    $collectorInstanceData = $collector->deleteAntecessor($_POST['antecessorId']);

?>

<div class="modal fade" id="deleteAntecessorModal" tabindex="-1" role="dialog" aria-labelledby="delteAntecessorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delteAntecessorModalLabel">Antecessor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <?php
            if ($responseCode === 200) {
                echo '<div class="alert alert-success" role="alert">Item deleted successfully!</div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">Item delete failed.  Error #802</div>'; 
            }
            ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href = 'antecessors.php';">Close</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#deleteAntecessorModal').modal('show');
    });
</script>

<?php
}
include 'footer.php';
?>