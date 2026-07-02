<?php
$folder = 'activities';
$modelName = 'Activities';

$fields = [
    'name' => 'text',
    'short_description' => 'textarea',
    'detailed_description' => 'textarea',
    'objectives' => 'textarea',
    'expected_impact' => 'textarea',
    'duration' => 'text',
    'location' => 'text',
    'beneficiary_information' => 'textarea',
    'status' => 'select', // draft, published, archived
    'cover_image' => 'file',
    'pdf_brochure' => 'file'
];

$dir = "resources/views/admin/{$folder}";
if (!is_dir($dir)) mkdir($dir, 0777, true);

// Index
$index = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">{$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><a href=\"{{ route('{$folder}.create') }}\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Create New</a><table class=\"table-auto w-full mt-4\"><thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead><tbody>@foreach(\$$folder as \$item)<tr><td>{{ \$item->id }}</td><td>{{ \$item->name }}</td><td>{{ optional(\$item->category)->name }}</td><td>{{ ucfirst(\$item->status) }}</td><td><a href=\"{{ route('{$folder}.edit', \$item) }}\" class=\"text-indigo-600\">Edit</a></td></tr>@endforeach</tbody></table></div></div></div></div></x-app-layout>";
file_put_contents("$dir/index.blade.php", $index);

// Create
$create = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Create {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.store') }}\" enctype=\"multipart/form-data\">@csrf";
$create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Category</label><select name=\"activity_category_id\" class=\"mt-1 block w-full\"><option value=\"\">None</option>@foreach(\$categories as \$cat)<option value=\"{{ \$cat->id }}\">{{ \$cat->name }}</option>@endforeach</select></div>";
foreach($fields as $name => $type) {
    if ($type === 'select') {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><select name=\"$name\" class=\"mt-1 block w-full\"><option value=\"draft\">Draft</option><option value=\"published\">Published</option><option value=\"archived\">Archived</option></select></div>";
    } elseif ($type === 'textarea') {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><textarea name=\"$name\" class=\"mt-1 block w-full\"></textarea></div>";
    } else {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" /></div>";
    }
}
$create .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Save</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/create.blade.php", $create);

// Edit
$edit = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Edit {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.update', \$item) }}\" enctype=\"multipart/form-data\">@csrf @method('PUT')";
$edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Category</label><select name=\"activity_category_id\" class=\"mt-1 block w-full\"><option value=\"\">None</option>@foreach(\$categories as \$cat)<option value=\"{{ \$cat->id }}\" {{ \$item->activity_category_id == \$cat->id ? 'selected' : '' }}>{{ \$cat->name }}</option>@endforeach</select></div>";
foreach($fields as $name => $type) {
    if ($type === 'select') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><select name=\"$name\" class=\"mt-1 block w-full\"><option value=\"draft\" {{ \$item->$name == 'draft' ? 'selected' : '' }}>Draft</option><option value=\"published\" {{ \$item->$name == 'published' ? 'selected' : '' }}>Published</option><option value=\"archived\" {{ \$item->$name == 'archived' ? 'selected' : '' }}>Archived</option></select></div>";
    } elseif ($type === 'textarea') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><textarea name=\"$name\" class=\"mt-1 block w-full\">{{ \$item->$name }}</textarea></div>";
    } elseif ($type === 'file') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" /> @if(\$item->$name) <p class=\"text-sm text-gray-500\">Current file uploaded.</p> @endif </div>";
    } else {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">$name</label><input type=\"$type\" name=\"$name\" value=\"{{ \$item->$name }}\" class=\"mt-1 block w-full\" /></div>";
    }
}
$edit .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Update</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/edit.blade.php", $edit);
echo "done";
