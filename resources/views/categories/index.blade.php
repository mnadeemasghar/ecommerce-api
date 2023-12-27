@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<a href="{{route('categories.create')}}" class="btn btn-primary mb-5">Add Category</a>
<table class="table table-bordered">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>
                {{ $category->id }}
            </td>
            <td>
                {{ $category->name }}
            </td>
            <td>
                <a href="{{route('categories.show',['id'=>$category->id])}}" class="btn btn-primary">View</a>
                <a href="{{route('categories.edit',['id'=>$category->id])}}" class="btn btn-info">Edit</a>
                <form action="{{route('categories.destroy',['id'=>$category->id])}}" method="post">@csrf<button class="btn btn-danger">Delete</button></form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
