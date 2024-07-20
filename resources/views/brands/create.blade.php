@extends('layouts.app')
@section('content')
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Brand</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="brands.html" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
				</section>
				<section class="content">
					<div class="container-fluid">
					<form action="{{ route("brands.store")}}" id="createBrandForm" name="createBrandForm" action="" method="post">
						@csrf
						<div class="card">
							<div class="card-body">								
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
											<input type="text" readonly  name="slug" id="slug" class="form-control" placeholder="Slug">	
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
							<a href="{{ route("brands.create") }}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</form>
					</div>
					<!-- /.card -->
				</section>
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
                $("#createBrandForm").validate({
                    rules: {
                        name: {
                            required: true,
                        },

                        slug: {
                            required: true,
                        },
                        status: {
                            required: true,
                        },

                    },
                    messages: {
                        name: {
                            required: "Please enter  brands",
                        },
                        slug: {
                            required: "Please enter slug",
                        },
                        status: {
                            required: "Please enter status",
                        },
                    },
                });
            });
</script>
@endsection
