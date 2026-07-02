<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Edit CSR Project') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <form method="POST" action="{{ route('projects.update', $item) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Activity -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Activity / Initiative</label>
                            <select name="activity_id" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" required>
                                <option value="">Select Activity</option>
                                @foreach($activities as $act)
                                    <option value="{{ $act->id }}" {{ $item->activity_id == $act->id ? 'selected' : '' }}>{{ $act->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Company -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Corporate Partner</label>
                            <select name="company_id" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $com)
                                    <option value="{{ $com->id }}" {{ $item->company_id == $com->id ? 'selected' : '' }}>{{ $com->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Execution Date -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Execution Date</label>
                            <input type="date" name="execution_date" value="{{ old('execution_date', $item->execution_date) }}" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" />
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Start Time</label>
                            <input type="datetime-local" name="start_time" value="{{ old('start_time', $item->start_time ? $item->start_time->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" />
                        </div>

                        <!-- End Time -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">End Time</label>
                            <input type="datetime-local" name="end_time" value="{{ old('end_time', $item->end_time ? $item->end_time->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" />
                        </div>

                        <!-- Budget -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Budget (INR)</label>
                            <input type="number" name="budget" step="0.01" value="{{ $item->budget }}" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="e.g. 500000.00" />
                        </div>

                        <!-- Coordinator Name -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Coordinator Name</label>
                            <input type="text" name="coordinator_name" value="{{ $item->coordinator_name }}" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="e.g. Rahul Sharma" />
                        </div>

                        <!-- Coordinator Phone -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Coordinator Phone</label>
                            <input type="text" name="coordinator_phone" value="{{ $item->coordinator_phone }}" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="e.g. +91 98765 43210" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Project Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm">
                                <option value="upcoming" {{ $item->status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>

                    <!-- PDF Report File -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Official Impact Report (PDF)</label>
                        <input type="file" name="report_file" accept=".pdf" class="w-full rounded-xl border border-gray-200 text-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/5 file:text-primary hover:file:bg-primary/10" />
                        @if($item->report_path)
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-500 bg-gray-50 p-2.5 rounded-lg border">
                                <span class="material-symbols-outlined text-sm text-primary">picture_as_pdf</span>
                                <span>Current Report:</span>
                                <a href="{{ asset('storage/' . $item->report_path) }}" target="_blank" class="text-primary font-bold hover:underline">Download PDF</a>
                            </div>
                        @else
                            <span class="text-[10px] text-gray-400 mt-1 block">Upload the official completed ESG report (Max 20MB).</span>
                        @endif
                    </div>

                    <!-- Photo Files Gallery -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Event Photos (Add More)</label>
                        <input type="file" name="photo_files[]" multiple accept="image/*" class="w-full rounded-xl border border-gray-200 text-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/5 file:text-primary hover:file:bg-primary/10" />
                        @if($item->photos && is_array($item->photos) && count($item->photos) > 0)
                            <div class="mt-4">
                                <span class="text-xs font-semibold text-gray-500 block mb-2">Currently Uploaded Photos:</span>
                                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                                    @foreach($item->photos as $photo)
                                        <div class="h-16 rounded-lg overflow-hidden border border-gray-150 relative">
                                            <img src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <span class="text-[10px] text-gray-400 mt-1 block">Select multiple JPG/PNG photos to display in the corporate portal gallery.</span>
                        @endif
                    </div>

                    <!-- Admin Notes -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Administrative Notes</label>
                        <textarea name="admin_notes" rows="4" class="w-full rounded-xl border-gray-200 focus:ring-primary focus:border-primary text-sm" placeholder="Provide event summaries, internal operations milestones or details...">{{ $item->admin_notes }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-50">
                        <a href="{{ route('projects.index') }}" class="text-xs font-bold text-gray-500 hover:text-gray-700">Cancel</a>
                        <button type="submit" class="bg-primary hover:opacity-90 text-white font-bold text-xs py-3 px-6 rounded-xl shadow-sm transition-opacity">
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>