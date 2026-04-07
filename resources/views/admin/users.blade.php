<x-app-layout>
    <div class="container">
        <h1>Manage Users</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Change Role</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                        <td>
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}">
                                @csrf
                                @method('PATCH')

                                <select name="role">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>

                                <button type="submit">Update</button>
                            </form>
                        </td>

                        <td>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroyUser', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Delete this user?')">
                                        Delete
                                    </button>
                                </form>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        {{ $users->links() }}
    </div>
</x-app-layout>