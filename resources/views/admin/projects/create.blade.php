<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Create CSR Project') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Activity -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Activity / Initiative</label>
                            <select name="activity_id" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" required>
                                <option value="">Select Activity</option>
                                @foreach($activities as $act)
                                    <option value="{{ $act->id }}">{{ $act->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Company -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Corporate Partner</label>
                            <select name="company_id" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $com)
                                    <option value="{{ $com->id }}">{{ $com->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Execution Date -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Execution Date</label>
                            <input type="date" name="execution_date" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" />
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Start Time</label>
                            <input type="datetime-local" name="start_time" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" />
                        </div>

                        <!-- End Time -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">End Time</label>
                            <input type="datetime-local" name="end_time" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" />
                        </div>

                        <!-- Budget -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Budget (INR)</label>
                            <input type="number" name="budget" step="0.01" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="e.g. 500000.00" />
                        </div>

                        <!-- Coordinator Name -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Coordinator Name</label>
                            <input type="text" name="coordinator_name" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="e.g. Rahul Sharma" />
                        </div>

                        <!-- Coordinator Phone -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Coordinator Phone</label>
                            <input type="text" name="coordinator_phone" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="e.g. +91 98765 43210" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Project Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm">
                                <option value="upcoming">Upcoming</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <!-- PDF Report File -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Official Impact Report (PDF)</label>
                        <input type="file" name="report_file" accept=".pdf" class="w-full rounded-xl border border-gray-200 text-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/5 file:text-primary hover:file:bg-primary/10" />
                        <span class="text-[10px] text-gray-400 mt-1 block">Upload the official completed ESG report (Max 20MB).</span>
                    </div>

                    <!-- Photo Files Gallery -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Event Photos (Multiple Upload)</label>
                        <input type="file" name="photo_files[]" multiple accept="image/*" class="w-full rounded-xl border border-gray-200 text-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/5 file:text-primary hover:file:bg-primary/10" />
                        <span class="text-[10px] text-gray-400 mt-1 block">Select multiple JPG/PNG photos to display in the corporate portal gallery.</span>
                    </div>

                    <!-- Admin Notes -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Administrative Notes</label>
                        <textarea name="admin_notes" rows="4" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="Provide event summaries, internal operations milestones or details..."></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-50">
                        <a href="{{ route('projects.index') }}" class="text-xs font-bold text-gray-500 hover:text-gray-700">Cancel</a>
                        <button type="submit" class="bg-primary hover:opacity-90 text-white font-bold text-xs py-3 px-6 rounded-xl shadow-sm transition-opacity">
                            Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>