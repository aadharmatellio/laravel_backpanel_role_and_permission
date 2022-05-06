@extends('layouts.app-master')

@include('layouts.partials._datatableAssets')

@section('content')

<section class="content">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Filter
            </h3>
            <div class="card-tools">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mr-2">Add new user</a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="user" id="user" placeholder="Name" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email </label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" autocomplete="off" />
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <b>Listing</b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body mb-4">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="users-table">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable = $('#users-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('users.datatables') !!}",
            data: function(d) {
                d.name = $('#user').val();
                d.email = $('#email').val();
            }
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    if (data == 'Enabled') {
                        return "<span class='right badge badge-success p-1'>" + data + "</span>";
                    } else {
                        return "<span class='right badge badge-danger p-1'>" + data + "</span>";
                    }
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        order: [
            [0, 'desc']
        ],
        searching: false,
        // bLengthChange:false,
    });

    $('#user').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#email').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection