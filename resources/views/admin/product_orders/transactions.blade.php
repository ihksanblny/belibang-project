<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                
                @forelse ($my_transactions as $transaction)
                    <div class="item-product flex flex-row justify-between items-center p-5 border-b border-gray-300">
                        {{-- Product Cover --}}
                        <img src="{{ Storage::url($transaction->product->cover) }}" class="h-[100px] w-auto">

                        {{-- Product Details --}}
                        <div>
                            <h3 class="font-bold text-lg">{{ $transaction->product->name }}</h3>
                            <p class="text-gray-600">{{ $transaction->product->category->name}}</p>
                        </div>

                        {{-- Product Price --}}
                        <div>
                            <p class="text-gray-500 text-sm">Total Price :</p>
                            <p class="text-gray-900 font-semibold">Rp {{number_format($transaction->total_price)}}</p>
                        </div>

                        <div>
                        @if($transaction->is_paid)
                            <p class="text-gray-500 text-sm">Status :</p>
                            <span class="py-1 px-3 rounded-full bg-green-500 text-white font-semibold text-sm">
                                Paid
                            </span>
                        @else
                        <span class="py-1 px-3 rounded-full bg-orange-500 text-white font-semibold text-sm">
                                Pending
                            </span>
                        @endif
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-row gap-x-3">
                            {{-- Edit Button --}}
                            <a href="{{route('admin.product_orders.transactions.details', $transaction)}}" class="py-2 px-4 bg-indigo-500 text-white rounded-md shadow hover:bg-indigo-600 transition">
                                Details
                            </a>
                        </div>
                    </div>
                @empty
                    {{-- No Products Found --}}
                    <p class="py-3 px-5 text-gray-500">No transactions available yet</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
