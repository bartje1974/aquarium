@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">{{ __('settings.title') }}</h2>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}">
            @csrf
            
            <!-- General Settings -->
            <div class="mb-8 bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('settings.general.title') }}</h3>
                <div class="max-w-md space-y-6">
                    <!-- Language Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('settings.general.language') }}
                        </label>
                        <select name="general[language]" 
                                class="w-48 rounded-md border-2 border-gray-300 focus:border-blue-500 focus:ring-0">
                            @foreach(['nl', 'en', 'de', 'fr'] as $lang)
                                <option value="{{ $lang }}" {{ session('locale', config('app.locale')) === $lang ? 'selected' : '' }}>
                                    {{ __('settings.general.languages.'.$lang) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="max-w-md">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('settings.general.water_refresh_days') }}
                        </label>
                        <input type="number" name="general[water_refresh_days]" 
                               value="{{ $generalSettings['water_refresh_days'] }}"
                               class="w-32 rounded-md border-2">
                        <p class="mt-1 text-sm text-blue-500 italic">
                            {{ __('settings.general.water_refresh_default', ['days' => 14]) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Water Parameters -->
            @foreach(['zoetwater', 'zoutwater'] as $type)
                <div class="mb-8 bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ __('settings.thresholds.title', ['type' => __('aquarium.fields.types.'.$type)]) }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($waterThresholds[$type] as $param => $values)
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <label class="block text-sm font-medium text-gray-900 mb-3">
                                    @switch($param)
                                        @case('temperature')
                                            {{ __('measurements.parameters.temperature') }}
                                            @break
                                        @case('ph')
                                            {{ __('measurements.parameters.ph') }}
                                            @break
                                        @case('kh')
                                            {{ __('measurements.parameters.kh') }}
                                            @break
                                        @case('gh')
                                            {{ __('measurements.parameters.gh') }}
                                            @break
                                        @case('nh4')
                                            {{ __('measurements.parameters.nh4') }}
                                            @break
                                        @case('no2')
                                            {{ __('measurements.parameters.no2') }}
                                            @break
                                        @case('no3')
                                            {{ __('measurements.parameters.no3') }}
                                            @break
                                        @case('po4')
                                            {{ __('measurements.parameters.po4') }}
                                            @break
                                        @case('o2')
                                            {{ __('measurements.parameters.o2') }}
                                            @break
                                        @case('co2')
                                            {{ __('measurements.parameters.co2') }}
                                            @break
                                    @endswitch
                                </label>
                                <div class="space-y-12">
                                    <div class="flex items-center space-x-12 justify-between">
                                        <span class="w-40 text-sm text-gray-600 text-right">{{ __('settings.thresholds.minimum') }}:</span>
                                        <div class="w-32">
                                            <input type="number" step="0.1" 
                                                   name="{{ $type }}[{{ $param }}][min]"
                                                   value="{{ $values['min'] }}"
                                                   class="w-24 rounded-md border-2 @error($type.'.'.$param.'.min') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0">
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-12 justify-between">
                                        <span class="w-40 text-sm text-gray-600 text-right">{{ __('settings.thresholds.maximum') }}:</span>
                                        <div class="w-32">
                                            <input type="number" step="0.1"
                                                   name="{{ $type }}[{{ $param }}][max]"
                                                   value="{{ $values['max'] }}"
                                                   class="w-24 rounded-md border-2 @error($type.'.'.$param.'.max') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0">
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-12 justify-between">
                                        <span class="w-40 text-sm text-gray-600 text-right">{{ __('settings.thresholds.target') }}:</span>
                                        <div class="w-32">
                                            <input type="number" step="0.1"
                                                   name="{{ $type }}[{{ $param }}][target]"
                                                   value="{{ $values['target'] }}"
                                                   class="w-24 rounded-md border-2 @error($type.'.'.$param.'.target') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- About Section -->
            <div class="mb-8 bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('settings.about.title') }}</h3>
                <div class="max-w-md">
                    <p class="text-sm text-gray-600 mb-2">
                        <strong>{{ __('settings.about.version') }}:</strong> {{ config('app.version', '1.0.0') }}
                    </p>
                    <!-- Other app info -->
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    {{ __('settings.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection