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

$currentPage = "antecessors";
include 'header.php';

if (isset($_SESSION['username'])) {
?>

<h1><i class="fas fa-puzzle-piece"></i> Antecessors</h1>

<div class="alert alert-info" role="alert">
    <p>Antecessors are units of primitive inventory data that can be used to create Application records.  These &quot;proto-applications&quot; are collected by Collector service instances.
    <p>Import an Antecessor to create an Application record using the <i class="fa fa-dolly"></i> icon.
</div>

<table
data-toggle="table"
data-url="http://localhost/antecessorList.php"
data-pagination="true"
data-search="true">
    <thead>
        <tr>
            <th data-sortable="true" data-field="_id">Antecessor ID</th>
            <th data-field="commonName">Common Name</th>
            <th data-field="primaryOwner">Primary Owner</th>
            <th data-field="manage" data-formatter="manageFormatter" data-events="manageEvents">Manage</th>
        </tr>
    </thead>
</table>

<div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="viewModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Raw Antecessor Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="rawAntecessorData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="importModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Antecessor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="importAntecessorForm.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="commonName">Application Common Name</label>
                        <input type="text" class="form-control" id="commonName" name="commonName">
                    </div>
                    <div class="form-group">
                        <label for="primaryOwner">Primary Application Owner</label>
                        <input type="text" class="form-control" id="primaryOwner" name="primaryOwner">
                    </div>
                    <input type="hidden" id="aId" name="aId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Next &gt;</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Antecessor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="deleteAntecessor.php" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="aCommonName">Common Name</label>
                        <input type="hidden" id="aCommonName" name="aCommonName">
                        <div id="aCommonNameText"></div>
                    </div>
                    <div class="form-group">
                        <label for="antecessorId">Antecessor ID</label>
                        <input type="hidden" id="antecessorId" name="antecessorId">
                        <div id="antecessorIdText"></div>
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
            '<a class="view" href="javascript:void(0)" title="View Raw Data">',
            '<i class="fa fa-binoculars"></i>',
            '</a>  ',
            '<a class="import" href="javascript:void(0)" title="Import To Inventory">',
            '<i class="fa fa-dolly"></i>',
            '</a>  ',
            '<a class="delete" href="javascript:void(0)" title="Delete">',
            '<i class="fa fa-trash"></i>',
            '</a>'
        ].join('')
    }
    window.manageEvents = {
        'click .view': function (e, value, row, index) {
            $('#viewModal').on('show.bs.modal', function (event) {
                $('#rawAntecessorData').text(JSON.stringify(row));
            });
            $('#viewModal').modal();
        },
        'click .import': function (e, value, row, index) {
            $('#importModal').on('show.bs.modal', function (event) {
                $('#aId').val(row._id);
                $('#commonName').val(row.commonName);
                $('#primaryOwner').val(row.primaryOwner);
            });
            $('#importModal').modal();
        },
        'click .delete': function (e, value, row, index) {
            $('#deleteModal').on('show.bs.modal', function (event) {
                $('#antecessorId').val(row._id);
                $('#antecessorIdText').text(row._id);
                $('#aCommonName').val(row.commonName);
                $('#aCommonNameText').text(row.commonName);
            });
            $('#deleteModal').modal();
        }
    }
</script>


<?php
}

include 'footer.php';
?>