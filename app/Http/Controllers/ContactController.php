<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Exibir página de contato
     */
    public function index()
    {
        return view('contato');
    }

    /**
     * Processar formulário de contato
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Por favor, informe seu nome.',
            'email.required' => 'Por favor, informe seu e-mail.',
            'email.email' => 'Por favor, informe um e-mail válido.',
            'subject.required' => 'Por favor, informe o assunto.',
            'message.required' => 'Por favor, escreva sua mensagem.',
        ]);

        // Aqui você pode implementar o envio de e-mail
        // Mail::to('cicacau@nbcgib.uesc.br')->send(new ContactFormMail($validated));

        return back()->with('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
    }
}
