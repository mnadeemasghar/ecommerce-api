@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<div class="card">
    <div class="card-header">{{ $category->name }}</div>
</div>
@endsection
