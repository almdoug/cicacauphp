@extends('layouts.app')

@section('title', 'Termos de Uso - CICacau')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Termos de Uso</h1>
            <p class="text-lg opacity-90">
                Condições gerais de uso do site CICacau
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

            <!-- Introdução -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Aceitação dos Termos</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Bem-vindo ao site do Centro de Inteligência do Cacau (CICacau). Ao acessar e usar este site, você 
                    concorda em cumprir e estar vinculado aos seguintes Termos de Uso. Se você não concordar com alguma 
                    parte destes termos, não deverá usar nosso site.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Estes Termos de Uso aplicam-se a todos os visitantes, usuários e outras pessoas que acessam ou usam 
                    o site.
                </p>
            </section>

            <!-- Sobre o CICacau -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Sobre o CICacau</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    O CICacau é uma iniciativa vinculada à Universidade Estadual de Santa Cruz (UESC), dedicada à 
                    produção e disseminação de conhecimento sobre a cadeia produtiva do cacau. Nosso objetivo é:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Fornecer informações técnicas e científicas sobre cacau</li>
                    <li>Promover pesquisas e estudos sobre a cultura cacaueira</li>
                    <li>Apoiar o desenvolvimento sustentável da cadeia produtiva</li>
                    <li>Facilitar o acesso a dados de mercado e custos de produção</li>
                    <li>Divulgar eventos, cursos e oportunidades do setor</li>
                </ul>
            </section>

            <!-- Uso do Site -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Uso Permitido do Site</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Você pode usar nosso site para:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4 mb-4">
                    <li>Acessar informações sobre pesquisas, notícias e dados do setor cacaueiro</li>
                    <li>Consultar dados de mercado e custos de produção</li>
                    <li>Participar de eventos e cursos oferecidos</li>
                    <li>Entrar em contato conosco através dos canais disponibilizados</li>
                    <li>Compartilhar conteúdo em redes sociais (quando permitido)</li>
                </ul>
                <p class="text-gray-700 leading-relaxed">
                    O uso do site é permitido apenas para fins legítimos e em conformidade com estes Termos de Uso.
                </p>
            </section>

            <!-- Uso Proibido -->
            <section class="bg-red-50 p-6 rounded-lg border border-red-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Atividades Proibidas</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Você concorda em NÃO usar o site para:
                </p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Violar qualquer lei ou regulamento local, nacional ou internacional</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Transmitir material que seja difamatório, obsceno, ofensivo ou ilegal</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Fazer-se passar por outra pessoa ou entidade</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Tentar obter acesso não autorizado ao site ou sistemas relacionados</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Usar técnicas de coleta automática de dados (web scraping) sem autorização prévia</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Transmitir vírus, malware ou qualquer código malicioso</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Interferir ou interromper o funcionamento do site</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-600 mr-2">✗</span>
                        <span>Reproduzir, duplicar ou copiar material sem autorização expressa</span>
                    </li>
                </ul>
            </section>

            <!-- Propriedade Intelectual -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Propriedade Intelectual</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Todo o conteúdo deste site, incluindo, mas não se limitando a textos, gráficos, logotipos, ícones, 
                    imagens, clipes de áudio, downloads digitais e compilações de dados, é propriedade do CICacau, 
                    UESC ou de seus fornecedores de conteúdo e está protegido pelas leis brasileiras e internacionais 
                    de propriedade intelectual.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    O uso não autorizado de qualquer material deste site pode violar leis de direitos autorais, marcas 
                    registradas e outras leis aplicáveis.
                </p>
                <div class="border-l-4 border-primary pl-4 bg-blue-50 p-4 rounded">
                    <p class="text-gray-700">
                        <strong>Uso Acadêmico:</strong> Pesquisadores e estudantes podem citar nosso conteúdo para fins 
                        acadêmicos, desde que forneçam a devida atribuição e crédito ao CICacau.
                    </p>
                </div>
            </section>

            <!-- Conteúdo de Terceiros -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Links para Sites de Terceiros</h2>
                <p class="text-gray-700 leading-relaxed">
                    Nosso site pode conter links para sites de terceiros que não são de propriedade ou controlados pelo 
                    CICacau. Não temos controle sobre, e não assumimos responsabilidade pelo conteúdo, políticas de 
                    privacidade ou práticas de quaisquer sites de terceiros. Você reconhece e concorda que o CICacau 
                    não será responsável, direta ou indiretamente, por qualquer dano ou perda causados ou supostamente 
                    causados pelo uso de tais sites.
                </p>
            </section>

            <!-- Dados e Informações -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Dados e Informações Fornecidos</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Embora nos esforcemos para manter as informações no site precisas e atualizadas:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Não garantimos a precisão, completude ou atualidade de qualquer informação</li>
                    <li>Os dados de mercado e custos são fornecidos para fins informativos e de pesquisa</li>
                    <li>Não nos responsabilizamos por decisões comerciais baseadas em nossas informações</li>
                    <li>Recomendamos a verificação de dados críticos em múltiplas fontes</li>
                </ul>
            </section>

            <!-- Cadastro e Conta -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Cadastro e Conta de Usuário</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Algumas funcionalidades do site podem requerer cadastro. Ao criar uma conta, você concorda em:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Fornecer informações verdadeiras, precisas e completas</li>
                    <li>Manter a segurança de sua senha</li>
                    <li>Notificar-nos imediatamente sobre qualquer uso não autorizado de sua conta</li>
                    <li>Aceitar a responsabilidade por todas as atividades em sua conta</li>
                </ul>
            </section>

            <!-- Privacidade -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Privacidade e Proteção de Dados</h2>
                <p class="text-gray-700 leading-relaxed">
                    O tratamento de seus dados pessoais está descrito em nossa 
                    <a href="{{ route('privacidade') }}" class="text-primary hover:text-secondary underline font-semibold">
                        Política de Privacidade
                    </a>, 
                    que está em conformidade com a Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018). 
                    Ao usar nosso site, você concorda com o tratamento de seus dados conforme descrito na Política de Privacidade.
                </p>
            </section>

            <!-- Limitação de Responsabilidade -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Limitação de Responsabilidade</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Na extensão máxima permitida pela lei aplicável:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>O CICacau não será responsável por quaisquer danos diretos, indiretos, incidentais, especiais ou consequenciais</li>
                    <li>Não garantimos que o site estará sempre disponível ou livre de erros</li>
                    <li>Não nos responsabilizamos por interrupções causadas por manutenção, atualizações ou problemas técnicos</li>
                    <li>O site é fornecido "como está" sem garantias de qualquer tipo</li>
                </ul>
            </section>

            <!-- Indenização -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Indenização</h2>
                <p class="text-gray-700 leading-relaxed">
                    Você concorda em indenizar, defender e isentar o CICacau, UESC, seus afiliados, funcionários e 
                    parceiros de e contra quaisquer reivindicações, responsabilidades, danos, perdas e despesas, 
                    incluindo honorários advocatícios, decorrentes de ou relacionados ao seu uso do site ou violação 
                    destes Termos de Uso.
                </p>
            </section>

            <!-- Modificações -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Modificações dos Termos</h2>
                <p class="text-gray-700 leading-relaxed">
                    Reservamos o direito de modificar ou substituir estes Termos de Uso a qualquer momento. As 
                    alterações entrarão em vigor imediatamente após sua publicação no site. Seu uso continuado do 
                    site após quaisquer alterações constitui aceitação dos novos Termos de Uso.
                </p>
            </section>

            <!-- Rescisão -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">13. Rescisão</h2>
                <p class="text-gray-700 leading-relaxed">
                    Podemos encerrar ou suspender seu acesso ao site imediatamente, sem aviso prévio ou responsabilidade, 
                    por qualquer motivo, incluindo, sem limitação, se você violar estes Termos de Uso. Todas as 
                    disposições destes Termos que, por sua natureza, devam sobreviver à rescisão, sobreviverão à rescisão.
                </p>
            </section>

            <!-- Lei Aplicável -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">14. Lei Aplicável e Jurisdição</h2>
                <p class="text-gray-700 leading-relaxed">
                    Estes Termos de Uso são regidos e interpretados de acordo com as leis brasileiras, sem considerar 
                    suas disposições sobre conflitos de leis. Quaisquer disputas relacionadas a estes termos serão 
                    submetidas à jurisdição exclusiva dos tribunais competentes da comarca de Ilhéus, Estado da Bahia.
                </p>
            </section>

            <!-- Divisibilidade -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">15. Divisibilidade</h2>
                <p class="text-gray-700 leading-relaxed">
                    Se qualquer disposição destes Termos de Uso for considerada inválida ou inexequível por um tribunal 
                    de jurisdição competente, tal disposição será alterada e interpretada para alcançar os objetivos de 
                    tal disposição na maior extensão possível sob a lei aplicável, e as disposições restantes continuarão 
                    em pleno vigor e efeito.
                </p>
            </section>

            <!-- Contato -->
            <section class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">16. Contato</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Se você tiver dúvidas sobre estes Termos de Uso, entre em contato conosco:
                </p>
                <div class="space-y-2 text-gray-700">
                    <p>
                        <strong>Centro de Inteligência do Cacau - CICacau</strong>
                    </p>
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
                    <p class="text-sm text-gray-600 mt-4">
                        <strong>Endereço:</strong><br>
                        Universidade Estadual de Santa Cruz - UESC<br>
                        Departamento de Ciências Econômicas
                    </p>
                </div>
            </section>

            <!-- Aceitação -->
            <section class="bg-primary/10 p-6 rounded-lg border-2 border-primary">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Aceitação dos Termos</h2>
                <p class="text-gray-700 leading-relaxed">
                    <strong>Ao usar este site, você reconhece que leu, compreendeu e concorda em estar vinculado a 
                    estes Termos de Uso e à nossa Política de Privacidade.</strong>
                </p>
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
