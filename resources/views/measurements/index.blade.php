@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ route('aquariums.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-xl font-semibold text-gray-800 ml-4">{{ $aquarium->name }} - {{ __('measurements.list.title') }}</h2>
        </div>
        
        <div class="flex space-x-4">
            <a href="{{ route('aquariums.problems.index', $aquarium) }}" 
               class="text-blue-500 hover:text-blue-600 px-4 py-2">
                {{ __('problems.list.title') }}
            </a>
            <a href="{{ route('aquariums.measurements.create', $aquarium) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                {{ __('measurements.list.add') }}
            </a>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <x-measurement-graph 
                :measurements="$measurements" 
                parameter="ph" 
                :label="__('measurements.graphs.ph_values')" 
                color="rgb(59, 130, 246)" 
            />
            
            <x-measurement-graph 
                :measurements="$measurements" 
                parameter="temperature" 
                :label="__('measurements.graphs.temperature_values')" 
                color="rgb(239, 68, 68)" 
            />
        </div>

        @if($measurements->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">{{ __('measurements.list.empty') }}</p>
                <p class="text-sm text-gray-400 mt-1">{{ __('measurements.list.empty_cta') }}</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.date') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.temperature') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.ph') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.kh') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.gh') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.nh4') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.no2') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.no3') }}</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('measurements.table.water_refresh') }}</th>
                            <th class="px-4 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($measurements as $measurement)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    <a href="{{ route('aquariums.measurements.show', ['aquarium' => $aquarium, 'measurement' => $measurement]) }}" 
                                       class="text-blue-500 hover:text-blue-600">
                                        {{ $measurement->measured_on->format('d-m-Y') }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->temperature }}°C</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->ph }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->kh ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->gh ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->nh4 ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->no2 ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $measurement->no3 ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    @if($measurement->water_refresh_liters)
                                        <span class="text-green-600">{{ $measurement->water_refresh_liters }}L</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-right">
                                    <a href="{{ route('aquariums.measurements.edit', ['aquarium' => $aquarium, 'measurement' => $measurement]) }}" 
                                       class="text-blue-500 hover:text-blue-600">
                                        {{ __('measurements.table.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $measurements->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection