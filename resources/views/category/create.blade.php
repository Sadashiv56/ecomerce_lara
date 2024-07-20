@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid my-2">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Create Category</h1>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="{{ route("categories.index") }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="container-fluid">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{ route("categories.store") }}" method="post" id="categoryform" name="categoryform">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name">Category Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 pt-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route("categories.create") }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
            </form>
                <!-- /.content -->
@endsection
@section('customejs')
<script>
    $('input[name=name]').on('blur', function () {
    var slugElm = $('input[name=slug]');
    if (slugElm.val()) { return; }
    // slugElm.val(this.value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, ''));
    slugElm.val(this.value.toLowerCase().replace(this.value, this.value).replace(/^-+|-+$/g, '')
        .replace(/\s/g, '-'));
    })
    $(document).ready(function() {
                $("#categoryform").validate({
                    rules: {
                        name: {
                            required: true,
                        },

                        status: {
                            required: true,
                        },

                    },
                    messages: {
                        name: {
                            required: "Please enter  Category",
                        },
                        status: {
                            required: "Please enter Subcatrgory Name",
                        },
                    },
                });
            });
</script>
@endsection
