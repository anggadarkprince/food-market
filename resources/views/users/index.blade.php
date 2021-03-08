<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('users.create') }}" class="py-2 px-4 rounded bg-green-500 text-white hover:bg-green-600 font-bold">
                    Create User
                </a>
            </div>
            <div class="bg-white sm:rounded-md shadow p-4 mb-4">
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="border px-6 py-2 text-center">No</th>
                        <th class="border px-6 py-2">Name</th>
                        <th class="border px-6 py-2">Email</th>
                        <th class="border px-6 py-2">Role</th>
                        <th class="border px-6 py-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td class="border px-6 py-2 w-20 text-center">{{ $users->firstItem() + $index }}</td>
                        <td class="border px-6 py-2">
                            <img src="{{ url($user->profile_photo_url) }}" class="w-8 h-8 object-cover rounded-md inline-block mr-2" alt="Photo">
                            {{ $user->name }}
                        </td>
                        <td class="border px-6 py-2">{{ $user->email }}</td>
                        <td class="border px-6 py-2 text-center">{{ $user->role }}</td>
                        <td class="border px-6 py-2 text-center">
                            <a href="{{ route('users.show', $user->id) }}" class="inline-block bg-blue-500 hover:bg-blue:600 text-white font-bold py-1 px-2 rounded">
                                Show
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}" class="inline-block bg-blue-500 hover:bg-blue:600 text-white font-bold py-1 px-2 rounded">
                                Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" class="inline-block" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="inline-block bg-red-500 hover:bg-red:600 text-white font-bold py-1 px-2 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                No data available
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
