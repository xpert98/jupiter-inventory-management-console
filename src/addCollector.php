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

include 'collectorLib.php';

$collector = new collector;

$collectorInstanceData = $collector->validateNewCollector($_POST["collectorUrl"], $_POST["apiToken"]);

?>

<div class="modal fade" id="newCollectorModal" tabindex="-1" role="dialog" aria-labelledby="newCollectorModalLabel" aria-hidden="true">
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
                    if (isset($collectorInstanceData)) {
                        
                        $createInstanceResultError = $collector->createCollector($collectorInstanceData, $_POST["collectorUrl"], $_POST["apiToken"]);

                        if ($createInstanceResultError == '') {
                            echo '<div class="alert alert-success" role="alert">Collector configured successfully!</div>';
                        }
                        else {
                            echo '<div class="alert alert-danger" role="alert">Collector configuration failed.  Error #602</div>';    
                        }
                    }
                    else {
                        echo '<div class="alert alert-danger" role="alert">Collector configuration failed.  Error #603</div>';
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href = 'admin.php?tab=collectors';">Close</button>
            </div>

        </div>
    </div>
</div>
            

<script type="text/javascript">
    $(window).on('load',function(){
        $('#newCollectorModal').modal('show');
    });
</script>

<?php
include 'footer.php';
?>