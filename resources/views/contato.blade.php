@extends('layouts.app')

@section('meta_title', 'Contato | CI Cacau')
@section('meta_description', 'Entre em contato com o Centro de Inteligência do Cacau. Tire suas dúvidas, envie sugestões ou solicite informações sobre a cadeia produtiva do cacau.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Entre em Contato
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Estamos aqui para ajudar. Envie sua mensagem e responderemos o mais breve possível.
            </p>
        </div>
    </div>
</section>

<!-- Contato -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            <!-- Informações de Contato -->
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informações de Contato</h2>
                
                <div class="space-y-6">
                    <!-- E-mail -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">E-mail</h3>
                            <a href="mailto:cicacau@nbcgib.uesc.br" class="text-primary hover:underline">
                                cicacau@nbcgib.uesc.br
                            </a>
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Endereço</h3>
                            <p class="text-gray-600">
                                Universidade Estadual de Santa Cruz – UESC<br>
                                Campus Soane Nazaré de Andrade<br>
                                Rodovia Jorge Amado, Km 16<br>
                                Ilhéus/BA - CEP 45662-900
                            </p>
                        </div>
                    </div>

                    <!-- Telefone -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Telefone</h3>
                            <a href="tel:7336805215" class="text-primary hover:underline">
                                (73) 3680-5215
                            </a>
                        </div>
                    </div>

                    <!-- Redes Sociais -->
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="font-semibold text-gray-900 mb-4">Siga-nos nas Redes Sociais</h3>
                        <div class="flex gap-3">
                            <!-- Instagram -->
                            <a 
                                href="https://instagram.com/cicacau" 
                                target="_blank"
                                class="w-12 h-12 bg-gradient-to-tr from-purple-600 via-pink-500 to-orange-400 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform"
                                aria-label="Instagram"
                            >
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>

                            <!-- LinkedIn -->
                            <a 
                                href="https://linkedin.com/company/cicacau" 
                                target="_blank"
                                class="w-12 h-12 bg-blue-700 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform"
                                aria-label="LinkedIn"
                            >
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>

                            <!-- YouTube -->
                            <a 
                                href="https://youtube.com/@cicacau" 
                                target="_blank"
                                class="w-12 h-12 bg-red-600 text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform"
                                aria-label="YouTube"
                            >
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulário de Contato -->
            <div class="lg:col-span-2">
                <div class="bg-gray-50 rounded-2xl p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Envie sua Mensagem</h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contato.send') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nome completo *
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('name') border-red-500 @enderror"
                                    placeholder="Seu nome"
                                    required
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- E-mail -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    E-mail *
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('email') border-red-500 @enderror"
                                    placeholder="seu@email.com"
                                    required
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Assunto -->
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Assunto *
                            </label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject" 
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all @error('subject') border-red-500 @enderror"
                                placeholder="Assunto da mensagem"
                                required
                            >
                            @error('subject')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mensagem -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Mensagem *
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="6"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all resize-none @error('message') border-red-500 @enderror"
                                placeholder="Escreva sua mensagem aqui..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botão de Envio -->
                        <div>
                            <button 
                                type="submit" 
                                class="w-full md:w-auto px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all flex items-center justify-center gap-2"
                            >
                                Enviar Mensagem
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mapa -->
<section class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Nossa Localização</h2>
        <div class="rounded-2xl overflow-hidden shadow-lg">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.4762968669887!2d-39.17213672393857!3d-14.798254585697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x739a9b0a45b9a1b%3A0x5aa4e36c5be4c0b0!2sUniversidade%20Estadual%20de%20Santa%20Cruz%20(UESC)!5e0!3m2!1spt-BR!2sbr!4v1702828800000!5m2!1spt-BR!2sbr" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full"
            ></iframe>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 text-center">
            Perguntas Frequentes
        </h2>

        <div class="space-y-4" x-data="{ openFaq: null }">
            <!-- FAQ Item 1 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button 
                    @click="openFaq = openFaq === 1 ? null : 1"
                    class="w-full px-6 py-4 text-left flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors"
                >
                    <span class="font-semibold text-gray-900">Como posso contribuir com o CI Cacau?</span>
                    <svg class="w-5 h-5 text-primary transition-transform" :class="openFaq === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 1" x-collapse class="px-6 py-4 bg-white">
                    <p class="text-gray-600">
                        Você pode contribuir de diversas formas: enviando notícias relevantes sobre o setor, compartilhando dados e pesquisas, 
                        participando de eventos, ou entrando em contato para parcerias institucionais. Entre em contato conosco para saber mais!
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button 
                    @click="openFaq = openFaq === 2 ? null : 2"
                    class="w-full px-6 py-4 text-left flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors"
                >
                    <span class="font-semibold text-gray-900">Vocês oferecem consultoria para produtores de cacau?</span>
                    <svg class="w-5 h-5 text-primary transition-transform" :class="openFaq === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 2" x-collapse class="px-6 py-4 bg-white">
                    <p class="text-gray-600">
                        O CI Cacau é um centro de inteligência e informação. Embora não ofereçamos consultoria direta, 
                        disponibilizamos dados, pesquisas e análises que podem auxiliar produtores em suas tomadas de decisão. 
                        Podemos também direcioná-lo a parceiros e instituições que oferecem esse tipo de serviço.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button 
                    @click="openFaq = openFaq === 3 ? null : 3"
                    class="w-full px-6 py-4 text-left flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors"
                >
                    <span class="font-semibold text-gray-900">Qual o prazo para resposta do contato?</span>
                    <svg class="w-5 h-5 text-primary transition-transform" :class="openFaq === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 3" x-collapse class="px-6 py-4 bg-white">
                    <p class="text-gray-600">
                        Nosso prazo de resposta é de até 48 horas úteis. Em períodos de alta demanda ou férias acadêmicas, 
                        esse prazo pode ser um pouco maior. Para assuntos urgentes, recomendamos o contato por telefone.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button 
                    @click="openFaq = openFaq === 4 ? null : 4"
                    class="w-full px-6 py-4 text-left flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors"
                >
                    <span class="font-semibold text-gray-900">Como posso divulgar um evento no site?</span>
                    <svg class="w-5 h-5 text-primary transition-transform" :class="openFaq === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="openFaq === 4" x-collapse class="px-6 py-4 bg-white">
                    <p class="text-gray-600">
                        Envie as informações do evento (título, data, local, descrição e link para inscrição) através do 
                        formulário de contato ou diretamente para nosso e-mail. Nossa equipe avaliará e, se pertinente ao setor, 
                        incluiremos na seção de Cursos e Eventos.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
