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

if (isset($_SESSION['username'])) {
?>

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="fas fa-stream" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

<?php

include 'collectorLib.php';

$collector = new collector;

$collectorList = $collector->getCollectorList();

if (count($collectorList) > 0) {
    foreach ($collectorList as $collectorInstance) {

    
        echo '<div class="card" style="width: 40rem;">';
        echo '<div class="card-header">Collector ID<br>'.$collectorInstance['id'].'</div>';
        echo '<ul class="list-group list-group-flush">';
        echo '<li class="list-group-item">Collector URL<br>'.$collectorInstance['url'].'</li>';
        if ($collectorInstance['primary'] === 't') {
            echo '<li class="list-group-item"><span class="badge badge-success">Primary</span></li>';
        }
        else {
            echo '<li class="list-group-item"><button type="button" class="btn btn-secondary btn-sm" onclick="makePrimary(\''.$collectorInstance['id'].'\');">Make Primary</button></li>';
        }
        echo '</ul></div>';

    }    

    echo '<br/>';

}
else {
?>

        <div class="alert alert-info" role="alert">
        There are no collectors added to the Management Console
        </div>



<?php
}
?>


        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCollectorModal">Add a Collector</button>

        <div class="modal fade" id="addCollectorModal" tabindex="-1" role="dialog" aria-labelledby="addCollectorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCollectorModalLabel">Add Collector</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="addCollector.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="collectorUrl">Collector URL</label>
                                <input type="text" class="form-control" id="collectorUrl" name="collectorUrl" placeholder="http://" required>
                            </div>
                            <div class="form-group">
                                <label for="apiToken">API Token</label>
                                <textarea class="form-control" id="apiToken" name="apiToken" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

function makePrimary(collectorId) {
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "setPrimaryCollector.php");
    
    var idInput = document.createElement("input");
    idInput.setAttribute("name", "id");
    idInput.setAttribute("value", collectorId);
    form.appendChild(idInput);
    
    var primaryInput = document.createElement("input");
    primaryInput.setAttribute("name", "primaryToggle");
    primaryInput.setAttribute("value", true);
    form.appendChild(primaryInput);

    document.body.appendChild(form);
    form.submit();
}

</script>

<?php
}
?>