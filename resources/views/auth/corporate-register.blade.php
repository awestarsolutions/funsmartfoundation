<x-public-layout>
    @section('title', 'Corporate Registration | Fun Smart Foundation')

    <section class="page-section bg-surface-container-lowest min-h-screen py-20 flex items-center justify-center">
        <div class="container max-w-2xl mx-auto px-4">
            <div class="card p-8 md:p-12 shadow-2xl rounded-2xl bg-white border border-gray-100">
                <div class="text-center mb-10">
                    <h1 class="text-3xl md:text-4xl font-headline-md font-bold text-primary mb-3">Partner with Us</h1>
                    <p class="text-on-surface-variant text-lg">Create a corporate account to book and manage CSR activities.</p>
                </div>

                <form method="POST" action="{{ route('corporate.register') }}" x-data="{ isPocSame: true }">
                    @csrf

                    @if($redirect)
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endif

                    <!-- User Account Section -->
                    <div class="mb-10">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 text-primary font-bold">1</span>
                            <h3 class="text-xl font-bold text-primary">Account Details</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-1">
                                <label for="name" class="text-sm font-semibold text-gray-700">Account Owner Name</label>
                                <input id="name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="email" class="text-sm font-semibold text-gray-700">Work Email</label>
                                <input id="email" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="john@company.com" />
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                                <input id="password" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="password_confirmation" class="text-sm font-semibold text-gray-700">Confirm Password</label>
                                <input id="password_confirmation" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                                @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 mb-10">

                    <!-- Company Section -->
                    <div class="mb-10">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 text-primary font-bold">2</span>
                            <h3 class="text-xl font-bold text-primary">Company Profile</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div class="flex flex-col gap-1">
                                <label for="company_name" class="text-sm font-semibold text-gray-700">Company Name</label>
                                <input id="company_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="Acme Corp" />
                                @error('company_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="industry" class="text-sm font-semibold text-gray-700">Industry</label>
                                <input id="industry" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="text" name="industry" value="{{ old('industry') }}" placeholder="Technology, Healthcare..." />
                                @error('industry') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-3 mb-6 p-4 rounded-lg bg-gray-50 border border-gray-200">
                            <input type="hidden" name="is_poc_same" value="0">
                            <input type="checkbox" id="is_poc_same" name="is_poc_same" value="1" x-model="isPocSame" class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary cursor-pointer transition-all">
                            <label for="is_poc_same" class="text-sm font-semibold text-gray-800 cursor-pointer select-none">Point of Contact is the same as Account Owner</label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5" x-show="!isPocSame" x-cloak>
                            <div class="flex flex-col gap-1">
                                <label for="primary_poc_name" class="text-sm font-semibold text-gray-700">Point of Contact Name</label>
                                <input id="primary_poc_name" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="text" name="primary_poc_name" value="{{ old('primary_poc_name') }}" :required="!isPocSame" placeholder="Jane Doe" />
                                @error('primary_poc_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="poc_email" class="text-sm font-semibold text-gray-700">Point of Contact Email</label>
                                <input id="poc_email" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="email" name="poc_email" value="{{ old('poc_email') }}" :required="!isPocSame" placeholder="jane@company.com" />
                                @error('poc_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-1 md:w-1/2 md:pr-2.5">
                            <label for="poc_phone" class="text-sm font-semibold text-gray-700">Contact Phone <span class="text-gray-400 font-normal">(Optional)</span></label>
                            <input id="poc_phone" class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" type="text" name="poc_phone" value="{{ old('poc_phone') }}" placeholder="+1 (234) 567-8900" />
                            @error('poc_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center justify-between pt-6 border-t border-gray-200 gap-6">
                        <a class="text-sm font-medium text-gray-600 hover:text-primary transition-colors underline" href="{{ route('login') }}">
                            Already have an account? Sign In
                        </a>

                        <button type="submit" class="w-full md:w-auto bg-primary hover:bg-primary/90 text-white px-8 py-3.5 rounded-lg font-bold shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-0.5">
                            Create Corporate Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-public-layout>
