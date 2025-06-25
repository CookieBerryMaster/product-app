<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-pink-700 tracking-tight">
                {{ __('Products') }}
            </h2>

            <a href="{{ route('products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md 
                      font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 
                      focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Create Product') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-pink-200">
                    <thead class="bg-pink-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">{{ __('Price') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">{{ __('Category') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">{{ __('Description') }}</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4 text-sm text-pink-700">{{ $product->id }}</td>
                                <td class="px-6 py-4 text-sm text-pink-700">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-pink-700">${{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-pink-700">{{ $product->category?->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-pink-700">{{ $product->description ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-right space-x-2 flex justify-end">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="inline-flex items-center px-3 py-1 bg-cyan-400 text-white rounded-md text-xs font-semibold hover:bg-cyan-500 transition">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-pink-600 text-white rounded-md text-xs font-semibold hover:bg-pink-700 transition">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-pink-400">
                                    {{ __('No products found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Paginación si estás usando paginate() --}}
                {{-- <div class="mt-4 px-6"> {{ $products->links() }} </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
