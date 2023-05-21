@extends('layouts.app')
@section('content')
<div class="container">

    {{-- @if (count($errors) > 0)
        <div class="row">
            <div class="col-lg-12 mt-6">
         <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
        </div>
        </div>
      @endif --}}




    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="row mt-5">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="row mt-5">
                <h4 class="mb-3 mt-12">Edit User</h4>
            </div>
            <form action="user-edit-{{ $user->id }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" value="">
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="Update">
                    &nbsp;
                    <input type="button" id="btn_back" name="btn_back" class="btn btn-primary" value="Back" onclick="location.href='user-list'">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection