@extends('layouts.app')

@section('contents')

<div class="container mt-5">
    <h2 class="mb-4">User Menu</h2>

    <!-- Model Add a New User -->
    <div class="card mb-4">
        <div class="card-header">Add a New User</div>
        <div class="card-body">
            <form action="{{ route('users.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-user-plus me-2"></i>Add User
                </button>
            </form>
        </div>
    </div>

    <!-- Menu of Current Users -->
    <div class="card">
        <div class="card-header">Current Users</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td> <!-- View just a user name-->
                        <td>
                            <!-- Button Delete a User -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash me-2"></i>Delete
                                </button>
                            </form>

                            <!-- Button Edit a User -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                                <i class="fa fa-edit me-2"></i>Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

