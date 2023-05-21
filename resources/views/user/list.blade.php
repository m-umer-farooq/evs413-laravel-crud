@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session()->has('success'))
            <div class="row mt-5">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('errors'))
            <div class="row mt-5">
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <a href="user-add" class="btn btn-primary">Add New</a>
            </div>
        </div>

    @if (!empty($users))
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="user-edit-{{ $user->id }}" class="icon-edit"></a>&nbsp;
                    <a href="user-delete-{{ $user->id }}" class="icon-trash"></a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
      @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    No Record Found
                </div>
            </div>
        </div>
      @endif
    </div>
    @endsection