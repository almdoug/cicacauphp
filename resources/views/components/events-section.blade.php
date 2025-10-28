<section class="py-12 md:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="mb-8 md:mb-12">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Eventos</h2>
                    <div class="w-20 h-1 bg-primary"></div>
                </div>
                <a href="#" class="text-primary font-semibold hover:underline flex items-center gap-2 text-sm md:text-base">
                    Ver todos
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
                    title: 'Workshop: Produção Sustentável de Cacau',
                    date: '25 de Outubro, 2025',
                    location: 'UESC - Campus Soane Nazaré',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.',
                    image: 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop'
                },
                {
                    title: 'Seminário Internacional do Cacau',
                    date: '02 de Novembro, 2025',
                    location: 'Centro de Convenções - Ilhéus',
                    description: 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.',
                    image: 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=600&h=400&fit=crop'
                },
                {
                    title: 'Curso: Gestão da Propriedade Cacaueira',
                    date: '10 de Novembro, 2025',
                    location: 'Online - Plataforma CICacau',
                    description: 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.',
                    image: 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600&h=400&fit=crop'
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
                        
                        <!-- Text Content (Left - Takes more space) -->
                        <div class="lg:col-span-3 p-8 md:p-12 flex flex-col justify-center order-2 lg:order-1">
                            <div class="inline-flex items-center gap-2 text-primary font-semibold mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span x-text="slide.date"></span>
                            </div>
                            
                            <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4" x-text="slide.title"></h3>
                            
                            <div class="flex items-center gap-2 text-gray-600 mb-6">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span x-text="slide.location"></span>
                            </div>
                            
                            <p class="text-gray-700 text-base md:text-lg leading-relaxed mb-8" x-text="slide.description"></p>
                            
                            <div class="flex flex-wrap gap-4">
                                <a href="#" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all inline-flex items-center gap-2">
                                    Inscrever-se
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-primary px-6 py-3 rounded-lg font-semibold border-2 border-primary hover:bg-primary hover:text-white transition-all">
                                    Mais informações
                                </a>
                            </div>
                        </div>

                        <!-- Image (Right) -->
                        <div class="lg:col-span-2 relative min-h-[300px] lg:min-h-[500px] order-1 lg:order-2">
                            <img :src="slide.image" 
                                 :alt="slide.title" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-l from-transparent to-black/10"></div>
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
