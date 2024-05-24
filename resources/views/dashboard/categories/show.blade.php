
@extends('layouts.master')

@section('title', $category->name)

@section('pageTitle')
    <h3> Category : {{ $category->name }}</h3>
@endsection
@section('content')

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @php
            $products = $category->products()->with('store')->latest()->paginate(2); // must use products() not products , first one returns the relation to make oprations on it , seconde one returns collection of data which i dont need here
        @endphp
        @forelse($products as $product)
        <tr>
            <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No products defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->withQueryString()->links('pagination::bootstrap-4') }}

@endsection
