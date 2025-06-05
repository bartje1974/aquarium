@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        @if($aquariums->isEmpty())
            <div class="text-center">
                <p class="mt-4 text-gray-500">{{ __('aquarium.list.empty') }}</p>
                <p class="mt-4">{{ __('aquarium.list.empty_cta') }}</p>
                <a href="{{ route('aquariums.create') }}" 
                   class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                    {{ __('aquarium.list.add') }}
                </a>
            </div>
        @else
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">{{ __('aquarium.list.title') }}</h2>
                    <a href="{{ route('aquariums.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        {{ __('aquarium.list.add') }}
                    </a>
                </div>

                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($aquariums as $aquarium)
                            <div class="bg-white border rounded-lg shadow-sm h-full flex flex-col">
                                <div class="p-4 flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $aquarium->name }}</h3>
                                    
                                    @if($aquarium->needsWaterRefresh())
                                        <div class="mt-2 p-2 bg-yellow-50 border border-yellow-200 rounded text-yellow-800 text-sm">
                                            @if($days = $aquarium->daysSinceLastWaterRefresh())
                                                {{ __('aquarium.water_refresh.days_ago', ['days' => $days]) }}
                                            @else
                                                {{ __('aquarium.water_refresh.never') }}
                                            @endif
                                            <br>
                                            {{ __('aquarium.water_refresh.recommended') }}
                                        </div>
                                    @endif

                                    <!-- Add Problem Counter -->
                                    @if($aquarium->active_problems_count > 0)
                                        <div class="mt-2 p-2 bg-red-50 border border-red-200 rounded text-red-700 text-sm">
                                            {{ $aquarium->active_problems_count }} actieve {{ Str::plural('probleem', $aquarium->active_problems_count) }}
                                        </div>
                                    @endif

                                    <div class="mt-2 text-sm text-gray-600">
                                        <p>Volume: {{ $aquarium->volume_liters }}L</p>
                                        <p>Type: {{ $aquarium->type }}</p>
                                        @if($aquarium->description)
                                            <p class="mt-2">{{ $aquarium->description }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="border-t p-4 space-y-2">
                                    <a href="{{ route('aquariums.measurements.index', $aquarium) }}" 
                                       class="flex justify-between items-center text-blue-600 hover:text-blue-800">
                                        <span>{{ __('aquarium.navigation.measurements') }}</span>
                                        <span>&rarr;</span>
                                    </a>
                                    <a href="{{ route('aquariums.problems.index', $aquarium) }}" 
                                       class="flex justify-between items-center text-blue-600 hover:text-blue-800">
                                        <span>{{ __('aquarium.navigation.problems') }}</span>
                                        <span>&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
