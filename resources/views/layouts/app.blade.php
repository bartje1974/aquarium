<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Aquarium Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-gray-900 text-xl font-bold">{{ config('app.name') }}</span>
                </div>
                <div class="flex items-center">
                    <div class="flex space-x-8">
                        <a href="{{ route('aquariums.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 @if(request()->routeIs('aquariums.*')) border-blue-500 text-gray-900 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif transition duration-150 ease-in-out">
                            {{ __('aquarium.list.title') }}
                        </a>
                        
                        <a href="{{ route('settings.index') }}"
                           class="inline-flex items-center px-1 pt-1 border-b-2 @if(request()->routeIs('settings.*')) border-blue-500 text-gray-900 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif transition duration-150 ease-in-out">
                            {{ __('settings.title') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>