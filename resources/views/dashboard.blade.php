<x-app-layout>

    <x-slot name="header">
        <div class="flex">
            <!-- Sidebar on the left (links aligned vertically) -->
            <div class="w-1/4 bg-gray-100 dark:bg-gray-800 p-4 h-screen">
                <nav class="space-y-4">
                    <a class="block font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" 
                       href="{{ route('admin.users') }}">Users</a>
                    <a class="block font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" 
                       href="{{ route('admin.products') }}">Products</a>
                </nav>
            </div>

            <!-- The rest of the content -->
            <div class="py-12 w-3/4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            @yield('dashboard-content')
                        </div>
                    </div>
                </div>
            </div>
    </x-slot>

    

</x-app-layout>
