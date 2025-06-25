<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-pink-700 tracking-tight">
                {{ __('Categories') }}
            </h2>

            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md 
                      font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 
                      focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Create Category') }}
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">
                                {{ __('ID') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="px-6 py-3"></th> <!-- acciones -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pink-100">
                        @forelse ($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-pink-700">
                                    {{ $category->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-pink-700">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-pink-700">
                                    {{ $category->description ?? '-' }}
                                </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                    <a href="{{ route('categories.edit', $category) }}"
                                    class="inline-flex items-center px-3 py-1 bg-cyan-400 text-white rounded-md text-xs font-semibold hover:bg-cyan-500 transition">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Eliminar esta categoría?');">
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
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-pink-400">
                                    {{ __('No categories found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Paginación si estás usando paginate() --}}
                {{-- <div class="mt-4 px-6">
                    {{ $categories->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
