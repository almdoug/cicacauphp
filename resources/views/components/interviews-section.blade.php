<section class="py-12 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="mb-8 md:mb-12">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Entrevistas</h2>
                    <div class="w-20 h-1 bg-primary"></div>
                </div>
                <a href="#" class="text-primary font-semibold hover:underline flex items-center gap-2 text-sm md:text-base">
                    Ver todas
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Slider Container -->
        <div x-data="{
            currentSlide: 0,
            slides: [
                {
                    name: 'Dr. João Silva',
                    role: 'Pesquisador Sênior em Cacauicultura',
                    institution: 'UESC',
                    title: 'O Futuro da Produção de Cacau no Brasil',
                    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    date: '18 de Outubro, 2025',
                    image: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&h=600&fit=crop'
                },
                {
                    name: 'Dra. Maria Santos',
                    role: 'Especialista em Agroecologia',
                    institution: 'CEPLAC',
                    title: 'Sustentabilidade na Cadeia do Cacau',
                    excerpt: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
                    date: '12 de Outubro, 2025',
                    image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&h=600&fit=crop'
                },
                {
                    name: 'Prof. Carlos Mendes',
                    role: 'Economista Rural',
                    institution: 'UESC',
                    title: 'Análise de Mercado do Cacau 2025',
                    excerpt: 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.',
                    date: '05 de Outubro, 2025',
                    image: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=600&h=600&fit=crop'
                }
            ],
            autoplay: null,
            init() {
                this.startAutoplay();
            },
            startAutoplay() {
                if (this.autoplay) {
                    clearInterval(this.autoplay);
                }
                this.autoplay = setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                }, 5000);
            },
            stopAutoplay() {
                if (this.autoplay) {
                    clearInterval(this.autoplay);
                    this.autoplay = null;
                }
            },
            next() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                this.stopAutoplay();
                this.startAutoplay();
            },
            prev() {
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                this.stopAutoplay();
                this.startAutoplay();
            },
            goTo(index) {
                this.currentSlide = index;
                this.stopAutoplay();
                this.startAutoplay();
            }
        }" class="relative" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()">
            
            <!-- Slides -->
            <div class="overflow-hidden rounded-2xl shadow-2xl bg-white relative min-h-[400px] lg:min-h-[500px] pointer-events-none">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="currentSlide === index"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="lg:absolute lg:inset-0 grid grid-cols-1 lg:grid-cols-5 gap-0 pointer-events-auto">
                        
                        <!-- Image (Left) -->
                        <div class="lg:col-span-2 relative min-h-[300px] lg:min-h-[500px]">
                            <img :src="slide.image" 
                                 :alt="slide.name" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-transparent to-black/10"></div>
                            
                            <!-- Interview Badge -->
                            <div class="absolute top-6 left-6">
                                <div class="bg-secondary text-gray-900 px-4 py-2 rounded-full font-semibold text-sm flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                    </svg>
                                    Entrevista
                                </div>
                            </div>
                        </div>

                        <!-- Text Content (Right - Takes more space) -->
                        <div class="lg:col-span-3 p-8 md:p-12 flex flex-col justify-center">
                            <!-- Guest Info -->
                            <div class="mb-6">
                                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2" x-text="slide.name"></h3>
                                <p class="text-primary font-semibold mb-1" x-text="slide.role"></p>
                                <p class="text-gray-600 text-sm" x-text="slide.institution"></p>
                            </div>
                            
                            <!-- Interview Title -->
                            <h4 class="text-xl md:text-2xl font-bold text-gray-800 mb-4" x-text="slide.title"></h4>
                            
                            <!-- Date -->
                            <div class="inline-flex items-center gap-2 text-gray-600 mb-6">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span x-text="slide.date"></span>
                            </div>
                            
                            <!-- Excerpt -->
                            <p class="text-gray-700 text-base md:text-lg leading-relaxed mb-8" x-text="slide.excerpt"></p>
                            
                            <!-- CTA Buttons -->
                            <div class="flex flex-wrap gap-4">
                                <a href="#" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all inline-flex items-center gap-2">
                                    Ler entrevista completa
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-primary px-6 py-3 rounded-lg font-semibold border-2 border-primary hover:bg-primary hover:text-white transition-all inline-flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Assistir vídeo
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation Arrows -->
            <button @click="prev()" 
                    class="absolute cursor-pointer -left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg hover:shadow-xl transition-all z-10 pointer-events-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next()" 
                    class="absolute cursor-pointer -right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg hover:shadow-xl transition-all z-10 pointer-events-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="flex justify-center gap-2 mt-6">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="goTo(index)" 
                            class="w-3 h-3 rounded-full transition-all cursor-pointer"
                            :class="currentSlide === index ? 'bg-primary w-8' : 'bg-gray-300 hover:bg-gray-400'">
                    </button>
                </template>
            </div>
        </div>
    </div>
</section>
