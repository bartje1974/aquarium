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
            <h2 class="text-xl font-semibold text-gray-800 ml-4">{{ $aquarium->name }} - {{ __('problems.list.title') }}</h2>
        </div>
        
        <a href="{{ route('aquariums.problems.create', $aquarium) }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
            {{ __('problems.list.add') }}
        </a>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($problems->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">{{ __('problems.list.empty') }}</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('problems.table.type') }}</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('problems.table.problem') }}</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('problems.table.start_date') }}</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('problems.table.status') }}</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('problems.table.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($problems as $problem)
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($problem->type === 'illness') bg-red-100 text-red-800
                                        @elseif($problem->type === 'algae') bg-green-100 text-green-800
                                        @elseif($problem->type === 'equipment') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ __('problems.types.'.$problem->type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $problem->title }}</div>
                                    @if($problem->description)
                                        <div class="text-sm text-gray-500">{!! nl2br(e($problem->description)) !!}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                    {{ $problem->started_on->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($problem->resolved_on)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                            {{ __('problems.status.resolved') }}
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                            {{ __('problems.status.active') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right text-sm">
                                    @unless($problem->resolved_on)
                                        <button onclick="openResolveModal('{{ $problem->id }}')" 
                                                class="text-blue-500 hover:text-blue-600">
                                            {{ __('problems.actions.resolve') }}
                                        </button>
                                    @endunless
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $problems->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Resolve Modal -->
<div id="resolveModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-4">
        <form id="resolveForm" method="POST">
            @csrf
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('problems.modal.title') }}</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="solution" class="block text-sm font-medium text-gray-700 mb-1">{{ __('problems.modal.solution') }}</label>
                        <textarea name="solution" id="solution" rows="3" required
                                  class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-0"></textarea>
                    </div>
                    
                    <div>
                        <label for="resolved_on" class="block text-sm font-medium text-gray-700 mb-1">{{ __('problems.modal.resolved_date') }}</label>
                        <input type="date" name="resolved_on" id="resolved_on" required
                               value="{{ date('Y-m-d') }}"
                               class="rounded-md border-gray-300 focus:border-blue-500 focus:ring-0">
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end space-x-3">
                <button type="button" onclick="closeResolveModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500">
                    {{ __('problems.modal.cancel') }}
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600">
                    {{ __('problems.modal.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openResolveModal(problemId) {
    const modal = document.getElementById('resolveModal');
    const form = document.getElementById('resolveForm');
    
    form.action = "{{ route('aquariums.problems.resolve', ['aquarium' => $aquarium, 'problem' => ':problem']) }}".replace(':problem', problemId);
    
    modal.classList.remove('hidden');
}

function closeResolveModal() {
    const modal = document.getElementById('resolveModal');
    modal.classList.add('hidden');
}
</script>
@endpush
@endsection