@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('categories.create') }}" class="btn btn-success">New Category</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <!-- <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap category">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th width="100">Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
            <div class="card-footer clearfix">
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
@section('customejs')
<script>
    $(function() {
    var table = $('.category').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('categories.index') }}",
    columns: [
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'slug',
            name: 'slug',
        },
        
        {
            data: 'status',
            name: 'status',
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },

    ]
});

});

$(document).ready(function() {
    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

</script>
@endsection