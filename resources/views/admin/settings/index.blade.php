<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Global Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div x-data="{ activeTab: '{{ array_key_first($settings->toArray()) }}' }">
                    <!-- Tabs Navigation -->
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            @foreach($settings as $group => $groupSettings)
                                <button 
                                    type="button"
                                    @click="activeTab = '{{ $group }}'"
                                    :class="activeTab === '{{ $group }}' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm capitalize">
                                    {{ $group }}
                                </button>
                            @endforeach
                        </nav>
                    </div>

                    <!-- Tabs Content -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            @foreach($settings as $group => $groupSettings)
                                <div x-show="activeTab === '{{ $group }}'" style="display: none;" x-transition>
                                    <h3 class="text-xl font-bold mb-6 capitalize text-gray-800">{{ $group }} Settings</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        @foreach($groupSettings as $setting)
                                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 shadow-sm">
                                                <label for="{{ $setting->key }}" class="block text-sm font-bold text-gray-700 capitalize mb-2">
                                                    {{ str_replace('_', ' ', $setting->key) }}
                                                </label>
                                                @if($setting->type == 'textarea')
                                                    <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" rows="4">{{ old($setting->key, $setting->value) }}</textarea>
                                                @elseif($setting->type == 'image')
                                                    @if($setting->value)
                                                        <div class="mb-3 bg-white p-2 rounded border border-gray-200 inline-block">
                                                            <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->key }}" class="h-16 object-contain">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                                @elseif($setting->type == 'color')
                                                    <div class="flex items-center gap-3 mt-1">
                                                        <input type="color" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" class="h-10 w-10 p-0 border-0 rounded cursor-pointer shadow-sm">
                                                        <input type="text" name="{{ $setting->key }}_hex" value="{{ old($setting->key, $setting->value) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm font-mono" onchange="document.getElementById('{{ $setting->key }}').value = this.value">
                                                    </div>
                                                @elseif($setting->type == 'password')
                                                    <input type="password" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                @else
                                                    <input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
                        <span class="material-symbols-outlined mr-2" style="font-size: 18px;">save</span> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
