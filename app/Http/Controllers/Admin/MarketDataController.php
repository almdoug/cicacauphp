<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketData;
use App\Models\DataSeries;
use App\Exports\MarketDataDataExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MarketDataController extends Controller
{
    /**
     * Listar dados de mercado
     */
    public function index()
    {
        $marketData = MarketData::orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.market-data.index', compact('marketData'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        return view('admin.market-data.create');
    }

    /**
     * Salvar novo dado de mercado
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'frequency' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'source' => 'nullable|string|max:255',
            'source_link' => 'nullable|url|max:500',
            'unit' => 'nullable|string|max:50',
            'comment' => 'nullable|string',
            'updated_at_data' => 'nullable|date',
            'data_series' => 'nullable|array',
            'data_series.*.date' => 'required_with:data_series|date',
            'data_series.*.value' => 'required_with:data_series|numeric',
            'data_series.*.label' => 'nullable|string|max:100',
            'data_series.*.note' => 'nullable|string|max:255',
        ]);

        $marketData = MarketData::create($validated);

        // Criar séries de dados se fornecidas
        if ($request->has('data_series') && is_array($request->data_series)) {
            foreach ($request->data_series as $seriesData) {
                if (!empty($seriesData['date']) && !empty($seriesData['value'])) {
                    $marketData->dataSeries()->create([
                        'date' => $seriesData['date'],
                        'value' => $seriesData['value'],
                        'label' => $seriesData['label'] ?? null,
                        'note' => $seriesData['note'] ?? null,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', 'Dado de mercado cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(MarketData $marketDatum)
    {
        $marketDatum->load('dataSeries');
        return view('admin.market-data.edit', ['marketData' => $marketDatum]);
    }

    /**
     * Atualizar dado de mercado
     */
    public function update(Request $request, MarketData $marketDatum)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'frequency' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'source' => 'nullable|string|max:255',
            'source_link' => 'nullable|url|max:500',
            'unit' => 'nullable|string|max:50',
            'comment' => 'nullable|string',
            'updated_at_data' => 'nullable|date',
            'data_series' => 'nullable|array',
            'data_series.*.id' => 'nullable|exists:data_series,id',
            'data_series.*.date' => 'required_with:data_series|date',
            'data_series.*.value' => 'required_with:data_series|numeric',
            'data_series.*.label' => 'nullable|string|max:100',
            'data_series.*.note' => 'nullable|string|max:255',
        ]);

        $marketDatum->update($validated);

        // Atualizar séries de dados
        if ($request->has('data_series')) {
            $existingIds = [];
            
            foreach ($request->data_series as $seriesData) {
                if (!empty($seriesData['date']) && !empty($seriesData['value'])) {
                    if (isset($seriesData['id']) && $seriesData['id']) {
                        // Atualizar existente
                        $series = DataSeries::find($seriesData['id']);
                        if ($series && $series->dataable_id === $marketDatum->id) {
                            $series->update([
                                'date' => $seriesData['date'],
                                'value' => $seriesData['value'],
                                'label' => $seriesData['label'] ?? null,
                                'note' => $seriesData['note'] ?? null,
                            ]);
                            $existingIds[] = $series->id;
                        }
                    } else {
                        // Criar novo
                        $newSeries = $marketDatum->dataSeries()->create([
                            'date' => $seriesData['date'],
                            'value' => $seriesData['value'],
                            'label' => $seriesData['label'] ?? null,
                            'note' => $seriesData['note'] ?? null,
                        ]);
                        $existingIds[] = $newSeries->id;
                    }
                }
            }
            
            // Remover séries órfãs
            $marketDatum->dataSeries()->whereNotIn('id', $existingIds)->delete();
        } else {
            // Se não há data_series no request, remover todas
            $marketDatum->dataSeries()->delete();
        }

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', 'Dado de mercado atualizado com sucesso!');
    }

    /**
     * Deletar dado de mercado
     */
    public function destroy(MarketData $marketDatum)
    {
        $marketDatum->delete();

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', 'Dado de mercado deletado com sucesso!');
    }

    /**
     * Exportar dados para Excel
     */
    public function export(MarketData $marketDatum)
    {
        $marketDatum->load('dataSeries');
        
        $filename = 'mercado_' . str_replace(' ', '_', strtolower($marketDatum->title)) . '_' . now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new MarketDataDataExport($marketDatum), $filename);
    }

    /**
     * Publicar/Despublicar dado de mercado
     */
    public function togglePublish(MarketData $marketDatum)
    {
        if ($marketDatum->published_at) {
            $marketDatum->update(['published_at' => null]);
            $message = 'Dado de mercado despublicado com sucesso!';
        } else {
            $marketDatum->update(['published_at' => now()]);
            $message = 'Dado de mercado publicado com sucesso!';
        }

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', $message);
    }
}
