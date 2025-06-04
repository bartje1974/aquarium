@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center">
        <a href="{{ route('aquariums.measurements.index', $aquarium) }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-gray-800 ml-4">
            {{ $aquarium->name }} - {{ __('measurements.edit.title') }}
        </h2>
    </div>

    <div class="p-6">
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('aquariums.measurements.update', ['aquarium' => $aquarium, 'measurement' => $measurement]) }}" novalidate>
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="measured_on" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('measurements.edit.fields.date') }}
                </label>
                <input type="date" 
                       name="measured_on" 
                       id="measured_on" 
                       value="{{ old('measured_on', $measurement->measured_on->format('Y-m-d')) }}"
                       class="w-48 rounded-md border-2 @error('measured_on') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0"
                       required>
            </div>

            @php
                $thresholds = $aquarium->getThresholds();
                $parameters = [
                    'temperature' => ['label' => __('measurements.edit.fields.temperature'), 'unit' => '°C', 'required' => true],
                    'ph' => ['label' => __('measurements.edit.fields.ph'), 'unit' => '', 'required' => true],
                    'kh' => ['label' => __('measurements.edit.fields.kh'), 'unit' => '', 'required' => false],
                    'gh' => ['label' => __('measurements.edit.fields.gh'), 'unit' => '', 'required' => false],
                    'nh4' => ['label' => __('measurements.edit.fields.nh4'), 'unit' => '', 'required' => false],
                    'no2' => ['label' => __('measurements.edit.fields.no2'), 'unit' => '', 'required' => false],
                    'no3' => ['label' => __('measurements.edit.fields.no3'), 'unit' => '', 'required' => false],
                    'po4' => ['label' => __('measurements.edit.fields.po4'), 'unit' => '', 'required' => false],
                    'o2' => ['label' => __('measurements.edit.fields.o2'), 'unit' => '', 'required' => false],
                    'co2' => ['label' => __('measurements.edit.fields.co2'), 'unit' => '', 'required' => false]
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($parameters as $param => $details)
                    <div>
                        <label for="{{ $param }}" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $details['label'] }} {{ $details['unit'] }}
                            @if(isset($thresholds[$param]['min']) && isset($thresholds[$param]['max']))
                                <span class="text-gray-500">({{ $thresholds[$param]['min'] }} - {{ $thresholds[$param]['max'] }})</span>
                            @endif
                            @if($details['required'])
                                <span class="text-red-500">*</span>
                            @endif
                        </label>
                        <input type="number" 
                               step="0.1" 
                               name="{{ $param }}" 
                               id="{{ $param }}"
                               value="{{ old($param, $measurement->$param) }}"
                               class="w-full rounded-md border-2 @error($param) border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0"
                               {{ $details['required'] ? 'required' : '' }}>
                        @error($param)
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="mt-6 border-t pt-6">
                <div class="max-w-md">
                    <label for="water_refresh_liters" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('measurements.edit.fields.water_refresh') }}
                    </label>
                    <input type="number" 
                           step="1" 
                           min="0"
                           name="water_refresh_liters" 
                           id="water_refresh_liters"
                           value="{{ old('water_refresh_liters', $measurement->water_refresh_liters) }}"
                           class="w-full rounded-md border-2 @error('water_refresh_liters') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0"
                           placeholder="{{ __('measurements.edit.fields.water_refresh_placeholder') }}">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    {{ __('measurements.edit.submit') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection