<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            // Hero Section
            ['page' => 'home', 'section' => 'hero', 'key' => 'title', 'value' => 'Centro de Inteligência do Cacau (CI Cacau)', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Conhecimento e inteligência para o desenvolvimento do cacau no Brasil', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'description', 'value' => 'O Centro de Inteligência do Cacau (CI Cacau) é uma plataforma dedicada à coleta, análise e difusão de informações estratégicas sobre o setor cacaueiro. Nosso objetivo é conectar ciência, tecnologia e mercado para impulsionar a competitividade e sustentabilidade da cadeia produtiva do cacau.', 'type' => 'textarea'],
            
            // Mercado Section
            ['page' => 'home', 'section' => 'mercado', 'key' => 'title', 'value' => 'Acompanhe o mercado', 'type' => 'text'],
            ['page' => 'home', 'section' => 'mercado', 'key' => 'subtitle', 'value' => 'Indicadores e estatísticas atualizadas', 'type' => 'text'],
            ['page' => 'home', 'section' => 'mercado', 'key' => 'cards', 'value' => '<div class="grid grid-cols-1 md:grid-cols-3 gap-8"><div class="bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-shadow"><div class="flex items-center justify-center w-16 h-16 bg-primary bg-opacity-10 rounded-lg mb-4"><svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div><p class="text-gray-700 font-medium">Preços, produção e exportações</p></div><div class="bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-shadow"><div class="flex items-center justify-center w-16 h-16 bg-primary bg-opacity-10 rounded-lg mb-4"><svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div><p class="text-gray-700 font-medium">Mercado nacional e internacional</p></div><div class="bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-shadow"><div class="flex items-center justify-center w-16 h-16 bg-primary bg-opacity-10 rounded-lg mb-4"><svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg></div><p class="text-gray-700 font-medium">Análises conjunturais semanais</p></div></div>', 'type' => 'html'],
            ['page' => 'home', 'section' => 'mercado', 'key' => 'button_text', 'value' => 'Acesse o Mercado', 'type' => 'text'],
            ['page' => 'home', 'section' => 'mercado', 'key' => 'button_link', 'value' => '#', 'type' => 'text'],
            
            // Ciência Section
            ['page' => 'home', 'section' => 'ciencia', 'key' => 'title', 'value' => 'Ciência e Tecnologia', 'type' => 'text'],
            ['page' => 'home', 'section' => 'ciencia', 'key' => 'subtitle', 'value' => 'Produções técnico-científicas e inovação', 'type' => 'text'],
            ['page' => 'home', 'section' => 'ciencia', 'key' => 'description', 'value' => 'Acesse artigos, livros, relatórios e projetos desenvolvidos por universidades, centros de pesquisa e profissionais do setor.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'ciencia', 'key' => 'button_text', 'value' => 'Explore a produção científica', 'type' => 'text'],
            ['page' => 'home', 'section' => 'ciencia', 'key' => 'button_link', 'value' => '#', 'type' => 'text'],
            
            // Notícias Section
            ['page' => 'home', 'section' => 'noticias', 'key' => 'title', 'value' => 'Notícias e Destaques', 'type' => 'text'],
            ['page' => 'home', 'section' => 'noticias', 'key' => 'subtitle', 'value' => 'O que está acontecendo no mundo do cacau', 'type' => 'text'],
            ['page' => 'home', 'section' => 'noticias', 'key' => 'description', 'value' => 'Fique por dentro de eventos, cursos, editais e as principais notícias sobre o setor.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'noticias', 'key' => 'button_text', 'value' => 'Veja mais', 'type' => 'text'],
            ['page' => 'home', 'section' => 'noticias', 'key' => 'button_link', 'value' => '#', 'type' => 'text'],
            
            // Conecte-se Section
            ['page' => 'home', 'section' => 'conecte', 'key' => 'title', 'value' => 'Conecte-se com o CI Cacau', 'type' => 'text'],
            ['page' => 'home', 'section' => 'conecte', 'key' => 'subtitle', 'value' => 'Parceiros, instituições e profissionais unidos pelo desenvolvimento sustentável do cacau.', 'type' => 'text'],
            ['page' => 'home', 'section' => 'conecte', 'key' => 'description', 'value' => 'Faça parte desta rede de conhecimento e colaboração. Entre em contato conosco e descubra como podemos trabalhar juntos.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'conecte', 'key' => 'button_text', 'value' => 'Fale Conosco', 'type' => 'text'],
            ['page' => 'home', 'section' => 'conecte', 'key' => 'button_link', 'value' => '#', 'type' => 'text'],
        ];

        foreach ($contents as $content) {
            PageContent::updateOrCreate(
                [
                    'page' => $content['page'],
                    'section' => $content['section'],
                    'key' => $content['key'],
                ],
                [
                    'value' => $content['value'],
                    'type' => $content['type'],
                ]
            );
        }
    }
}
