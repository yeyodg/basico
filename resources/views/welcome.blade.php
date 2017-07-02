@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6">
            <h3>Sing Up</h3>
            <form action="{{ route('singup') }}" method="post">
                <div class="form-group  {{$errors->has('email') ? 'has-error' : ''}}">
                    <label>Email</label>
                    <input type="text" 
                    name="email" 
                    id="email" 
                    class="form-control"
                    value="{{Request::old('email')}}">
                </div>
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                    <label>Name</label>
                    <input type="text" 
                    name="name" id="name" 
                    class="form-control"
                    value="{{Request::old('name')}}">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label>Password</label>
                    <input type="password" 
                    name="password" 
                    id="password" 
                    class="form-control"
                    value="{{Request::old('name')}}">
                </div>
                <button type="submit" class="btn bt-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col-md-6">
            <h3>Sing In</h3>
            <form action="{{ route('singin') }}" method="post">
            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label>Email</label>
                <input type="text" 
                name="email" 
                id="email" 
                class="form-control"
                value="{{Request::old('email')}}">
            </div>
            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                <label>Password</label>
                <input type="password" 
                name="password" 
                id="password" 
                class="form-control"
                value="{{Request::old('password')}}">
            </div>
                <button type="submit" class="btn bt-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@endsection