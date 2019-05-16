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

$currentPage = "applications";
include 'header.php';

if (isset($_SESSION['username'])) {
?>

<h1><i class="fas fa-cubes"></i> Application Inventory</h1>

<table
data-toggle="table"
data-url="http://localhost/applicationList.php"
data-pagination="true"
data-search="true">
    <thead>
        <tr>
            <th data-sortable="true" data-field="id">Application ID</th>
            <th data-field="commonname">Common Name</th>
            <th data-field="manage" data-formatter="manageFormatter" data-events="manageEvents">Manage</th>
        </tr>
    </thead>
</table>

<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="deleteApplication.php" method="POST">
                <div class="modal-body">
                <div class="form-group">
                        <label for="appId">Application ID</label>
                        <input type="hidden" id="appId" name="appId">
                        <div id="appIdText"></div>
                    </div>

                    <div class="form-group">
                        <label for="aCommonName">Common Name</label>
                        <input type="hidden" id="aCommonName" name="aCommonName">
                        <div id="aCommonNameText"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function manageFormatter(value, row, index) {
        return [
            '<a class="view" href="javascript:void(0)" title="View Application Data Record">',
            '<i class="fa fa-binoculars"></i>',
            '</a>  ',
            '<a class="edit" href="javascript:void(0)" title="Edit Application Data Record">',
            '<i class="fas fa-pencil-alt"></i>',
            '</a>  ',
            '<a class="manage" href="javascript:void(0)" title="Manage Application Data Record Integrations">',
            '<i class="fas fa-cog"></i>',
            '</a>  ',
            '<a class="delete" href="javascript:void(0)" title="Delete Application Data Record">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }
    window.manageEvents = {
        'click .view': function (e, value, row, index) {
            url = "viewApplication.php?appId=" + row.id;
            $(location).attr("href", url);
        },
        'click .edit': function (e, value, row, index) {
            url = "editApplicationForm.php?appId=" + row.id;
            $(location).attr("href", url);
        },
        'click .manage': function (e, value, row, index) {
            url = "manageApplicationIntegrations.php?appId=" + row.id;
            $(location).attr("href", url);
        },
        'click .delete': function (e, value, row, index) {
            $('#deleteModal').on('show.bs.modal', function (event) {
                $('#appId').val(row.id);
                $('#appIdText').text(row.id);
                $('#aCommonName').val(row.commonname);
                $('#aCommonNameText').text(row.commonname);
            });
            $('#deleteModal').modal();
        }
    }
</script>

<?php
}

include 'footer.php';

?>