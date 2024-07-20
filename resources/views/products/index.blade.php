@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('products.create') }}" class="btn btn-success">Create New Product</a>
            </div>
        </div>
    </div>
</section>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>Name</th>
    <th>Details</th>
    <th>Price</th>
    <th>Image</th>
    <th width="280px">Action</th>
</tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->detail }}</td>
        <td>{{ $product->price }}</td>
        <td><img src="{{ asset('image/' . $product->image) }}" width="100px"></td>
        <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <!-- <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a> -->
                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}"><i class="fa fa-pencil-alt"></i>
                </a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
