<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="py-5 bg-red-500 text-white font-bold">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                
                <div class="item-product flex flex-col justify-between gap-y-10 p-5 border-b border-gray-300">
                    
                    <img 
                        src="{{ Storage::url($order->product->cover) }}" 
                        class="h-auto w-[300px] object-cover rounded-md shadow-md" 
                        alt="Product Cover"
                    >

                    
                    <div>
                        <h3 class="font-bold text-lg">{{ $order->product->name }}</h3>
                        <p class="text-gray-600">{{ $order->product->category->name }}</p>
                    </div>

                    
                    <div class="flex flex-row gap-x-5 items-center">
                        <p class="mb-2 text-gray-900 font-semibold">
                            Rp {{ $order->total_price }}
                        </p>
                        
                        @if($order->is_paid)
                            <span class="py-2 px-5 rounded-full bg-green-500 text-white font-semibold">
                                Paid
                            </span>
                        @else
                            <span class="py-2 px-5 rounded-full bg-orange-500 text-white font-semibold">
                                Pending
                            </span>
                        @endif
                    </div>

                    <img 
                        src="{{ Storage::url($order->proof) }}" 
                        class="h-auto w-[300px] object-cover rounded-md shadow-md" 
                        alt="Proof"
                    >

                    {{-- Actions --}}
                    <div class="flex flex-row gap-x-3">
                        <form action="{{route('admin.product_orders.update', $order)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="py-2 px-4 bg-indigo-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                                Approve Now!
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
