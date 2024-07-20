@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Sub Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route("subcategory.index")}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
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
        <form action="{{ route("subcategory.store") }}" method="post" id="subcategoryform" name="subcategoryform">
            @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name">SubCategory</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    @if ($category->status == 1) <!-- Assuming 1 represents active status -->
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button class="btn btn-primary">Create</button>
            <a href="subcategory.html" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </div>
    <!-- /.card -->
</section>
</form>
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
                $("#subcategoryform").validate({
                    rules: {
                        category_id: {
                            required: true,
                        },

                        name: {
                            required: true,
                        },

                    },
                    messages: {
                        category_id: {
                            required: "Please enter  Category",
                        },
                        name: {
                            required: "Please enter Subcatrgory Name",
                        },
                    },
                });
            });
       
</script>
@endsection
