@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-header">Edit category</div>
    <div class="card-body">
        <form id="category_form" method="POST" action="{{route('categories.update',['id'=>$category->id])}}">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Enter category name">
        </form>
    </div>
    <div class="card-footer">
        <button form="category_form" class="btn btn-primary">Save</button>
    </div>
</div>
@endsection
