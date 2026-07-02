<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-primary leading-tight uppercase tracking-wider">
                    Corporate Workspace
                </h2>
                <p class="text-xs text-gray-500 mt-1">Self-service CSR and ESG reporting portal for enterprise partners.</p>
            </div>
            <div class="bg-primary/5 px-4 py-2 rounded-lg border border-primary/10">
                <span class="text-xs font-bold text-primary block uppercase tracking-wider">Partner Profile</span>
                <span class="text-sm font-semibold text-gray-700">{{ $company->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Metrics row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Upcoming -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="p-3 bg-gray-50 text-gray-500 rounded-xl">
                        <span class="material-symbols-outlined text-3xl">schedule</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-semibold block uppercase tracking-wider">Scheduled Tasks</span>
                        <span class="text-2xl font-bold text-primary">{{ $upcomingProjectsCount }}</span>
                    </div>
                </div>

                <!-- Active -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <span class="material-symbols-outlined text-3xl">rotate_right</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-semibold block uppercase tracking-wider">Ongoing Projects</span>
                        <span class="text-2xl font-bold text-primary">{{ $activeProjectsCount }}</span>
                    </div>
                </div>

                <!-- Completed -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                        <span class="material-symbols-outlined text-3xl">check_circle</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 font-semibold block uppercase tracking-wider">Completed Projects</span>
                        <span class="text-2xl font-bold text-primary">{{ $completedProjectsCount }}</span>
                    </div>
                </div>
            </div>

            <!-- Project Details Card Listing -->
            <div class="space-y-6">
                <h3 class="font-bold text-lg text-primary uppercase tracking-wider">Assigned Initiatives</h3>

                @forelse($projects as $proj)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 md:p-8 flex flex-col md:flex-row justify-between items-start gap-6 border-b border-gray-50">
                            <!-- Left Details -->
                            <div class="space-y-4 flex-grow">
                                <div class="flex items-center gap-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        {{ $proj->status === 'upcoming' ? 'bg-gray-50 text-gray-700 border border-gray-200' : '' }}
                                        {{ $proj->status === 'active' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                        {{ $proj->status === 'completed' ? 'bg-green-50 text-green-700 border border-green-100' : '' }}
                                    ">
                                        {{ $proj->status }}
                                    </span>
                                    @if($proj->activity->category)
                                        <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-widest">
                                            {{ $proj->activity->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <h4 class="text-xl font-bold text-primary leading-tight">{{ $proj->activity->name }}</h4>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ $proj->activity->short_description }}</p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <span class="material-symbols-outlined text-base">calendar_today</span>
                                        <span>Execution: <strong>{{ $proj->execution_date ? \Carbon\Carbon::parse($proj->execution_date)->format('M d, Y') : 'TBD' }}</strong></span>
                                    </div>
                                    @if($proj->coordinator_name)
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <span class="material-symbols-outlined text-base">badge</span>
                                            <span>Coordinator: <strong>{{ $proj->coordinator_name }}</strong> {{ $proj->coordinator_phone ? '(' . $proj->coordinator_phone . ')' : '' }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Action Buttons -->
                            <div class="flex flex-col gap-3 min-w-[200px] w-full md:w-auto">
                                @if($proj->report_path)
                                    <a href="{{ asset('storage/' . $proj->report_path) }}" target="_blank"
                                       class="flex items-center justify-center text-xs font-bold text-white bg-primary py-3 px-5 rounded-lg gap-2 shadow-sm hover:opacity-90 transition-opacity">
                                        <span class="material-symbols-outlined text-sm">download_for_offline</span>
                                        Download PDF Report
                                    </a>
                                @else
                                    <div class="text-center py-2.5 border border-dashed border-gray-200 rounded-lg text-[10px] text-gray-400 font-medium">
                                        Report Pending Upload
                                    </div>
                                @endif
                                
                                <a href="{{ route('public.activities.show', $proj->activity->slug) }}" 
                                   class="flex items-center justify-center text-xs font-bold text-primary border border-primary/20 py-3 px-5 rounded-lg gap-2 hover:bg-primary/5 transition-colors">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                    Explore Activity Details
                                </a>
                            </div>
                        </div>

                        <!-- Optional Project Photos Block -->
                        @if($proj->photos && is_array($proj->photos) && count($proj->photos) > 0)
                            <div class="p-6 md:p-8 bg-gray-50/50">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-4">Event Photo Gallery</span>
                                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach($proj->photos as $photo)
                                        <div class="rounded-xl overflow-hidden shadow-sm aspect-video relative group border border-gray-100">
                                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                                 src="{{ asset('storage/' . $photo) }}" 
                                                 alt="Project Photo" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                        <span class="material-symbols-outlined text-5xl text-outline mb-4">assignment_late</span>
                        <h4 class="font-bold text-lg text-primary">No CSR Projects Assigned</h4>
                        <p class="text-xs text-gray-400 mt-2 max-w-sm mx-auto">There are currently no active or upcoming CSR initiatives linked to your corporate profile.</p>
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>
</x-app-layout>
