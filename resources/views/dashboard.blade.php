<x-app-layout>

    
    <x-slot name="header">
      
        <a  class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" 
        href="{{ route('admin.users') }}">Users</a>
        <a  class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mx-5" 
        href="{{ route('admin.products') }}">Prodcutrs</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                 @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
