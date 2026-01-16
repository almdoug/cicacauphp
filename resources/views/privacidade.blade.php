@extends('layouts.app')

@section('title', 'Política de Privacidade - CICacau')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Política de Privacidade</h1>
            <p class="text-lg opacity-90">
                Comprometidos com a proteção dos seus dados pessoais
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
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Introdução</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    O Centro de Inteligência do Cacau (CICacau) respeita a sua privacidade e está comprometido em proteger 
                    seus dados pessoais. Esta Política de Privacidade explica como coletamos, usamos, armazenamos e 
                    compartilhamos suas informações pessoais de acordo com a Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018).
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Ao utilizar nosso site e serviços, você concorda com a coleta e uso de informações de acordo com esta política.
                </p>
            </section>

            <!-- Definições -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Definições</h2>
                <div class="space-y-3 text-gray-700">
                    <p><strong>Dados Pessoais:</strong> Qualquer informação relacionada a uma pessoa natural identificada ou identificável.</p>
                    <p><strong>Titular:</strong> Pessoa natural a quem se referem os dados pessoais que são objeto de tratamento.</p>
                    <p><strong>Tratamento:</strong> Toda operação realizada com dados pessoais, como coleta, produção, recepção, classificação, utilização, acesso, reprodução, transmissão, distribuição, processamento, arquivamento, armazenamento, eliminação, avaliação ou controle da informação, modificação, comunicação, transferência, difusão ou extração.</p>
                    <p><strong>Controlador:</strong> Pessoa natural ou jurídica, de direito público ou privado, a quem competem as decisões referentes ao tratamento de dados pessoais.</p>
                </div>
            </section>

            <!-- Dados Coletados -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Dados Pessoais que Coletamos</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Podemos coletar e processar os seguintes dados sobre você:
                </p>
                
                <div class="space-y-6">
                    <div class="border-l-4 border-primary pl-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Informações que você nos fornece</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                            <li>Nome completo</li>
                            <li>Endereço de e-mail</li>
                            <li>Número de telefone</li>
                            <li>Instituição ou organização</li>
                            <li>Área de atuação ou interesse</li>
                            <li>Mensagens e comunicações enviadas através de formulários de contato</li>
                        </ul>
                    </div>

                    <div class="border-l-4 border-secondary pl-4">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Informações coletadas automaticamente</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                            <li>Endereço IP</li>
                            <li>Tipo de navegador e versão</li>
                            <li>Sistema operacional</li>
                            <li>Páginas visitadas e tempo de permanência</li>
                            <li>Origem da visita (referrer)</li>
                            <li>Data e hora de acesso</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Base Legal -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Base Legal para o Tratamento de Dados</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Coletamos e processamos seus dados pessoais com base nas seguintes bases legais previstas na LGPD:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li><strong>Consentimento:</strong> Quando você nos fornece seus dados voluntariamente através de formulários</li>
                    <li><strong>Execução de contrato:</strong> Para fornecimento de serviços solicitados</li>
                    <li><strong>Legítimo interesse:</strong> Para melhorar nossos serviços e garantir a segurança do site</li>
                    <li><strong>Cumprimento de obrigação legal:</strong> Quando necessário para cumprimento de obrigações legais</li>
                </ul>
            </section>

            <!-- Como usamos os dados -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Como Usamos seus Dados Pessoais</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Utilizamos seus dados pessoais para as seguintes finalidades:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Responder às suas solicitações e comunicações</li>
                    <li>Fornecer informações sobre pesquisas, eventos e notícias relacionadas ao cacau</li>
                    <li>Melhorar nosso site e serviços</li>
                    <li>Realizar análises estatísticas e pesquisas</li>
                    <li>Cumprir obrigações legais e regulatórias</li>
                    <li>Proteger nossos direitos legais e prevenir fraudes</li>
                    <li>Enviar comunicações sobre atividades do CICacau (quando autorizado)</li>
                </ul>
            </section>

            <!-- Compartilhamento -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Compartilhamento de Dados</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Não vendemos, alugamos ou comercializamos seus dados pessoais. Podemos compartilhar suas informações apenas nas seguintes situações:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Com parceiros acadêmicos e de pesquisa, quando necessário para atividades colaborativas</li>
                    <li>Com prestadores de serviços que nos auxiliam na operação do site (hospedagem, análise de dados)</li>
                    <li>Quando exigido por lei ou ordem judicial</li>
                    <li>Para proteção dos nossos direitos, propriedade ou segurança</li>
                </ul>
                <p class="text-gray-700 leading-relaxed mt-4">
                    Garantimos que todos os terceiros que acessam seus dados estão obrigados a protegê-los de acordo com a LGPD.
                </p>
            </section>

            <!-- Armazenamento -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Armazenamento e Segurança dos Dados</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Implementamos medidas técnicas e organizacionais apropriadas para proteger seus dados pessoais contra 
                    acesso não autorizado, alteração, divulgação ou destruição. Isso inclui:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Criptografia de dados em trânsito e em repouso</li>
                    <li>Controles de acesso restrito</li>
                    <li>Monitoramento regular de segurança</li>
                    <li>Treinamento de equipe sobre proteção de dados</li>
                </ul>
                <p class="text-gray-700 leading-relaxed mt-4">
                    Seus dados serão armazenados pelo tempo necessário para cumprir as finalidades descritas nesta política 
                    ou conforme exigido por lei.
                </p>
            </section>

            <!-- Direitos do Titular -->
            <section class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Seus Direitos como Titular dos Dados</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    De acordo com a LGPD, você tem os seguintes direitos em relação aos seus dados pessoais:
                </p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Confirmação e acesso:</strong> Confirmar se tratamos seus dados e acessá-los</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Correção:</strong> Corrigir dados incompletos, inexatos ou desatualizados</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Anonimização, bloqueio ou eliminação:</strong> De dados desnecessários, excessivos ou tratados em desconformidade</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Portabilidade:</strong> Receber seus dados em formato estruturado e interoperável</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Informação:</strong> Sobre com quem compartilhamos seus dados</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Revogação do consentimento:</strong> A qualquer momento</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Oposição:</strong> Ao tratamento realizado com base em legítimo interesse</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span><strong>Revisão:</strong> De decisões automatizadas</span>
                    </li>
                </ul>
            </section>

            <!-- Exercício dos Direitos -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Como Exercer seus Direitos</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Para exercer qualquer um dos seus direitos ou esclarecer dúvidas sobre o tratamento dos seus dados pessoais, 
                    entre em contato conosco através dos canais abaixo. Responderemos à sua solicitação no prazo estabelecido pela LGPD.
                </p>
            </section>

            <!-- Menores de Idade -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Dados de Menores de Idade</h2>
                <p class="text-gray-700 leading-relaxed">
                    Nosso site não é direcionado a menores de 18 anos. Não coletamos intencionalmente dados pessoais de 
                    menores sem o consentimento dos pais ou responsáveis legais. Se você acredita que coletamos dados de um 
                    menor sem autorização, entre em contato conosco imediatamente.
                </p>
            </section>

            <!-- Alterações -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Alterações nesta Política</h2>
                <p class="text-gray-700 leading-relaxed">
                    Podemos atualizar esta Política de Privacidade periodicamente. A versão mais recente estará sempre 
                    disponível em nosso site com a data da última atualização. Recomendamos que você revise esta política 
                    regularmente para se manter informado sobre como protegemos seus dados.
                </p>
            </section>

            <!-- Legislação Aplicável -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Legislação e Foro</h2>
                <p class="text-gray-700 leading-relaxed">
                    Esta Política de Privacidade é regida pelas leis brasileiras, especialmente pela Lei nº 13.709/2018 
                    (Lei Geral de Proteção de Dados - LGPD). Quaisquer disputas relacionadas a esta política serão 
                    submetidas ao foro da comarca competente.
                </p>
            </section>

            <!-- Encarregado de Dados -->
            <section class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Encarregado de Proteção de Dados (DPO)</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Para questões relacionadas ao tratamento de dados pessoais, você pode entrar em contato com nosso 
                    Encarregado de Proteção de Dados:
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
                    <p class="text-sm text-gray-600 mt-4">
                        <strong>Endereço:</strong> Universidade Estadual de Santa Cruz - UESC<br>
                        Departamento de Ciências Econômicas
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
