<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white tracking-tight">
                {{ __('Products') }}
            </h2>

            <a href="{{ route('products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md 
                      font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 
                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
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

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Price') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Category') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Description') }}</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $product->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    {{ $product->category?->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $product->description ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    {{ __('No products found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Si usas paginación: --}}
                {{-- {{ $products->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
