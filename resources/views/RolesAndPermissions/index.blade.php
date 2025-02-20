@extends('layouts.master')
@section('title', 'Roles And Permissions')

@section('main')

    <div class="main">


        <div class="user-controller">
            <h1 class="user-title">Roles and Permissions</h1>
            <a href="{{ url('roles\create') }}">Add New Role</a>
        </div>

        <div class="roles-table">
            <table>
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="" class="btn btn-primary">Edit</a>

                                <!-- Delete Button -->
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

@endsection
