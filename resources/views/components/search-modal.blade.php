<!-- Search Modal -->
<div x-data="searchModal()" 
     x-show="isOpen" 
     x-cloak
     @keydown.escape.window="closeModal()"
     @keydown.meta.k.window.prevent="toggleModal()"
     @keydown.ctrl.k.window.prevent="toggleModal()"
     @search-open.window="toggleModal()"
     class="fixed inset-0 z-[100] overflow-y-auto"
     style="display: none;">
    
    <!-- Backdrop -->
    <div x-show="isOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="closeModal()"
         class="fixed inset-0 bg-gray-900/80 transition-opacity">
    </div>

    <!-- Modal -->
    <div class="flex min-h-full items-start justify-center p-4 sm:p-6 md:p-20">
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @click.stop
             class="relative w-full max-w-2xl transform overflow-hidden rounded-xl bg-white shadow-2xl transition-all">
            
            <!-- Search Input -->
            <div class="relative">
                <div class="pointer-events-none absolute left-4 top-[20px] h-5 w-5 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    x-ref="searchInput"
                    x-model="query"
                    @input="search()"
                    type="text" 
                    class="w-full border-0 bg-transparent pl-11 pr-15 py-4 text-gray-900 placeholder-gray-400 focus:ring-0 text-lg outline-none"
                    placeholder="Buscar no site..."
                    autocomplete="off"
                    maxlength="100"
                >
                <div class="absolute right-4 top-4 flex items-center gap-2">
                    <kbd @click="closeModal()" class="hidden sm:inline-flex items-center rounded border border-gray-200 px-2 py-1 text-xs font-semibold text-gray-600 cursor-pointer hover:bg-gray-100 transition-colors">
                        ESC
                    </kbd>
                </div>
            </div>

            <!-- Results -->
            <div x-show="query.length > 0" class="border-t border-gray-200">
                <!-- Loading State -->
                <div x-show="isLoading" class="p-8 text-center">
                    <div class="inline-flex items-center gap-2 text-gray-600">
                        <svg class="animate-spin h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Buscando...</span>
                    </div>
                </div>

                <!-- Results List -->
                <div x-show="!isLoading && results.length > 0" class="max-h-96 overflow-y-auto search-results-scroll">
                    <ul class="divide-y divide-gray-100">
                        <template x-for="result in results" :key="result.id">
                            <li>
                                <a :href="result.url" 
                                   class="block px-4 py-3 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-start gap-3">
                                        <!-- Icon -->
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-8 w-8 rounded-lg bg-primary/10 flex items-center justify-center">
                                                <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 group-hover:text-primary transition-colors" x-text="result.title"></p>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-2" x-text="result.description"></p>
                                            <p class="text-xs text-primary mt-1" x-text="result.category"></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </template>
                    </ul>
                </div>

                <!-- No Results -->
                <div x-show="!isLoading && query.length > 2 && results.length === 0" class="p-8 text-center">
                    <div class="mx-auto h-12 w-12 text-gray-400 mb-3">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">Nenhum resultado encontrado para "<span x-text="query"></span>"</p>
                </div>

                <!-- Search Tips -->
                <div x-show="query.length === 0 || (query.length > 0 && query.length < 3)" class="p-6 bg-gray-50">
                    <p class="text-xs text-gray-600 mb-3 font-semibold">Dica de busca:</p>
                    <ul class="space-y-2 text-xs text-gray-600">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Digite pelo menos 3 caracteres para buscar
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Pressione <kbd class="px-1 py-0.5 bg-white border border-gray-300 rounded text-xs">ESC</kbd> para fechar
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchModal() {
    return {
        isOpen: false,
        query: '',
        results: [],
        isLoading: false,
        searchTimeout: null,

        toggleModal() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.$nextTick(() => {
                    this.$refs.searchInput.focus();
                });
            } else {
                this.query = '';
                this.results = [];
            }
        },

        closeModal() {
            this.isOpen = false;
            this.query = '';
            this.results = [];
        },

        search() {
            // Clear previous timeout
            clearTimeout(this.searchTimeout);

            // Don't search if query is too short
            if (this.query.length < 3) {
                this.results = [];
                return;
            }

            // Set loading state
            this.isLoading = true;

            // Debounce search
            this.searchTimeout = setTimeout(() => {
                this.performSearch();
            }, 300);
        },

        async performSearch() {
            try {
                const response = await fetch(`/api/search?q=${encodeURIComponent(this.query)}`);
                const data = await response.json();
                this.results = data.results || [];
            } catch (error) {
                console.error('Search error:', error);
                this.results = [];
            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>

<style>
    [x-cloak] { 
        display: none !important; 
    }
</style>
