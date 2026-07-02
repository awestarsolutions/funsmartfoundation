<?php
$folder = 'inquiries';
$modelName = 'Inquiries';

$fields = [
    'name' => 'text',
    'email' => 'email',
    'phone' => 'text',
    'company_name' => 'text',
    'message' => 'textarea',
    'status' => 'select', // new, in_progress, resolved
    'admin_notes' => 'textarea'
];

$dir = "resources/views/admin/{$folder}";
if (!is_dir($dir)) mkdir($dir, 0777, true);

// Index
$index = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">{$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><a href=\"{{ route('{$folder}.create') }}\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Create New</a><table class=\"table-auto w-full mt-4\"><thead><tr><th>ID</th><th>Name</th><th>Company</th><th>Status</th><th>Actions</th></tr></thead><tbody>@foreach(\$$folder as \$item)<tr><td>{{ \$item->id }}</td><td>{{ \$item->name }}<br><span class=\"text-xs text-gray-500\">{{ \$item->email }}</span></td><td>{{ \$item->company_name }}</td><td><span class=\"px-2 py-1 rounded text-xs {{ \$item->status == 'new' ? 'bg-red-200 text-red-800' : (\$item->status == 'resolved' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800') }}\">{{ ucfirst(str_replace('_', ' ', \$item->status)) }}</span></td><td><a href=\"{{ route('{$folder}.edit', \$item) }}\" class=\"text-indigo-600\">Manage</a></td></tr>@endforeach</tbody></table></div></div></div></div></x-app-layout>";
file_put_contents("$dir/index.blade.php", $index);

// Create
$create = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Create {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.store') }}\">@csrf";
foreach($fields as $name => $type) {
    if ($type === 'select') {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><select name=\"$name\" class=\"mt-1 block w-full\"><option value=\"new\">New</option><option value=\"in_progress\">In Progress</option><option value=\"resolved\">Resolved</option></select></div>";
    } elseif ($type === 'textarea') {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><textarea name=\"$name\" class=\"mt-1 block w-full\"></textarea></div>";
    } else {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" /></div>";
    }
}
$create .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Save</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/create.blade.php", $create);

// Edit
$edit = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Manage {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.update', \$item) }}\">@csrf @method('PUT')";
foreach($fields as $name => $type) {
    if ($type === 'select') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><select name=\"$name\" class=\"mt-1 block w-full\"><option value=\"new\" {{ \$item->$name == 'new' ? 'selected' : '' }}>New</option><option value=\"in_progress\" {{ \$item->$name == 'in_progress' ? 'selected' : '' }}>In Progress</option><option value=\"resolved\" {{ \$item->$name == 'resolved' ? 'selected' : '' }}>Resolved</option></select></div>";
    } elseif ($type === 'textarea') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><textarea name=\"$name\" class=\"mt-1 block w-full\">{{ \$item->$name }}</textarea></div>";
    } else {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" value=\"{{ \$item->$name }}\" class=\"mt-1 block w-full\" /></div>";
    }
}
$edit .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Update</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/edit.blade.php", $edit);
echo "done";
