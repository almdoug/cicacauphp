<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false, destacandoOpen: false, mercadoOpen: false, cienciaOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 absolute left-4 sm:left-6 lg:left-8">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo_cicacau.svg') }}" alt="CICacau" class="h-20">
                </a>
            </div>

            <!-- Mobile Search (Center) -->
            <div class="lg:hidden flex-1 flex justify-center px-20">
                <button class="text-gray-700 hover:text-primary p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex lg:items-center lg:space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                    Início
                </a>

                <a  ref="#" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                    O Centro
                </a>

                <!-- Dropdown Destaques -->
                <div class="relative" @mouseenter="destacandoOpen = true" @mouseleave="destacandoOpen = false">
                    <button class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors flex items-center gap-1">
                        Destaques
                        <svg class="w-4 h-4 transition-transform" :class="destacandoOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="destacandoOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Notícias</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Cursos e Eventos</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Entrevistas</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Custo de Produção</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Links</a>
                    </div>
                </div>

                <!-- Dropdown Mercado -->
                <div class="relative" @mouseenter="mercadoOpen = true" @mouseleave="mercadoOpen = false">
                    <button class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors flex items-center gap-1">
                        Mercado
                        <svg class="w-4 h-4 transition-transform" :class="mercadoOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="mercadoOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Preço</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Produção</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Exportação</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Importação</a>
                    </div>
                </div>

                <!-- Dropdown Ciência e Tecnologia -->
                <div class="relative" @mouseenter="cienciaOpen = true" @mouseleave="cienciaOpen = false">
                    <button class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors flex items-center gap-1">
                        Ciência e Tecnologia
                        <svg class="w-4 h-4 transition-transform" :class="cienciaOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="cienciaOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Artigos e Documentos</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Editais</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Livros</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Patentes</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition-colors">Teses e Dissertações</a>
                    </div>
                </div>

                <a href="#" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium transition-colors">
                    Contato
                </a>
            </div>

            <!-- Search and Login (Right Side) -->
            <div class="hidden lg:flex lg:items-center lg:gap-4 absolute right-4 sm:right-6 lg:right-8">
                <!-- Search Icon -->
                <button class="text-gray-700 hover:text-primary p-2 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <!-- Login Button -->
                <a href="#" class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 transition-all">
                    Login
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden absolute right-4">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-primary p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden fixed inset-0 top-20 bg-white z-40 flex flex-col">
        <div class="flex-1 overflow-y-auto px-4 pt-4 pb-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md transition-colors">
                Início
            </a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md transition-colors">
                O Centro
            </a>

            <!-- Mobile Dropdown Destaques -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md transition-colors">
                    <span>Destaques</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="pl-6 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Notícias</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Cursos e Eventos</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Entrevistas</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Custo de Produção</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Links</a>
                </div>
            </div>

            <!-- Mobile Dropdown Mercado -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md transition-colors">
                    <span>Mercado</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="pl-6 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Preço</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Produção</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Exportação</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Importação</a>
                </div>
            </div>

            <!-- Mobile Dropdown Ciência e Tecnologia -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md transition-colors">
                    <span>Ciência e Tecnologia</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="pl-6 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Artigos e Documentos</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Editais</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Livros</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Patentes</a>
                    <a href="#" class="block px-3 py-2 text-sm text-gray-600 hover:text-primary rounded-md">Teses e Dissertações</a>
                </div>
            </div>

            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md transition-colors">
                Contato
            </a>
        </div>

        <!-- Login Button Footer -->
        <div class="border-t border-gray-200 p-4">
            <a href="#" class="block w-full bg-primary text-white px-6 py-3 rounded-lg text-center font-semibold hover:bg-opacity-90 transition-all">
                Login
            </a>
        </div>
    </div>
</nav>
