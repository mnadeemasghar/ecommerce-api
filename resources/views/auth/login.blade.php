@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card">
    <div class="card-header">Login</div>
    <div class="card-body">
        <form id="login" method="POST" action="{{route('login_attempt')}}">
            @csrf
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" placeholder="Please enter email" />
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" placeholder="Please enter password" />
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" form="login" class="btn btn-success">Login</button>
    </div>
</div>
@endsection
