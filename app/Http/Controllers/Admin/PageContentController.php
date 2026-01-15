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

        // Processar membros da equipe se existirem
        if ($page === 'sobre' && $request->has('team_members')) {
            $teamMembers = array_filter($request->team_members, function($member) {
                return !empty($member['name']) || !empty($member['role']);
            });
            
            // Reindexar array
            $teamMembers = array_values($teamMembers);
            
            PageContent::updateContent('sobre', 'equipe', 'conteudo', json_encode($teamMembers), 'array');
        }

        foreach ($request->contents as $section => $fields) {
            foreach ($fields as $key => $value) {
                // Skip equipe/conteudo if it's already been processed
                if ($page === 'sobre' && $section === 'equipe' && $key === 'conteudo') {
                    continue;
                }
                PageContent::updateContent($page, $section, $key, $value);
            }
        }

        return redirect()->route('admin.pages.edit', $page)
            ->with('success', 'Conteúdo atualizado com sucesso!');
    }
}
