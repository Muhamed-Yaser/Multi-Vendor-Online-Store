@extends('layouts.master')

@section('title', 'Edit Category')

@section('pageTitle')
    <h3 style="">Edit Category</h3>
@endsection

@section('content')

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <x-input label="Category Name" class="form-control" type="text" id="status" name="name"
            value="{{ $category->name }}" />

        <div class="form-group">
            <label for="name">Catetory parent:</label>
            <select type="text" name="parent_id" class="form-select">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach

            </select>
            @error('parent_id')
                <div class="alert alert-danger" style='width:27%; text-align:center;margin:.3%'>{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Catetory description:</label>
            <textarea type="text" name="description">
            {{ $category->description }}
        </textarea>
            @error('description')
                <div class="alert alert-danger" style='width:27%; text-align:center;margin:.3%'>{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Catetory image:</label>
            <input type="file" name="image" accept="image/*">
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
            @endif
            @error('image')
                <div class="alert alert-danger" style='width:27%; text-align:center;margin:.3%'>{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div>
                <x-radio name="status" id="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
            </div>
        </div>

        <button type="submit" class="submit-btn" style=" width: 200px;text-align: center">Update</button>
        </div>

    </form>

@endsection
