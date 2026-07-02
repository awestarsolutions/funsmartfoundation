<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary leading-tight">
            {{ __('Administrative Workspace') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Dashboard Banner -->
            <div class="bg-gradient-to-r from-secondary to-primary p-8 rounded-3xl text-white shadow-md relative overflow-hidden">
                <div class="relative z-10 space-y-2">
                    <span class="bg-white/20 text-white font-bold text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full">
                        FSF Executive Control Center
                    </span>
                    <h3 class="text-3xl font-bold tracking-tight">Welcome back, {{ Auth::user()->name }}</h3>
                    <p class="text-sm text-white/80 max-w-xl leading-relaxed">
                        Track partnership requests, oversee CSR project execution, manage impact reports, and measure community development milestones in real-time.
                    </p>
                </div>
                <!-- Abstract Design Background decoration -->
                <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                    <span class="material-symbols-outlined text-[180px]" style="font-variation-settings: 'FILL' 1;">analytics</span>
                </div>
            </div>

            <!-- Dynamic Metrics Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Activities Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-primary/10 text-primary rounded-xl">
                        <span class="material-symbols-outlined text-3xl">volunteer_activism</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">CSR Modules</span>
                        <span class="text-2xl font-bold text-secondary">{{ $activitiesCount }}</span>
                    </div>
                </div>

                <!-- Companies Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-secondary/10 text-secondary rounded-xl">
                        <span class="material-symbols-outlined text-3xl">domain</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Partners</span>
                        <span class="text-2xl font-bold text-secondary">{{ $companiesCount }}</span>
                    </div>
                </div>

                <!-- Inquiries Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-primary/10 text-primary rounded-xl">
                        <span class="material-symbols-outlined text-3xl">chat_bubble</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Inquiries</span>
                        <span class="text-2xl font-bold text-secondary">{{ $inquiriesCount }}</span>
                    </div>
                </div>

                <!-- Ongoing Projects Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-secondary/10 text-secondary rounded-xl">
                        <span class="material-symbols-outlined text-3xl">pending_actions</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Ongoing Proj</span>
                        <span class="text-2xl font-bold text-secondary">{{ $ongoingProjectsCount }}</span>
                    </div>
                </div>

                <!-- Completed Projects Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-primary/10 text-primary rounded-xl">
                        <span class="material-symbols-outlined text-3xl">task_alt</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Completed Proj</span>
                        <span class="text-2xl font-bold text-secondary">{{ $completedProjectsCount }}</span>
                    </div>
                </div>
            </div>

            <!-- Dashboard Analytics & Status Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- ESG Conversion Targets widget (Custom HTML Charting) -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border flex flex-col justify-between">
                    <div>
                        <h4 class="font-bold text-base text-secondary uppercase tracking-wider mb-2">Impact Performance</h4>
                        <p class="text-xs text-gray-500 mb-6">Target conversion rates and program goals for the current fiscal year.</p>
                        
                        <div class="space-y-4">
                            <!-- Goal 1 -->
                            <div class="space-y-1">
                                <div class="flex justify-between text-xs font-semibold text-gray-700">
                                    <span>Inquiry Conversion Target</span>
                                    <span>84%</span>
                                </div>
                                <div class="w-full bg-background h-2.5 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: 84%"></div>
                                </div>
                            </div>
                            <!-- Goal 2 -->
                            <div class="space-y-1">
                                <div class="flex justify-between text-xs font-semibold text-gray-700">
                                    <span>Program Execution Progress</span>
                                    <span>72%</span>
                                </div>
                                <div class="w-full bg-background h-2.5 rounded-full overflow-hidden">
                                    <div class="bg-secondary h-full rounded-full" style="width: 72%"></div>
                                </div>
                            </div>
                            <!-- Goal 3 -->
                            <div class="space-y-1">
                                <div class="flex justify-between text-xs font-semibold text-gray-700">
                                    <span>Reports Dispatched Target</span>
                                    <span>95%</span>
                                </div>
                                <div class="w-full bg-background h-2.5 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: 95%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-50 flex items-center justify-between text-xs text-gray-400">
                        <span>Updated: Live Data</span>
                        <span class="text-secondary font-bold">FSF Target Goal: 100%</span>
                    </div>
                </div>

                <!-- Recent Inquiries Panel -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-base text-secondary uppercase tracking-wider">Recent Inquiries</h4>
                        <a href="{{ route('inquiries.index') }}" class="text-xs text-primary font-bold hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse !mt-0" style="border-radius: 0; box-shadow: none;">
                            <thead>
                                <tr class="bg-transparent border-b border-gray-100">
                                    <th class="py-2 px-1 bg-transparent text-xs font-bold text-gray-500 border-none">Name</th>
                                    <th class="py-2 px-1 bg-transparent text-xs font-bold text-gray-500 border-none">Company</th>
                                    <th class="py-2 px-1 bg-transparent text-xs font-bold text-gray-500 border-none text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentInquiries as $inq)
                                    <tr class="hover:bg-transparent border-b border-gray-50 last:border-0">
                                        <td class="py-3 px-1 text-xs font-bold text-secondary">{{ $inq->name }}</td>
                                        <td class="py-3 px-1 text-xs text-gray-500">{{ $inq->company_name ?? 'N/A' }}</td>
                                        <td class="py-3 px-1 text-right">
                                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider
                                                {{ $inq->status === 'new' ? 'bg-blue-50 text-blue-700 border border-blue-100' : '' }}
                                                {{ $inq->status === 'in_progress' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                                {{ $inq->status === 'resolved' ? 'bg-green-50 text-green-700 border border-green-100' : '' }}
                                            ">
                                                {{ $inq->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-6 text-xs text-gray-400">No recent inquiries</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Projects Panel -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-border">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-base text-secondary uppercase tracking-wider">Recent Projects</h4>
                        <a href="{{ route('projects.index') }}" class="text-xs text-primary font-bold hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse !mt-0" style="border-radius: 0; box-shadow: none;">
                            <thead>
                                <tr class="bg-transparent border-b border-gray-100">
                                    <th class="py-2 px-1 bg-transparent text-xs font-bold text-gray-500 border-none">Initiative</th>
                                    <th class="py-2 px-1 bg-transparent text-xs font-bold text-gray-500 border-none">Company</th>
                                    <th class="py-2 px-1 bg-transparent text-xs font-bold text-gray-500 border-none text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProjects as $proj)
                                    <tr class="hover:bg-transparent border-b border-gray-50 last:border-0">
                                        <td class="py-3 px-1 text-xs font-bold text-secondary">{{ optional($proj->activity)->name }}</td>
                                        <td class="py-3 px-1 text-xs text-gray-500">{{ optional($proj->company)->name }}</td>
                                        <td class="py-3 px-1 text-right">
                                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider
                                                {{ $proj->status === 'upcoming' ? 'bg-gray-50 text-gray-700 border border-gray-250' : '' }}
                                                {{ $proj->status === 'active' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                                {{ $proj->status === 'completed' ? 'bg-green-50 text-green-700 border border-green-100' : '' }}
                                            ">
                                                {{ $proj->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-6 text-xs text-gray-400">No recent projects</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
