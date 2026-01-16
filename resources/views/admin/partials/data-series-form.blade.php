<!-- Data Series Management Section -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 sm:p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-base sm:text-lg font-semibold text-gray-900">Dados para Gráfico e Tabela</h4>
                <p class="text-sm text-gray-600 mt-1">Adicione os dados que serão exibidos em formato de gráfico e tabela</p>
            </div>
            <button 
                type="button" 
                id="add-data-point"
                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Adicionar Ponto
            </button>
        </div>
    </div>

    <div class="p-4 sm:p-6">
        <!-- Chart Preview -->
        <div class="mb-6 bg-gray-50 rounded-lg p-4" id="chart-preview-container" style="display: none;">
            <h5 class="text-sm font-semibold text-gray-700 mb-3">Prévia do Gráfico</h5>
            <canvas id="data-chart" height="80"></canvas>
        </div>

        <!-- Data Points Container -->
        <div id="data-series-container" class="space-y-3">
            @if(isset($dataItems) && $dataItems->count() > 0)
                @foreach($dataItems as $index => $series)
                    <div class="data-point-item bg-gray-50 border border-gray-300 rounded-lg p-4" data-index="{{ $index }}">
                        <input type="hidden" name="data_series[{{ $index }}][id]" value="{{ $series->id }}">
                        <div class="flex items-start gap-3">
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Data <span class="text-red-500">*</span></label>
                                    <input 
                                        type="date" 
                                        name="data_series[{{ $index }}][date]"
                                        value="{{ $series->date->format('Y-m-d') }}"
                                        required
                                        class="data-date w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    >
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Valor <span class="text-red-500">*</span></label>
                                    <input 
                                        type="number" 
                                        step="0.01"
                                        name="data_series[{{ $index }}][value]"
                                        value="{{ $series->value }}"
                                        required
                                        class="data-value w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                        placeholder="0.00"
                                    >
                                </div>
                            </div>
                            <button 
                                type="button" 
                                class="remove-data-point mt-6 p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                title="Remover ponto"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="text-center py-8 text-gray-500" style="{{ isset($dataItems) && $dataItems->count() > 0 ? 'display:none' : '' }}">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <p class="text-sm">Nenhum dado adicionado ainda. Clique em "Adicionar Ponto" para começar.</p>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('data-series-container');
    const addButton = document.getElementById('add-data-point');
    const emptyState = document.getElementById('empty-state');
    const chartPreviewContainer = document.getElementById('chart-preview-container');
    const chartCanvas = document.getElementById('data-chart');
    
    let dataPointIndex = container.querySelectorAll('.data-point-item').length;
    let chart = null;

    // Inicializar gráfico
    function initChart() {
        if (chart) {
            chart.destroy();
        }

        const points = Array.from(container.querySelectorAll('.data-point-item'));
        if (points.length === 0) {
            chartPreviewContainer.style.display = 'none';
            return;
        }

        const data = points.map(point => ({
            date: point.querySelector('.data-date').value,
            value: parseFloat(point.querySelector('.data-value').value) || 0
        })).filter(d => d.date).sort((a, b) => new Date(a.date) - new Date(b.date));

        if (data.length === 0) {
            chartPreviewContainer.style.display = 'none';
            return;
        }

        chartPreviewContainer.style.display = 'block';

        const ctx = chartCanvas.getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(d => new Date(d.date).toLocaleDateString('pt-BR')),
                datasets: [{
                    label: 'Valor',
                    data: data.map(d => d.value),
                    borderColor: 'rgb(139, 69, 19)',
                    backgroundColor: 'rgba(139, 69, 19, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    }

    // Add new data point
    addButton.addEventListener('click', function() {
        const newPoint = document.createElement('div');
        newPoint.className = 'data-point-item bg-gray-50 border border-gray-300 rounded-lg p-4';
        newPoint.setAttribute('data-index', dataPointIndex);
        newPoint.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Data <span class="text-red-500">*</span></label>
                        <input 
                            type="date" 
                            name="data_series[${dataPointIndex}][date]"
                            required
                            class="data-date w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Valor <span class="text-red-500">*</span></label>
                        <input 
                            type="number" 
                            step="0.01"
                            name="data_series[${dataPointIndex}][value]"
                            required
                            class="data-value w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="0.00"
                        >
                    </div>
                </div>
                <button 
                    type="button" 
                    class="remove-data-point mt-6 p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                    title="Remover ponto"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        `;
        
        container.appendChild(newPoint);
        dataPointIndex++;
        emptyState.style.display = 'none';
        
        // Adicionar event listeners para atualizar gráfico
        newPoint.querySelector('.data-date').addEventListener('change', initChart);
        newPoint.querySelector('.data-value').addEventListener('input', initChart);
        
        // Animation
        newPoint.style.opacity = '0';
        setTimeout(() => {
            newPoint.style.transition = 'opacity 0.3s';
            newPoint.style.opacity = '1';
        }, 10);
    });
    
    // Remove data point (event delegation)
    container.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.remove-data-point');
        if (!removeBtn) return;
        
        const pointItem = removeBtn.closest('.data-point-item');
        
        // Animate removal
        pointItem.style.transition = 'opacity 0.3s, transform 0.3s';
        pointItem.style.opacity = '0';
        pointItem.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            pointItem.remove();
            const remaining = container.querySelectorAll('.data-point-item');
            if (remaining.length === 0) {
                emptyState.style.display = 'block';
            }
            initChart();
        }, 300);
    });

    // Inicializar gráfico se já houver dados
    if (container.querySelectorAll('.data-point-item').length > 0) {
        // Adicionar listeners aos campos existentes
        container.querySelectorAll('.data-date, .data-value').forEach(input => {
            input.addEventListener('change', initChart);
            input.addEventListener('input', initChart);
        });
        initChart();
    }
});
</script>
@endpush
