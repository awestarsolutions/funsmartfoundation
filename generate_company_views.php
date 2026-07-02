<?php
$folder = 'companies';
$modelName = 'Companies';

$fields = [
    'name' => 'text',
    'industry' => 'text',
    'primary_poc_name' => 'text',
    'poc_email' => 'email',
    'poc_phone' => 'text',
    'status' => 'checkbox',
    'logo' => 'file'
];

$dir = "resources/views/admin/{$folder}";
if (!is_dir($dir)) mkdir($dir, 0777, true);

// Index
$index = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">{$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><a href=\"{{ route('{$folder}.create') }}\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Create New</a><table class=\"table-auto w-full mt-4\"><thead><tr><th>ID</th><th>Name</th><th>Industry</th><th>POC</th><th>Status</th><th>Actions</th></tr></thead><tbody>@foreach(\$$folder as \$item)<tr><td>{{ \$item->id }}</td><td>{{ \$item->name }}</td><td>{{ \$item->industry }}</td><td>{{ \$item->primary_poc_name }}<br><span class=\"text-xs text-gray-500\">{{ \$item->poc_email }}</span></td><td>{{ \$item->status ? 'Active' : 'Inactive' }}</td><td><a href=\"{{ route('{$folder}.edit', \$item) }}\" class=\"text-indigo-600\">Edit</a></td></tr>@endforeach</tbody></table></div></div></div></div></x-app-layout>";
file_put_contents("$dir/index.blade.php", $index);

// Create
$create = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Create {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.store') }}\" enctype=\"multipart/form-data\">@csrf";
$create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Linked Corporate User</label><select name=\"user_id\" class=\"mt-1 block w-full\"><option value=\"\">None</option>@foreach(\$users as \$u)<option value=\"{{ \$u->id }}\">{{ \$u->name }} ({{ \$u->email }})</option>@endforeach</select></div>";
foreach($fields as $name => $type) {
    if ($type === 'checkbox') {
        $create .= "<div class=\"mt-4\"><label class=\"inline-flex items-center\"><input type=\"checkbox\" name=\"$name\" class=\"rounded border-gray-300 text-indigo-600 shadow-sm\" value=\"1\" checked><span class=\"ml-2 text-sm text-gray-600 capitalize\">" . str_replace('_', ' ', $name) . "</span></label></div>";
    } else {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" /></div>";
    }
}
$create .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Save</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/create.blade.php", $create);

// Edit
$edit = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Edit {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.update', \$item) }}\" enctype=\"multipart/form-data\">@csrf @method('PUT')";
$edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Linked Corporate User</label><select name=\"user_id\" class=\"mt-1 block w-full\"><option value=\"\">None</option>@foreach(\$users as \$u)<option value=\"{{ \$u->id }}\" {{ \$item->user_id == \$u->id ? 'selected' : '' }}>{{ \$u->name }} ({{ \$u->email }})</option>@endforeach</select></div>";
foreach($fields as $name => $type) {
    if ($type === 'checkbox') {
        $edit .= "<div class=\"mt-4\"><label class=\"inline-flex items-center\"><input type=\"checkbox\" name=\"$name\" class=\"rounded border-gray-300 text-indigo-600 shadow-sm\" value=\"1\" {{ \$item->$name ? 'checked' : '' }}><span class=\"ml-2 text-sm text-gray-600 capitalize\">" . str_replace('_', ' ', $name) . "</span></label></div>";
    } elseif ($type === 'file') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" /> @if(\$item->$name) <p class=\"text-sm text-gray-500\">Current file uploaded.</p> @endif </div>";
    } else {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" value=\"{{ \$item->$name }}\" class=\"mt-1 block w-full\" /></div>";
    }
}
$edit .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Update</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/edit.blade.php", $edit);
echo "done";
