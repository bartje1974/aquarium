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
            {{ $aquarium->name }} - {{ __('measurements.show.title') }}
        </h2>
    </div>

    <div class="p-6">
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
                {{ __('measurements.show.date') }}: {{ $measurement->measured_on->format('Y-m-d') }}
            </h3>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @php
                    $parameters = [
                        'temperature' => ['label' => __('measurements.show.parameters.temperature'), 'unit' => '°C'],
                        'ph' => ['label' => __('measurements.show.parameters.ph'), 'unit' => ''],
                        'kh' => ['label' => __('measurements.show.parameters.kh'), 'unit' => ''],
                        'gh' => ['label' => __('measurements.show.parameters.gh'), 'unit' => ''],
                        'nh4' => ['label' => __('measurements.show.parameters.nh4'), 'unit' => ''],
                        'no2' => ['label' => __('measurements.show.parameters.no2'), 'unit' => ''],
                        'no3' => ['label' => __('measurements.show.parameters.no3'), 'unit' => ''],
                        'po4' => ['label' => __('measurements.show.parameters.po4'), 'unit' => ''],
                        'o2' => ['label' => __('measurements.show.parameters.o2'), 'unit' => ''],
                        'co2' => ['label' => __('measurements.show.parameters.co2'), 'unit' => '']
                    ];
                @endphp

                @foreach($parameters as $param => $details)
                    <div class="bg-gray-50 rounded p-4">
                        <div class="text-sm font-medium text-gray-500">{{ $details['label'] }}</div>
                        <div class="mt-1 text-lg font-semibold">
                            @if($measurement->$param !== null)
                                {{ $measurement->$param }}{{ $details['unit'] }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($measurement->water_refresh_liters)
                    <div class="bg-blue-50 rounded p-4">
                        <div class="text-sm font-medium text-blue-600">{{ __('measurements.show.water_refresh') }}</div>
                        <div class="mt-1 text-lg font-semibold text-blue-700">
                            {{ $measurement->water_refresh_liters }}L
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @php
            $suggestions = $measurement->suggestions();
        @endphp

        @if(count($suggestions) > 0)
            <div class="mt-4 p-4 bg-white border border-gray-300 rounded shadow">
                <h3 class="font-semibold text-gray-800 mb-2">{{ __('measurements.show.suggestions.title') }}</h3>
                <ul class="space-y-2">
                    @foreach($suggestions as $tip)
                        <li class="text-sm {{ $tip['type'] === 'danger' ? 'text-red-700' : 'text-yellow-700' }}">
                            {{ $tip['message'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded">
                <p class="text-gray-500 text-sm">{{ __('measurements.show.suggestions.no_suggestions') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
