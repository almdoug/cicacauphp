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
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'file_spreadsheet' => 'nullable|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        // Upload do PDF se fornecido
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $fileName = time() . '_pdf_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('production-costs', $fileName, 'public');
            
            $validated['file_pdf_path'] = $filePath;
            $validated['file_pdf_name'] = $file->getClientOriginalName();
        }

        // Upload da planilha se fornecido
        if ($request->hasFile('file_spreadsheet')) {
            $file = $request->file('file_spreadsheet');
            $fileName = time() . '_spreadsheet_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('production-costs', $fileName, 'public');
            
            $validated['file_spreadsheet_path'] = $filePath;
            $validated['file_spreadsheet_name'] = $file->getClientOriginalName();
        }

        $productionCost = ProductionCost::create($validated);

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
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'file_spreadsheet' => 'nullable|file|mimes:xlsx,xls,csv|max:10240',
            'remove_pdf' => 'nullable|boolean',
            'remove_spreadsheet' => 'nullable|boolean',
        ]);

        // Remover PDF existente se solicitado
        if ($request->has('remove_pdf') && $request->remove_pdf) {
            if ($productionCost->file_pdf_path) {
                Storage::disk('public')->delete($productionCost->file_pdf_path);
                $validated['file_pdf_path'] = null;
                $validated['file_pdf_name'] = null;
            }
        }

        // Remover planilha existente se solicitado
        if ($request->has('remove_spreadsheet') && $request->remove_spreadsheet) {
            if ($productionCost->file_spreadsheet_path) {
                Storage::disk('public')->delete($productionCost->file_spreadsheet_path);
                $validated['file_spreadsheet_path'] = null;
                $validated['file_spreadsheet_name'] = null;
            }
        }

        // Upload de novo PDF se fornecido
        if ($request->hasFile('file_pdf')) {
            // Remover PDF antigo
            if ($productionCost->file_pdf_path) {
                Storage::disk('public')->delete($productionCost->file_pdf_path);
            }
            
            $file = $request->file('file_pdf');
            $fileName = time() . '_pdf_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('production-costs', $fileName, 'public');
            
            $validated['file_pdf_path'] = $filePath;
            $validated['file_pdf_name'] = $file->getClientOriginalName();
        }

        // Upload de nova planilha se fornecido
        if ($request->hasFile('file_spreadsheet')) {
            // Remover planilha antiga
            if ($productionCost->file_spreadsheet_path) {
                Storage::disk('public')->delete($productionCost->file_spreadsheet_path);
            }
            
            $file = $request->file('file_spreadsheet');
            $fileName = time() . '_spreadsheet_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('production-costs', $fileName, 'public');
            
            $validated['file_spreadsheet_path'] = $filePath;
            $validated['file_spreadsheet_name'] = $file->getClientOriginalName();
        }

        $productionCost->update($validated);

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção atualizado com sucesso!');
    }

    /**
     * Deletar custo de produção
     */
    public function destroy(ProductionCost $productionCost)
    {
        // Remover arquivos associados se existirem
        if ($productionCost->file_pdf_path) {
            Storage::disk('public')->delete($productionCost->file_pdf_path);
        }
        if ($productionCost->file_spreadsheet_path) {
            Storage::disk('public')->delete($productionCost->file_spreadsheet_path);
        }
        
        $productionCost->delete();

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção deletado com sucesso!');
    }

    /**
     * Exportar dados para Excel
     */
    public function export(ProductionCost $productionCost, $type = 'pdf')
    {
        // Determinar qual arquivo baixar
        if ($type === 'spreadsheet' && $productionCost->file_spreadsheet_path) {
            if (Storage::disk('public')->exists($productionCost->file_spreadsheet_path)) {
                $filePath = Storage::disk('public')->path($productionCost->file_spreadsheet_path);
                $fileName = $productionCost->file_spreadsheet_name ?? basename($productionCost->file_spreadsheet_path);
                return response()->download($filePath, $fileName);
            }
        } elseif ($productionCost->file_pdf_path) {
            if (Storage::disk('public')->exists($productionCost->file_pdf_path)) {
                $filePath = Storage::disk('public')->path($productionCost->file_pdf_path);
                $fileName = $productionCost->file_pdf_name ?? basename($productionCost->file_pdf_path);
                return response()->download($filePath, $fileName);
            }
        }
        
        // Caso contrário, retornar erro ou redirecionar
        return redirect()
            ->route('admin.production-costs.edit', $productionCost)
            ->with('error', 'Nenhum arquivo disponível para download.');
    }

    /**
     * Publicar/Despublicar custo de produção
     */
    public function togglePublish(ProductionCost $productionCost)
    {
        if ($productionCost->published_at) {
            $productionCost->update(['published_at' => null]);
            $message = 'Custo de produção despublicado com sucesso!';
        } else {
            $productionCost->update(['published_at' => now()]);
            $message = 'Custo de produção publicado com sucesso!';
        }

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', $message);
    }
}
