<section class="py-12 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8 md:mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Notícias</h2>
                <div class="w-20 h-1 bg-primary"></div>
            </div>
            <a href="#" class="text-primary font-semibold hover:underline flex items-center gap-2 text-sm md:text-base">
                Ver todas
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Featured News (Large Card - Left Side) -->
            <article class="lg:col-span-2 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 flex flex-col">
                <div class="relative overflow-hidden aspect-video">
                    <img 
                        src="https://images.unsplash.com/photo-1511910849309-0dffb8785146?w=800&h=450&fit=crop" 
                        alt="Notícia em destaque" 
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                    >
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Destaque
                        </span>
                    </div>
                </div>
                <div class="p-6 md:p-8 flex-1 flex flex-col">
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            15 de Outubro, 2025
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            CICacau
                        </span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 hover:text-primary transition-colors">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit
                    </h3>
                    <p class="text-gray-600 mb-6 flex-1 line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all">
                        Ler mais
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Secondary News (Right Side - Stacked) -->
            <div class="flex flex-col gap-6">
                <!-- News Card 1 -->
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 flex flex-col">
                    <div class="relative overflow-hidden aspect-video">
                        <img 
                            src="https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=400&h=300&fit=crop" 
                            alt="Notícia" 
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        >
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-2">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                12 de Outubro, 2025
                            </span>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2">
                            Sed ut perspiciatis unde omnis iste natus error
                        </h3>
                        <p class="text-sm text-gray-600 mb-3 flex-1 line-clamp-2">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold text-sm hover:gap-3 transition-all">
                            Ler mais
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- News Card 2 -->
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 flex flex-col">
                    <div class="relative overflow-hidden aspect-video">
                        <img 
                            src="https://images.unsplash.com/photo-1584270354949-c26b0d5b4a0c?w=400&h=300&fit=crop" 
                            alt="Notícia" 
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        >
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-2">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                10 de Outubro, 2025
                            </span>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2">
                            At vero eos et accusamus et iusto odio dignissimos
                        </h3>
                        <p class="text-sm text-gray-600 mb-3 flex-1 line-clamp-2">
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold text-sm hover:gap-3 transition-all">
                            Ler mais
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
