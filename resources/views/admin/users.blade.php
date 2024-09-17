@extends("dashboard")

@section('dashboard-content')

    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl">Users List</h1>

            {{-- <a href="{{ route('users.create') }}" class="bg-green-500 text-white py-2 px-4 rounded">Add New user</a> --}}
        </div>

        <!-- Users Table -->
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    {{-- <th scope="col">Image</th> --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        {{-- <th scope="row" class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</th> --}}
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        {{-- <td>
                            @if ($user->image)
                                <img src="{{ asset('images/users/' . $user->image) }}" alt="{{ $user->image }}"
                                     class="w-20 h-auto">
                            @else
                                No Image
                            @endif
                        </td> --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.editUser', $user->id) }}" class="text-yellow-600 bg-yellow-200 hover:bg-yellow-300 py-1 px-2 rounded text-sm">Edit</a>
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 bg-red-200 hover:bg-red-300 py-1 px-2 rounded text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
