<?php
$folder = 'projects';
$modelName = 'Projects';

$fields = [
    'execution_date' => 'date',
    'budget' => 'number',
    'status' => 'select', // upcoming, active, completed
    'admin_notes' => 'textarea'
];

$dir = "resources/views/admin/{$folder}";
if (!is_dir($dir)) mkdir($dir, 0777, true);

// Index
$index = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">{$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><a href=\"{{ route('{$folder}.create') }}\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Create New</a><table class=\"table-auto w-full mt-4\"><thead><tr><th>ID</th><th>Activity</th><th>Company</th><th>Status</th><th>Execution Date</th><th>Actions</th></tr></thead><tbody>@foreach(\$$folder as \$item)<tr><td>{{ \$item->id }}</td><td>{{ optional(\$item->activity)->name }}</td><td>{{ optional(\$item->company)->name }}</td><td>{{ ucfirst(\$item->status) }}</td><td>{{ \$item->execution_date }}</td><td><a href=\"{{ route('{$folder}.edit', \$item) }}\" class=\"text-indigo-600\">Edit</a></td></tr>@endforeach</tbody></table></div></div></div></div></x-app-layout>";
file_put_contents("$dir/index.blade.php", $index);

// Create
$create = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Create {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.store') }}\" enctype=\"multipart/form-data\">@csrf";
$create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Activity</label><select name=\"activity_id\" class=\"mt-1 block w-full\" required><option value=\"\">Select Activity</option>@foreach(\$activities as \$act)<option value=\"{{ \$act->id }}\">{{ \$act->name }}</option>@endforeach</select></div>";
$create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Company</label><select name=\"company_id\" class=\"mt-1 block w-full\" required><option value=\"\">Select Company</option>@foreach(\$companies as \$com)<option value=\"{{ \$com->id }}\">{{ \$com->name }}</option>@endforeach</select></div>";
foreach($fields as $name => $type) {
    if ($type === 'select') {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><select name=\"$name\" class=\"mt-1 block w-full\"><option value=\"upcoming\">Upcoming</option><option value=\"active\">Active</option><option value=\"completed\">Completed</option></select></div>";
    } elseif ($type === 'textarea') {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><textarea name=\"$name\" class=\"mt-1 block w-full\"></textarea></div>";
    } else {
        $create .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" class=\"mt-1 block w-full\" step=\"0.01\" /></div>";
    }
}
$create .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Save</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/create.blade.php", $create);

// Edit
$edit = "<x-app-layout><x-slot name=\"header\"><h2 class=\"font-semibold text-xl text-gray-800 leading-tight capitalize\">Edit {$modelName}</h2></x-slot><div class=\"py-12\"><div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\"><div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\"><div class=\"p-6 text-gray-900\"><form method=\"POST\" action=\"{{ route('{$folder}.update', \$item) }}\" enctype=\"multipart/form-data\">@csrf @method('PUT')";
$edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Activity</label><select name=\"activity_id\" class=\"mt-1 block w-full\" required><option value=\"\">Select Activity</option>@foreach(\$activities as \$act)<option value=\"{{ \$act->id }}\" {{ \$item->activity_id == \$act->id ? 'selected' : '' }}>{{ \$act->name }}</option>@endforeach</select></div>";
$edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700\">Company</label><select name=\"company_id\" class=\"mt-1 block w-full\" required><option value=\"\">Select Company</option>@foreach(\$companies as \$com)<option value=\"{{ \$com->id }}\" {{ \$item->company_id == \$com->id ? 'selected' : '' }}>{{ \$com->name }}</option>@endforeach</select></div>";
foreach($fields as $name => $type) {
    if ($type === 'select') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><select name=\"$name\" class=\"mt-1 block w-full\"><option value=\"upcoming\" {{ \$item->$name == 'upcoming' ? 'selected' : '' }}>Upcoming</option><option value=\"active\" {{ \$item->$name == 'active' ? 'selected' : '' }}>Active</option><option value=\"completed\" {{ \$item->$name == 'completed' ? 'selected' : '' }}>Completed</option></select></div>";
    } elseif ($type === 'textarea') {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><textarea name=\"$name\" class=\"mt-1 block w-full\">{{ \$item->$name }}</textarea></div>";
    } else {
        $edit .= "<div class=\"mt-4\"><label class=\"block font-medium text-sm text-gray-700 capitalize\">" . str_replace('_', ' ', $name) . "</label><input type=\"$type\" name=\"$name\" value=\"{{ \$item->$name }}\" class=\"mt-1 block w-full\" step=\"0.01\" /></div>";
    }
}
$edit .= "<div class=\"flex items-center justify-end mt-4\"><button class=\"ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Update</button></div></form></div></div></div></div></x-app-layout>";
file_put_contents("$dir/edit.blade.php", $edit);
echo "done";
