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
<div class="row" style="margin-bottom: 40px;">
    <div class="col-md-auto" style="padding-top: 10px;">
        <i class="fas fa-chess" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

    <a href="admin.php?tab=metadata&dataType=applicationTypes&action=add" class="btn btn-primary">Add Application Type</a>

        <div style="width: 800px;">
            <table
            data-toggle="table"
            data-url="http://localhost/metadataTypeList.php?dataType=applicationTypes"
            data-pagination="true"
            data-search="true">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="id">Application Type ID</th>
                        <th data-field="typename">Application Type Name</th>
                        <th data-field="manage" data-formatter="manageFormatter" data-events="manageEvents">Manage</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Application Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="processDeleteMetadataItem.php?dataType=applicationTypes" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="typeId">Application Type ID</label>
                        <input type="hidden" id="typeId" name="typeId">
                        <div id="typeIdText"></div>
                    </div>
                    <div class="form-group">
                        <label for="typeName">Application Type Name</label>
                        <div id="typeNameText"></div>
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
            '<a class="edit" href="javascript:void(0)" title="Edit Application Type">',
            '<i class="fas fa-edit"></i>',
            '</a>  ',
            '<a class="delete" href="javascript:void(0)" title="Delete Application Type">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }
    window.manageEvents = {
        'click .edit': function (e, value, row, index) {
            url = "admin.php?tab=metadata&dataType=applicationTypes&action=edit&typeId=" + row.id;
            $(location).attr("href", url);
        },
        'click .delete': function (e, value, row, index) {
            //alert('Feature coming soon');
            $('#deleteModal').on('show.bs.modal', function (event) {
                $('#typeId').val(row.id);
                $('#typeIdText').text(row.id);
                $('#typeName').val(row.typename);
                $('#typeNameText').text(row.typename);
            });
            $('#deleteModal').modal();
        }
    }
</script>

<?php
}
?>