@extends("dashboard")

@section('dashboard-content')

    <div class="container mx-auto py-4">

        <div>
            <form action="{{ route('admin.products') }}" method="GET">
                <div class="felx space-x-4">
                    {{-- filter with categories --}}
                    <select name="category_id"
                    class="bg-gray-100 text-gray-800 px-4 mx-3"
                    onchange="this.form.submit()"
                    >
                        <option value="">choose the categoy</option>
                        @foreach ($categories as $category  )
                            <option value="{{ $category->id }}"
                                {{ request('category_id')== $category->id ? 'selected' : '' }}
                                >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    {{-- filter with price --}}
                    <select name="order"
                    class="bg-gray-100 text-gray-800 px-4 mx-3"
                    onchange="this.form.submit()"
                    >
                        <option value="">Filter with price</option>
                        <option value="asc"
                        {{ request('order')== 'asc'  ? 'selected' : '' }}
                        >Low To high</option>
                        <option value="desc"
                        {{ request('order')== 'desc'  ? 'selected' : '' }}
                        >High To Low</option>



                    </select>
                </div>

            </form>
        </div>
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl">Products List</h1>

            {{-- <a href="{{ route('products.create') }}" class="bg-green-500 text-white py-2 px-4 rounded">Add New product</a> --}}
        </div>

        <!-- products Table -->
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
               
                    {{-- <th scope="col">Image</th> --}}
                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        {{-- <th scope="row" class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</th> --}}
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->price }}</td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name }}</td> --}}
                        {{-- <td>
                            @if ($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->image }}"
                                     class="w-20 h-auto">
                            @else
                                No Image
                            @endif
                        </td> --}}
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.editproduct', $product->id) }}" class="text-yellow-600 bg-yellow-200 hover:bg-yellow-300 py-1 px-2 rounded text-sm">Edit</a>
                            <form action="{{ route('admin.deleteproduct', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 bg-red-200 hover:bg-red-300 py-1 px-2 rounded text-sm">Delete</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
