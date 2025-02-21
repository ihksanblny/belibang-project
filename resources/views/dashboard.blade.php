<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <!-- Total Orders -->
                <div class="bg-blue-500 text-white rounded-lg shadow-md p-5 flex items-center justify-between transform transition duration-300 hover:scale-105">
                    <div>
                        <h3 class="text-lg font-semibold">Total Orders</h3>
                        <p class="text-2xl font-bold">{{ $total_order_success->count() }}</p>
                    </div>
                </div>
                
                <!-- Total Revenue -->
                <div class="bg-green-500 text-white rounded-lg shadow-md p-5 flex items-center justify-between transform transition duration-300 hover:scale-105">
                    <div>
                        <h3 class="text-lg font-semibold">Total Revenue</h3>
                        <p class="text-2xl font-bold">Rp. {{ number_format($my_revenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Product List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @forelse($my_products as $product)
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col transform transition duration-300 hover:scale-105">
                        <img src="{{ Storage::url($product->cover) }}" class="h-32 w-full object-cover rounded-md mb-3" alt="{{ $product->name }}">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No products available</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
