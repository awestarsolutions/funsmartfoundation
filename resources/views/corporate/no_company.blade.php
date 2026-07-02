<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Corporate Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-8 text-center space-y-6">
                <span class="material-symbols-outlined text-6xl text-outline">domain_disabled</span>
                <h3 class="font-headline-md text-xl text-primary">No Corporate Connection Found</h3>
                <p class="font-body-md text-sm text-on-surface-variant max-w-md mx-auto leading-relaxed">
                    Your corporate account has been registered successfully, but it has not been linked to an organization profile in the system yet.
                </p>
                <div class="pt-4 border-t border-gray-100 text-xs text-outline">
                    Please contact the foundation administrator at <strong>contact@funsmartfoundation.org</strong> to verify and link your account.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
