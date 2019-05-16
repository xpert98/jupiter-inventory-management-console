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

    include 'db.php';

    $importPayload = array(
        "commonName" => $_POST['commonName'],
        "primaryOwner" => $_POST['primaryOwner']
    );

    $conn = pg_connect("host=".$dbhost." dbname=".$dbname." user=".$dbuser." password=".$dbpass."");
    $cisUrlResult = pg_prepare($conn, "getcisurl", 'select settingvalue from config where settingname=$1');
    $cisUrlResult = pg_execute($conn, "getcisurl", array('CIS_URL'));
    $cisUrlResultError = pg_result_error($cisUrlResult);

    $cisUrlRow = pg_fetch_assoc($cisUrlResult);

    $cisBaseUrl = $cisUrlRow['settingvalue'];

    $cisTokenResult = pg_prepare($conn, "getcistoken", 'select settingvalue from config where settingname=$1');
    $cisTokenResult = pg_execute($conn, "getcistoken", array('CIS_TOKEN'));
    $cisTokenResultError = pg_result_error($cisTokenResult);

    $cisTokenRow = pg_fetch_assoc($cisTokenResult);

    $cisApiToken = $cisTokenRow['settingvalue'];

    $curatedInventorySvcUrl = $cisBaseUrl.'/application/create';
    $ch = curl_init($curatedInventorySvcUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($importPayload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$cisApiToken
    ));
    $data = curl_exec($ch);
    curl_close($ch);

    echo json_encode($data);

?>

<div class="modal fade" id="importItemModal" tabindex="-1" role="dialog" aria-labelledby="importItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importItemModalLabel">Import</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <?php
            if (empty($cisUrlResultError) || empty($cisTokenResultError)) {
                echo '<div class="alert alert-success" role="alert">Item imported successfully!</div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">Item import failed.  Error #801</div>'; 
            }
            ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.href = 'applications.php';">Close</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#importItemModal').modal('show');
    });
</script>

<?php
}
include 'footer.php';
?>