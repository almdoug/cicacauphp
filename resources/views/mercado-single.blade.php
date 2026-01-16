@extends('layouts.app')

@section('meta_title', $data->title . ' | Mercado | CI Cacau')
@section('meta_description', Str::limit($data->comment ?? $data->title, 160))

@push('head-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
             <div class="flex items-center justify-center gap-3 mb-4 flex-wrap">
                @if($data->country)
                    <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                        {{ $data->country }}
                    </span>
                @endif
                @if($data->frequency)
                    <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                        {{ $data->frequency }}
                    </span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $data->title }}
            </h1>
            @if($data->unit)
                <p class="text-xl md:text-2xl text-white/90 font-semibold">
                    {{ $data->unit }}
                </p>
            @endif
        </div>
    </div>
</section>

<!-- Conteúdo -->
<section class="py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Meta informações -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($data->updated_at_data)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Atualizado em</p>
                                <p class="text-sm font-medium text-gray-900">{{ $data->getFormattedUpdatedAtData() }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($data->source)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Fonte</p>
                                <p class="text-sm font-medium text-gray-900">{{ $data->source }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($data->country)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">País</p>
                                <p class="text-sm font-medium text-gray-900">{{ $data->country }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($data->unit)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Unidade</p>
                                <p class="text-sm font-medium text-gray-900">{{ $data->unit }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Comentário -->
            <div class="p-6 md:p-8">
                @if($data->comment)
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Observações</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($data->comment)) !!}
                    </div>
                @endif

                <!-- Dados de Séries -->
                @if($data->dataSeries && $data->dataSeries->count() > 0)
                    <div class="flex items-center justify-between mb-4 mt-8">
                        <h2 class="text-xl font-bold text-gray-900">Dados Históricos</h2>
                    </div>
                    
                    <!-- Toggle entre Tabela e Gráfico -->
                    <div x-data="{
                        view: 'table',
                        chartInstance: null,
                        chartData: @js($data->dataSeries->map(function($series) {
                            return [
                                'date' => \Carbon\Carbon::parse($series->date)->format('d/m/Y'),
                                'value' => $series->value,
                                'label' => $series->label
                            ];
                        })->values()),
                        chartLabel: @js($data->title . ($data->unit ? ' (' . $data->unit . ')' : '')),
                        initChart() {
                            if (this.chartInstance) return;
                            
                            const ctx = document.getElementById('dataChart');
                            if (!ctx) return;
                            
                            this.chartInstance = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: this.chartData.map(item => item.date),
                                    datasets: [{
                                        label: this.chartLabel,
                                        data: this.chartData.map(item => item.value),
                                        borderColor: '#D97706',
                                        backgroundColor: 'rgba(217, 119, 6, 0.1)',
                                        borderWidth: 2,
                                        tension: 0.4,
                                        fill: true,
                                        pointRadius: 4,
                                        pointHoverRadius: 6,
                                        pointBackgroundColor: '#D97706',
                                        pointBorderColor: '#fff',
                                        pointBorderWidth: 2
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'top'
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                            callbacks: {
                                                title: function(context) {
                                                    return context[0].label;
                                                },
                                                label: function(context) {
                                                    return new Intl.NumberFormat('pt-BR', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }).format(context.parsed.y);
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: false,
                                            ticks: {
                                                callback: function(value) {
                                                    return new Intl.NumberFormat('pt-BR', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }).format(value);
                                                }
                                            }
                                        },
                                        x: {
                                            ticks: {
                                                maxRotation: 45,
                                                minRotation: 0
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    }" x-init="$watch('view', value => { if (value === 'chart') { $nextTick(() => initChart()) } })">
                        <div class="flex gap-2 mb-4">
                            <button 
                                @click="view = 'table'" 
                                :class="view === 'table' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700'"
                                class="px-4 py-2 rounded-lg font-medium transition-colors"
                            >
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    Tabela
                                </span>
                            </button>
                            <button 
                                @click="view = 'chart'" 
                                :class="view === 'chart' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700'"
                                class="px-4 py-2 rounded-lg font-medium transition-colors"
                            >
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Gráfico
                                </span>
                            </button>

                            <a href="{{ route('mercado.export', $data->slug) }}" 
                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors sm:ml-auto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Planilha
                            </a>
                        </div>

                        <!-- Visualização em Tabela -->
                        <div x-show="view === 'table'" class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($data->dataSeries as $series)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($series->date)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ number_format($series->value, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Visualização em Gráfico -->
                        <div x-show="view === 'chart'" class="bg-white p-4 rounded-lg border border-gray-200">
                            <canvas id="dataChart" height="100"></canvas>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Relacionados -->
        @if($related->count() > 0)
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Dados Relacionados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($related as $item)
                        <a href="{{ route('mercado.show', $item->slug) }}" class="block group">
                            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                                @if($item->country)
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary mb-3">
                                        {{ $item->country }}
                                    </span>
                                @endif
                                <h4 class="font-semibold text-gray-900 group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                    {{ $item->title }}
                                </h4>
                                @if($item->unit)
                                    <p class="text-sm text-gray-600">{{ $item->unit }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Voltar -->
        <div class="mt-8 text-center">
            <a href="{{ route('mercado.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-secondary transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar para Mercado
            </a>
        </div>
    </div>
</section>
@endsection
