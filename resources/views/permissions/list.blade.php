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
                        <label>Permission </label>
                        <input type="text" name="permission" id="permission" placeholder="Permission" class="form-control" autocomplete="off" />
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
                <table class="table table-striped table-bordered table-sm" id="permission-table">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Guard</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable = $('#permission-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('permissions.datatables') !!}",
            data: function(d) {
                d.permission = $('#permission').val();
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
                data: 'guard_name',
                name: 'guard_name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        order: [
            [0, 'desc']
        ],
        searching: false,
        // bLengthChange:false,
    });

    $('#permission').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection