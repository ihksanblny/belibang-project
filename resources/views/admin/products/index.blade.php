<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="py-2 bg-red-500 text-white font-bold rounded-md p-2">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{route('admin.products.create')}}" class="mb-4 inline-block py-3 px-5 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 transition">
                    Add New Product
                </a>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="bg-white rounded-lg shadow-md p-4 flex flex-col">
                            <img src="{{Storage::url($product->cover)}}" class="h-40 w-full object-cover rounded-md mb-4" alt="">
                            <h3 class="text-lg font-semibold mb-2">{{$product->name}}</h3>
                            <p class="text-gray-600 mb-1">Category: {{$product->category->name}}</p>
                            <p class="text-gray-600 mb-2">Creator: {{$product->creator->name}}</p>
                            <p class="text-xl font-bold text-indigo-600 mb-4">{{$product->price}}</p>
                            <div class="flex justify-between">
                                <a href="{{route('admin.products.edit', $product)}}" class="py-2 px-4 bg-indigo-500 text-white rounded-md shadow hover:bg-indigo-600 transition">
                                    Edit
                                </a>
                                <form action="{{route('admin.products.destroy', $product)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded-md shadow hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="py-3 px-5">No products</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>