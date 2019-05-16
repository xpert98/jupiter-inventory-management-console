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
        <i class="fas fa-user-tie" style="font-size: 64px;"></i>
    </div>
    <div class="col-md-auto">

    <a href="admin.php?tab=metadata&dataType=applicationOwners&action=add" class="btn btn-primary">Add Application Owner</a>

        <div style="width: 800px;">
            <table
            data-toggle="table"
            data-url="http://localhost/metadataTypeList.php?dataType=applicationOwners"
            data-pagination="true"
            data-search="true">
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="id">Application Owner ID</th>
                        <th data-field="ownername">Application Owner Name</th>
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
                <h5 class="modal-title">Delete Application Owner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="processDeleteMetadataItem.php?dataType=applicationOwners" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="ownerId">Application Owner ID</label>
                        <input type="hidden" id="ownerId" name="ownerId">
                        <div id="ownerIdText"></div>
                    </div>
                    <div class="form-group">
                        <label for="ownerName">Application Owner Name</label>
                        <div id="ownerNameText"></div>
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
            '<a class="edit" href="javascript:void(0)" title="Edit Application Owner">',
            '<i class="fas fa-edit"></i>',
            '</a>  ',
            '<a class="delete" href="javascript:void(0)" title="Delete Application Owner">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }
    window.manageEvents = {
        'click .edit': function (e, value, row, index) {
            url = "admin.php?tab=metadata&dataType=applicationOwners&action=edit&ownerId=" + row.id;
            $(location).attr("href", url);
        },
        'click .delete': function (e, value, row, index) {
            $('#deleteModal').on('show.bs.modal', function (event) {
                $('#ownerId').val(row.id);
                $('#ownerIdText').text(row.id);
                $('#ownerName').val(row.ownername);
                $('#ownerNameText').text(row.ownername);
            });
            $('#deleteModal').modal();
        }
    }
</script>

<?php
}
?>