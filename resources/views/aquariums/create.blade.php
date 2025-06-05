@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center">
        <a href="{{ route('aquariums.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-gray-800 ml-4">{{ __('aquarium.create.title') }}</h2>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('aquariums.store') }}" novalidate>
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('aquarium.fields.name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name') }}" 
                           class="w-full rounded-md border-2 @error('name') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0" 
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="started_at" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('aquarium.fields.started_at') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="started_at" id="started_at" 
                           value="{{ old('started_at', date('Y-m-d')) }}" 
                           class="w-48 rounded-md border-2 @error('started_at') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0" 
                           required>
                    @error('started_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="volume_liters" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('aquarium.fields.volume') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.1" name="volume_liters" id="volume_liters" 
                           value="{{ old('volume_liters') }}" 
                           class="w-48 rounded-md border-2 @error('volume_liters') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0" 
                           required>
                    @error('volume_liters')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('aquarium.fields.type') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" 
                            class="w-48 rounded-md border-2 @error('type') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0" 
                            required>
                        <option value="">{{ __('aquarium.create.select_type') }}</option>
                        <option value="zoetwater" {{ old('type') == 'zoetwater' ? 'selected' : '' }}>
                            {{ __('aquarium.fields.types.zoetwater') }}
                        </option>
                        <option value="zoutwater" {{ old('type') == 'zoutwater' ? 'selected' : '' }}>
                            {{ __('aquarium.fields.types.zoutwater') }}
                        </option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('aquarium.fields.description') }}
                    </label>
                    <textarea name="description" id="description" rows="3" 
                              class="w-full rounded-md border-2 @error('description') border-red-500 @else border-gray-300 @enderror focus:border-blue-500 focus:ring-0">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    {{ __('aquarium.create.submit') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection