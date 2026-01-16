@extends('layouts.app')

@section('title', 'Política de Cookies - CICacau')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Política de Cookies</h1>
            <p class="text-lg opacity-90">
                Entenda como utilizamos cookies em nosso site
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-6 md:p-10 space-y-8">
            
            <!-- Última atualização -->
            <div class="text-sm text-gray-500 border-b pb-4">
                <strong>Última atualização:</strong> {{ date('d/m/Y') }}
            </div>

            <!-- O que são cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">O que são cookies?</h2>
                <p class="text-gray-700 leading-relaxed">
                    Cookies são pequenos arquivos de texto que são armazenados no seu dispositivo quando você visita um site. 
                    Eles são amplamente utilizados para fazer com que os sites funcionem de forma mais eficiente, 
                    além de fornecer informações aos proprietários do site.
                </p>
            </section>

            <!-- Como usamos cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Como usamos cookies?</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    O CICacau utiliza cookies para melhorar a experiência do usuário e entender como nosso site é utilizado. 
                    Utilizamos cookies para:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Manter você conectado durante a navegação</li>
                    <li>Lembrar suas preferências e configurações</li>
                    <li>Entender como você interage com nosso conteúdo</li>
                    <li>Melhorar a funcionalidade e desempenho do site</li>
                    <li>Fornecer recursos de segurança</li>
                </ul>
            </section>

            <!-- Tipos de cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Tipos de cookies que utilizamos</h2>
                
                <div class="space-y-6">
                    <!-- Cookies essenciais -->
                    <div class="border-l-4 border-primary pl-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Cookies Essenciais</h3>
                        <p class="text-gray-700">
                            Estes cookies são necessários para o funcionamento básico do site. 
                            Eles incluem cookies que permitem que você faça login em áreas seguras do site.
                        </p>
                    </div>

                    <!-- Cookies de desempenho -->
                    <div class="border-l-4 border-secondary pl-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Cookies de Desempenho</h3>
                        <p class="text-gray-700">
                            Estes cookies nos permitem reconhecer e contar o número de visitantes e ver como os 
                            visitantes se movem pelo site. Isso nos ajuda a melhorar a forma como o site funciona.
                        </p>
                    </div>

                    <!-- Cookies de funcionalidade -->
                    <div class="border-l-4 border-primary pl-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Cookies de Funcionalidade</h3>
                        <p class="text-gray-700">
                            Estes cookies são usados para reconhecê-lo quando você retorna ao nosso site. 
                            Isso nos permite personalizar o conteúdo para você e lembrar suas preferências.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Cookies de terceiros -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Cookies de Terceiros</h2>
                <p class="text-gray-700 leading-relaxed">
                    Em alguns casos, utilizamos cookies fornecidos por terceiros confiáveis. Esta seção detalha 
                    quais cookies de terceiros você pode encontrar através deste site:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4 mt-4">
                    <li>Ferramentas de análise para entender como você usa nosso site</li>
                    <li>Plugins de redes sociais que permitem compartilhar conteúdo</li>
                </ul>
            </section>

            <!-- Gerenciar cookies -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Como gerenciar cookies?</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Você pode configurar seu navegador para recusar todos ou alguns cookies, ou para alertá-lo quando 
                    sites definirem ou acessarem cookies. Se você desabilitar ou recusar cookies, observe que algumas 
                    partes deste site podem se tornar inacessíveis ou não funcionar corretamente.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Para saber mais sobre cookies, incluindo como ver quais cookies foram configurados e como gerenciá-los 
                    e excluí-los, visite <a href="https://www.allaboutcookies.org" target="_blank" class="text-primary hover:text-secondary underline">www.allaboutcookies.org</a>.
                </p>
            </section>

            <!-- Alterações na política -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Alterações nesta Política</h2>
                <p class="text-gray-700 leading-relaxed">
                    Podemos atualizar nossa Política de Cookies de tempos em tempos. Notificaremos você sobre 
                    quaisquer mudanças publicando a nova Política de Cookies nesta página e atualizando a data 
                    de "Última atualização" no topo deste documento.
                </p>
            </section>

            <!-- Contato -->
            <section class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Entre em contato</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Se você tiver dúvidas sobre esta Política de Cookies, entre em contato conosco:
                </p>
                <div class="space-y-2 text-gray-700">
                    <p>
                        <strong>E-mail:</strong> 
                        <a href="mailto:cicacau@nbcgib.uesc.br" class="text-primary hover:text-secondary">
                            cicacau@nbcgib.uesc.br
                        </a>
                    </p>
                    <p>
                        <strong>Telefone:</strong> 
                        <a href="tel:7336805215" class="text-primary hover:text-secondary">
                            (73) 3680-5215
                        </a>
                    </p>
                </div>
            </section>

            <!-- Botão voltar -->
            <div class="pt-6 border-t">
                <a href="{{ route('home') }}" class="inline-flex items-center text-primary hover:text-secondary transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Voltar para a página inicial
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
