@extends('layouts.master')

@section('title', 'Edit Product')

@section('pageTitle')
    <h3>Edit Product</h3>
@endsection

@section('content')

<x-alert type="success" />
<x-alert type="info" />

<div class="mb-5">
    <a href="{{ route('dashboard.products.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back to Products</a>
</div>

<form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <option value="active" @selected(old('status', $product->status) == 'active')>Active</option>
            <option value="draft" @selected(old('status', $product->status) == 'draft')>Draft</option>
            <option value="archived" @selected(old('status', $product->status) == 'archived')>Archived</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" name="tags" class="form-control" value="{{ old('tags', $product->tags->pluck('name')->implode(',')) }}">
        <small class="form-text text-muted">Enter tags separated by commas.</small>
    </div>

    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image" class="form-control-file">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="" height="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
</form>

@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector(['name=tags']),
    tagify = new Tagify (inputElm);
</script>

@endsection
