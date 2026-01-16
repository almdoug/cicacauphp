<!-- Cookie Consent Banner -->
<div id="cookieConsent" class="hidden fixed bottom-0 left-0 right-0 z-50 p-4 md:p-6 bg-white border-t-2 border-gray-200 shadow-2xl transform translate-y-full transition-transform duration-500 ease-in-out">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-6">
            <!-- Icon and Text -->
            <div class="flex items-start gap-4 flex-1">
                <!-- Cookie Icon -->
                <div class="flex-shrink-0 bg-primary/10 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                
                <!-- Message -->
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">🍪 Este site utiliza cookies</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Utilizamos cookies para melhorar sua experiência de navegação, analisar o tráfego do site e personalizar o conteúdo. 
                        Ao continuar navegando, você concorda com nossa 
                        <a href="{{ route('cookies') }}" class="text-primary hover:text-secondary underline font-semibold">
                            Política de Cookies
                        </a>.
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <button 
                    onclick="acceptCookies()" 
                    class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg text-sm whitespace-nowrap cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Aceitar Todos
                </button>
                <button 
                    onclick="declineCookies()" 
                    class="inline-flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-3 rounded-lg font-semibold transition-all text-sm whitespace-nowrap cursor-pointer"
                >
                    Apenas Essenciais
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Check if user has already made a choice
    document.addEventListener('DOMContentLoaded', function() {
        const cookieConsent = localStorage.getItem('cookieConsent');
        
        if (!cookieConsent) {
            // Show the banner after a short delay
            setTimeout(() => {
                const banner = document.getElementById('cookieConsent');
                banner.classList.remove('hidden');
                // Trigger animation
                setTimeout(() => {
                    banner.classList.remove('translate-y-full');
                }, 10);
            }, 1000);
        }
    });

    function acceptCookies() {
        localStorage.setItem('cookieConsent', 'accepted');
        hideCookieBanner();
        
        // You can add Google Analytics or other tracking code here
        console.log('Cookies accepted - Analytics can be enabled');
    }

    function declineCookies() {
        localStorage.setItem('cookieConsent', 'declined');
        hideCookieBanner();
        
        console.log('Only essential cookies will be used');
    }

    function hideCookieBanner() {
        const banner = document.getElementById('cookieConsent');
        banner.classList.add('translate-y-full');
        
        // Remove from DOM after animation
        setTimeout(() => {
            banner.classList.add('hidden');
        }, 500);
    }
</script>
