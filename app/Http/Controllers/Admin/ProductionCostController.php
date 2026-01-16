<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionCost;
use App\Models\DataSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductionCostDataExport;

class ProductionCostController extends Controller
{
    /**
     * Listar custos de produção
     */
    public function index()
    {
        $costs = ProductionCost::orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.production-costs.index', compact('costs'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        return view('admin.production-costs.create');
    }

    /**
     * Salvar novo custo de produção
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'frequency' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'source' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:50',
            'comment' => 'nullable|string',
            'updated_at_data' => 'nullable|date',
            'data_series' => 'nullable|array',
            'data_series.*.date' => 'required_with:data_series|date',
            'data_series.*.value' => 'required_with:data_series|numeric',
            'data_series.*.label' => 'nullable|string|max:100',
            'data_series.*.note' => 'nullable|string|max:255',
        ]);


        $productionCost = ProductionCost::create($validated);

        // Criar séries de dados se fornecidas
        if ($request->has('data_series') && is_array($request->data_series)) {
            foreach ($request->data_series as $seriesData) {
                if (!empty($seriesData['date']) && !empty($seriesData['value'])) {
                    $productionCost->dataSeries()->create([
                        'date' => $seriesData['date'],
                        'value' => $seriesData['value'],
                        'label' => $seriesData['label'] ?? null,
                        'note' => $seriesData['note'] ?? null,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(ProductionCost $productionCost)
    {
        $productionCost->load('dataSeries');
        return view('admin.production-costs.edit', compact('productionCost'));
    }

    /**
     * Atualizar custo de produção
     */
    public function update(Request $request, ProductionCost $productionCost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'frequency' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'source' => 'nullable|string|max:255',
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

        $productionCost->update($validated);

        // Atualizar séries de dados
        if ($request->has('data_series')) {
            $existingIds = [];
            
            foreach ($request->data_series as $seriesData) {
                if (!empty($seriesData['date']) && !empty($seriesData['value'])) {
                    if (isset($seriesData['id']) && $seriesData['id']) {
                        // Atualizar existente
                        $series = DataSeries::find($seriesData['id']);
                        if ($series && $series->dataable_id === $productionCost->id) {
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
                        $newSeries = $productionCost->dataSeries()->create([
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
            $productionCost->dataSeries()->whereNotIn('id', $existingIds)->delete();
        } else {
            // Se não há data_series no request, remover todas
            $productionCost->dataSeries()->delete();
        }

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção atualizado com sucesso!');
    }

    /**
     * Deletar custo de produção
     */
    public function destroy(ProductionCost $productionCost)
    {
        $productionCost->delete();

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção deletado com sucesso!');
    }

    /**
     * Exportar dados para Excel
     */
    public function export(ProductionCost $productionCost)
    {
        $productionCost->load('dataSeries');
        
        $filename = 'custo_producao_' . str_replace(' ', '_', strtolower($productionCost->title)) . '_' . now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new ProductionCostDataExport($productionCost), $filename);
    }
}
