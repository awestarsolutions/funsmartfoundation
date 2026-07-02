<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Activity Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('activity_categories.update', $item) }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ $item->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                        </div>
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ $item->sort_order }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                        </div>
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="status" class="rounded border-gray-300 text-indigo-600 shadow-sm" value="1" {{ $item->status ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Active</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                    
                    <form method="POST" action="{{ route('activity_categories.destroy', $item) }}" class="mt-4" onsubmit="return confirm('Are you sure you want to delete this?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
