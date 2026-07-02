<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Activity Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('activity_categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New</a>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Sort Order</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activity_categories as $item)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $item->id }}</td>
                                    <td class="px-4 py-2">{{ $item->name }}</td>
                                    <td class="px-4 py-2">{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="px-4 py-2">{{ $item->sort_order }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex items-center gap-2 justify-end">
    <a href="{{ route('activity_categories.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
    <form action="{{ route('activity_categories.destroy', $item) }}" method="POST" class="inline m-0" onsubmit="return confirm('Are you sure you want to delete this?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
    </form>
</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
