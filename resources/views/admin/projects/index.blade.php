<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-primary leading-tight">
                    {{ __('CSR Projects Database') }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Manage partner assignments, execution dates, and PDF impact reports.</p>
            </div>
            <a href="{{ route('projects.create') }}" class="bg-primary hover:opacity-90 text-white font-bold text-xs py-3 px-5 rounded-xl shadow-sm transition-opacity">
                Create Project
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Search Filter Form -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <form method="GET" action="{{ route('projects.index') }}" class="flex flex-wrap items-center gap-4">
                    <div class="w-56">
                        <select name="company_id" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-xs">
                            <option value="">All Corporate Partners</option>
                            @foreach($companies as $com)
                                <option value="{{ $com->id }}" {{ request('company_id') == $com->id ? 'selected' : '' }}>{{ $com->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-44">
                        <select name="status" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-xs">
                            <option value="">All Statuses</option>
                            <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="bg-primary text-white text-xs font-bold py-2.5 px-4 rounded-xl hover:opacity-90 transition-opacity">
                            Filter
                        </button>
                        @if(request()->anyFilled(['company_id', 'status']))
                            <a href="{{ route('projects.index') }}" class="text-xs text-gray-500 hover:text-gray-700 font-semibold">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Projects Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left !mt-0">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Initiative</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Partner</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Coordinator</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Execution Date</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Report</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $item)
                                <tr class="hover:bg-gray-50/50 border-b border-gray-100 last:border-b-0">
                                    <td class="py-4 px-4 text-xs font-semibold text-gray-500">#{{ $item->id }}</td>
                                    <td class="py-4 px-4">
                                        <span class="text-xs font-bold text-primary block">{{ optional($item->activity)->name }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-xs font-semibold text-gray-700">{{ optional($item->company)->name }}</td>
                                    <td class="py-4 px-4">
                                        @if($item->coordinator_name)
                                            <span class="text-xs font-semibold text-gray-600 block">{{ $item->coordinator_name }}</span>
                                            <span class="text-[10px] text-gray-400 block">{{ $item->coordinator_phone ?? 'N/A' }}</span>
                                        @else
                                            <span class="text-xs text-gray-300">Unassigned</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-xs text-gray-500 font-semibold">{{ $item->execution_date ?? 'TBD' }}</td>
                                    <td class="py-4 px-4 text-xs">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                            {{ $item->status === 'upcoming' ? 'bg-gray-50 text-gray-700 border border-gray-200' : '' }}
                                            {{ $item->status === 'active' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                            {{ $item->status === 'completed' ? 'bg-green-50 text-green-700 border border-green-100' : '' }}
                                        ">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-xs">
                                        @if($item->report_path)
                                            <a href="{{ asset('storage/' . $item->report_path) }}" target="_blank" class="inline-flex items-center text-primary font-bold hover:underline gap-1">
                                                <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                                                PDF
                                            </a>
                                        @else
                                            <span class="text-gray-300 text-[10px] font-semibold uppercase tracking-wider">None</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-right">
                                        <div class="flex items-center gap-2 justify-end">
    <a href="{{ route('projects.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
    <form action="{{ route('projects.destroy', $item) }}" method="POST" class="inline m-0" onsubmit="return confirm('Are you sure you want to delete this?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete</button>
    </form>
</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-12 text-xs text-gray-400 font-medium">No CSR projects match the filter criteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>