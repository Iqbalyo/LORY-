<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Trash Users</h2>
    </x-slot>

    <div class="p-6">

        @foreach($users as $user)
            <div class="border p-3 mb-2 flex justify-between">
                <div>
                    {{ $user->name }} ({{ $user->email }})
                </div>

                <div class="flex gap-2">

                    <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <button class="bg-green-500 text-white px-3 py-1 rounded">
                            Restore
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.users.forceDelete', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Permanent delete?')"
                            class="bg-red-600 text-white px-3 py-1 rounded">
                            Force Delete
                        </button>
                    </form>

                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>