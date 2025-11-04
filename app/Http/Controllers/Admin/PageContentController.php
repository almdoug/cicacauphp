<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /**
     * Exibir formulário de edição de página
     */
    public function edit($page)
    {
        $contents = PageContent::getPageContents($page);
        return view('admin.pages.edit', compact('page', 'contents'));
    }

    /**
     * Atualizar conteúdo da página
     */
    public function update(Request $request, $page)
    {
        $request->validate([
            'contents' => 'required|array',
        ]);

        foreach ($request->contents as $section => $fields) {
            foreach ($fields as $key => $value) {
                PageContent::updateContent($page, $section, $key, $value);
            }
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Conteúdo atualizado com sucesso!');
    }
}
