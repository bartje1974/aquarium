@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center">
        <a href="{{ route('aquariums.problems.index', $aquarium) }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-xl font-semibold text-gray-800 ml-4">
            {{ $aquarium->name }} - {{ __('problems.create.title') }}
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

        <form method="POST" action="{{ route('aquariums.problems.store', $aquarium) }}" novalidate>
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('problems.create.fields.type.label') }}
                    </label>
                    <select name="type" id="type" required
                            class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-0">
                        <option value="">{{ __('problems.create.fields.type.placeholder') }}</option>
                        <option value="illness" {{ old('type') === 'illness' ? 'selected' : '' }}>
                            {{ __('problems.types.illness') }}
                        </option>
                        <option value="algae" {{ old('type') === 'algae' ? 'selected' : '' }}>
                            {{ __('problems.types.algae') }}
                        </option>
                        <option value="equipment" {{ old('type') === 'equipment' ? 'selected' : '' }}>
                            {{ __('problems.types.equipment') }}
                        </option>
                        <option value="other" {{ old('type') === 'other' ? 'selected' : '' }}>
                            {{ __('problems.types.other') }}
                        </option>
                    </select>
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('problems.create.fields.title') }}
                    </label>
                    <input type="text" name="title" id="title" required
                           value="{{ old('title') }}"
                           class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-0">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('problems.create.fields.description') }}
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-0">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="started_on" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('problems.create.fields.started_on') }}
                    </label>
                    <input type="date" name="started_on" id="started_on" required
                           value="{{ old('started_on', date('Y-m-d')) }}"
                           class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-0">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    {{ __('problems.create.submit') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection