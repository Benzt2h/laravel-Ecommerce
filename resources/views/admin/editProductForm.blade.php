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
    <h2>Edit Product</h2>
    <form action="/admin/updateProduct/{{$product->id}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{$product->name}}" name="name" id="name" placeholder="Product Name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" value="{{$product->description}}" name="description" id="description" placeholder="Description">
        </div>
        <div class="form-group">
            <label for="type">Category</label>
            <select class="form-control" name="category">
                    @foreach($categories as $category)
                    <option @if($category->id == $product->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" value="{{$product->price}}" name="price" id="price" placeholder="Price" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
