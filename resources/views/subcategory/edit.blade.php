@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Sub Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="subcategory.html" class="btn btn-primary">Back</a>
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
        <form action="{{ route('subcategory.update',$subcategory->id) }}" method="post" id="subcategoryform" name="subcategoryform">
            @csrf
            @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name">Category</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach ($subcategory as $sub )
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ $subcategory->name }}"  class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ $subcategory->slug }}" class="form-control" placeholder="Slug">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button class="btn btn-primary">Create</button>
            <a href="{{ route("subcategory.index") }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
</script>
@endsection
