<?php
$models = [
    'blog_categories' => ['name' => 'text', 'slug' => 'text'],
    'blog_posts' => ['title' => 'text', 'slug' => 'text', 'featured_image' => 'file', 'content' => 'textarea', 'meta_title' => 'text', 'meta_description' => 'textarea', 'is_published' => 'checkbox', 'published_at' => 'date'],
    'galleries' => ['title' => 'text', 'image_path' => 'file', 'group' => 'text', 'sort_order' => 'number']
];

foreach ($models as $folder => $fields) {
    $dir = "resources/views/admin/{$folder}";
    $modelName = str_replace('_', ' ', $folder);
    
    // Index
    $index = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">{$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><a href=\"{{ route('{$folder}.create') }}\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Create New</a><table class=\"table-auto w-full mt-4\"><thead><tr><th>ID</th><th>Actions</th></tr></thead><tbody>@foreach(\$$folder as \$item)<tr><td>{{ \$item->id }}</td><td><a href=\"{{ route('{$folder}.edit', \$item) }}\">Edit</a></td></tr>@endforeach</tbody></table></div></div></div></div></x-app-layout>";
    file_put_contents("$dir/index.blade.php", $index);

    // Create
    $create = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Create {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.store') }}\" enctype=\"multipart/form-data\">@csrf";
    foreach($fields as $name => $type) {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" /></div>";
    }
    $create .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Save</button></div></form></div></div></div></div></x-app-layout>";
    file_put_contents("$dir/create.blade.php", $create);

    // Edit
    $edit = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Edit {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.update', \$item) }}\" enctype=\"multipart/form-data\">@csrf @method('PUT')";
    foreach($fields as $name => $type) {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><input type=\"$type\" name=\"$name\" value=\"{{ \$item->$name }}\" class=\"mt-1 block w-full\" /></div>";
    }
    $edit .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Update</button></div></form></div></div></div></div></x-app-layout>";
    file_put_contents("$dir/edit.blade.php", $edit);
}
