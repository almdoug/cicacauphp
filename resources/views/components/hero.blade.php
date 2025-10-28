<section class="bg-gradient-to-br from-gray-50 to-white py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <!-- Left Side - Text Content -->
            <div class="space-y-6 text-center md:text-left">
                <div class="space-y-2">
                    <p class="text-secondary font-semibold text-sm md:text-base tracking-wide uppercase">
                        Site de Informação do Cacau
                    </p>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight">
                        CICacau: Centro de Inteligência do Cacau
                    </h1>
                </div>
                
                <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                    Temos como missão polarizar e divulgar conhecimentos e informações mercadológicas sobre a cadeia produtiva do cacau no Brasil, para gerar riqueza de forma sustentável e renovável para as gerações atuais e futuras.
                </p>

                <div class="flex flex-wrap gap-4 pt-4 justify-center md:justify-start">
                    <a href="#" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
                        Saiba Mais
                    </a>
                    <a href="#" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold border-2 border-primary hover:bg-primary hover:text-white transition-all">
                        Explorar Conteúdo
                    </a>
                </div>
            </div>

            <!-- Right Side - Image -->
            <div>
                <div class="relative">
                    <div class="absolute inset-0 bg-primary opacity-10 rounded-3xl transform rotate-3"></div>
                    <img 
                        src="{{ asset('images/hero.png') }}" 
                        alt="CICacau - Centro de Inteligência do Cacau" 
                        class="relative"
                    >
                </div>
            </div>
        </div>

        <!-- Sponsor Logo Section -->
        <div class="mt-12 md:mt-16">
            <div class="flex flex-col items-center gap-4">
                <div class="hover:shadow-lg transition-shadow">
                    <img 
                        src="{{ asset('images/uesc.svg') }}" 
                        alt="UESC - Universidade Estadual de Santa Cruz" 
                        class="h-16 md:h-20 w-auto"
                    >
                </div>
            </div>
        </div>
    </div>
</section>
