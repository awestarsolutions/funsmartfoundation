<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-primary leading-tight">
                    {{ __('CSR Inquiries') }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Review and manage corporate partnership requests.</p>
            </div>
            <a href="{{ route('inquiries.create') }}" class="bg-primary hover:opacity-90 text-white font-bold text-xs py-3 px-5 rounded-xl shadow-sm transition-opacity">
                Create Inquiry
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Search Filter Form -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <form method="GET" action="{{ route('inquiries.index') }}" class="flex flex-wrap items-center gap-4">
                    <div class="flex-grow min-w-[200px]">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, or company..." class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-xs" />
                    </div>
                    <div class="w-44">
                        <select name="status" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-xs">
                            <option value="">All Statuses</option>
                            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                            <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="bg-primary text-white text-xs font-bold py-2.5 px-4 rounded-xl hover:opacity-90 transition-opacity">
                            Filter
                        </button>
                        @if(request()->anyFilled(['search', 'status']))
                            <a href="{{ route('inquiries.index') }}" class="text-xs text-gray-500 hover:text-gray-700 font-semibold">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Inquiries List Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left !mt-0">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Name & Email</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Company</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Received</th>
                                <th class="py-3 px-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inquiries as $item)
                                <tr class="hover:bg-gray-50/50 border-b border-gray-100 last:border-b-0">
                                    <td class="py-4 px-4 text-xs font-semibold text-gray-500">#{{ $item->id }}</td>
                                    <td class="py-4 px-4">
                                        <span class="text-xs font-bold text-primary block">{{ $item->name }}</span>
                                        <span class="text-[10px] text-gray-400 block">{{ $item->email }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-xs text-gray-500 font-semibold">{{ $item->company_name ?? 'N/A' }}</td>
                                    <td class="py-4 px-4 text-xs">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                            {{ $item->status === 'new' ? 'bg-blue-50 text-blue-700 border border-blue-100' : '' }}
                                            {{ $item->status === 'in_progress' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                            {{ $item->status === 'resolved' ? 'bg-green-50 text-green-700 border border-green-100' : '' }}
                                        ">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-xs text-gray-400">{{ $item->created_at->format('M d, Y') }}</td>
                                    <td class="py-4 px-4 text-right">
                                        <a href="{{ route('inquiries.edit', $item) }}" class="text-xs font-bold text-primary hover:underline">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-xs text-gray-400 font-medium">No corporate inquiries match the filter criteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>