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
            ['page' => 'home', 'section' => 'mercado', 'key' => 'card1_text', 'value' => 'Preços, produção e exportações', 'type' => 'text'],
            ['page' => 'home', 'section' => 'mercado', 'key' => 'card2_text', 'value' => 'Mercado nacional e internacional', 'type' => 'text'],
            ['page' => 'home', 'section' => 'mercado', 'key' => 'card3_text', 'value' => 'Análises conjunturais semanais', 'type' => 'text'],
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
            PageContent::create($content);
        }
    }
}
