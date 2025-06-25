<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white tracking-tight">
                {{ __('Edit Product') }}
            </h2>

            <a href="{{ route('products.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md
                      font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700
                      focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to list') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product) }}" method="POST"
                  class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        {{ __('Name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $product->name) }}"
                           class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                  dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" />
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        {{ __('Price') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="price" required step="0.01"
                           value="{{ old('price', $product->price) }}"
                           class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                  dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" />
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        {{ __('Category') }}
                    </label>
                    <select name="category_id" id="category_id"
                            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                   dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                        {{ __('Description') }}
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 
                                     dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md
                                   font-semibold text-white uppercase tracking-widest hover:bg-indigo-700
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
