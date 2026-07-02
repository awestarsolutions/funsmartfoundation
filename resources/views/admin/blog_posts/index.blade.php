<x-app-layout><x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">blog posts</h2></x-slot><div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900"><a href="{{ route('blog_posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New</a><table class="table-auto w-full mt-4"><thead><tr><th>ID</th><th>Actions</th></tr></thead><tbody>@foreach($blog_posts as $item)<tr><td>{{ $item->id }}</td><td><div class="flex items-center gap-2 justify-end">
    <a href="{{ route('blog_posts.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
    <form action="{{ route('blog_posts.destroy', $item) }}" method="POST" class="inline m-0" onsubmit="return confirm('Are you sure you want to delete this?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
    </form>
</div></td></tr>@endforeach</tbody></table></div></div></div></div></x-app-layout>