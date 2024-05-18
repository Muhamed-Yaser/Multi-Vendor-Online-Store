@extends('layouts.master')

@section('title', 'Trashed Categories')

@section('pageTitle')
<h3>All Trashed Categories</h3>
@endsection

@section('content')

<div class="m-3">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-info">Back</a>
</div>

<x-alert type="success" />
<x-alert type="info" />

<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <input name="name" placeholder="Name" class="mx-2" value="{{ request('name') }}" />
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Status</th>
            <th>Deleted At</th>
            <th colspan="2">Oprations</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $category->sequential_id }}</td>
            <td><img src="{{ asset('storage/'.$category->image)}}" alt="" height="50"></td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->deleted_at }}</td>

            <td>  <form action="{{ route('categories.restore', $category->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('categories.forceDelete', $category->id) }}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No categories defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $categories->withQueryString()->links('pagination::bootstrap-4') }}
@endsection
