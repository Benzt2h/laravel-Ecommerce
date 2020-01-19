@extends('layouts.admin')
@section('body')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="table-responsive">
    <h2>Current Image</h2>
    <div>
        <img width="150px" height="150px" src="{{asset('storage')}}/product_image/{{$product->image}}" alt="">
    </div>
    <h2>Edit Product Image</h2>
    <form action="/admin/updateProductImage/{{$product->id}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control"  name="image" id="image" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
