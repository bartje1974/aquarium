@props(['measurements', 'parameter', 'label', 'color' => 'rgb(59, 130, 246)'])

<div class="bg-white p-4 rounded-lg shadow" style="height: 300px;">
    <canvas id="{{ $parameter }}-chart"></canvas>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('{{ $parameter }}-chart').getContext('2d');
        const thresholds = @json($measurements->first()?->aquarium?->getThresholds()[$parameter] ?? null);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($measurements->pluck('measured_on')->map->format('d-m-Y')) !!},
                datasets: [{
                    label: '{{ $label }}',
                    data: {!! json_encode($measurements->pluck($parameter)) !!},
                    borderColor: '{{ $color }}',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    annotation: {
                        annotations: {
                            target: {
                                type: 'line',
                                yMin: thresholds?.target,
                                yMax: thresholds?.target,
                                borderColor: 'rgba(0, 200, 0, 1)',
                                borderWidth: 2,
                                borderDash: [5, 5],
                                label: {
                                    enabled: true,
                                    content: `Target: ${thresholds?.target}`,
                                    position: 'start'
                                }
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush