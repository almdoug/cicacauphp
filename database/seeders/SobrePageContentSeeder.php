<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class SobrePageContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            // Hero Section
            ['page' => 'sobre', 'section' => 'hero', 'key' => 'title', 'value' => 'Centro de Inteligência do Cacau (CI Cacau)', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Informação, pesquisa e inovação para o desenvolvimento sustentável do cacau brasileiro', 'type' => 'text'],
            
            // Quem Somos
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'title', 'value' => 'Quem Somos', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'paragraph_1', 'value' => 'O Centro de Inteligência do Cacau (CICacau), criado em 2013, é uma iniciativa estruturante do Sistema Agroindustrial do Cacau, vinculada ao Departamento de Ciências Econômicas e ao Programa de Pós Graduação em Economia Regional e Políticas Públicas da Universidade Estadual de Santa Cruz (UESC).', 'type' => 'textarea'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'paragraph_2', 'value' => 'O portal foi criado para subsidiar iniciativas públicas e privadas, fomentar pesquisas científicas e tecnológicas, e promover o desenvolvimento sustentável da cadeia produtiva do cacau no Brasil.', 'type' => 'textarea'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'item_1', 'value' => 'Notícias e análises de mercado', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'item_2', 'value' => 'Cotações e estatísticas de preços', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'item_3', 'value' => 'Indicadores socioeconômicos', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'item_4', 'value' => 'Políticas públicas e legislação', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'quem_somos', 'key' => 'item_5', 'value' => 'Produção técnico-científica e inovação', 'type' => 'text'],
            
            // Propósito
            ['page' => 'sobre', 'section' => 'proposito', 'key' => 'title', 'value' => 'Propósito', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'proposito', 'key' => 'paragraph_1', 'value' => 'Captar, organizar e disseminar informações mercadológicas, econômicas, técnicas, ambientais e sociais de interesse dos agentes da cadeia produtiva do cacau.', 'type' => 'textarea'],
            ['page' => 'sobre', 'section' => 'proposito', 'key' => 'paragraph_2', 'value' => 'Nosso propósito é apoiar decisões estratégicas e políticas públicas que fortaleçam o setor e gerem valor de forma sustentável.', 'type' => 'textarea'],
            
            // Missão
            ['page' => 'sobre', 'section' => 'missao', 'key' => 'title', 'value' => 'Missão', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'missao', 'key' => 'paragraph_1', 'value' => 'Promover e divulgar conhecimento e inteligência de mercado sobre o cacau brasileiro, integrando pesquisa, inovação e negócios para fortalecer o desenvolvimento sustentável e competitivo do setor.', 'type' => 'textarea'],
            
            // Equipe
            ['page' => 'sobre', 'section' => 'equipe', 'key' => 'title', 'value' => 'Equipe', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'equipe', 'key' => 'conteudo', 'value' => '<div class="mb-12"><h3 class="text-2xl font-bold text-primary mb-6">Coordenação</h3><div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"><p class="text-lg font-semibold text-gray-800">Naisy Silva Soares</p><p class="text-gray-600 mt-1">Coordenadora</p></div></div><div><h3 class="text-2xl font-bold text-primary mb-6">Pesquisadoras</h3><div class="grid md:grid-cols-2 gap-6"><div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"><p class="text-lg font-semibold text-gray-800">Adrielle Victoria Soares Alves</p><p class="text-gray-600 mt-1">Pesquisadora</p></div><div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"><p class="text-lg font-semibold text-gray-800">Zina Cáceres Benevides</p><p class="text-gray-600 mt-1">Pesquisadora</p></div></div></div>', 'type' => 'html'],
            
            // CTA
            ['page' => 'sobre', 'section' => 'cta', 'key' => 'title', 'value' => 'Quer saber mais sobre o CI Cacau?', 'type' => 'text'],
            ['page' => 'sobre', 'section' => 'cta', 'key' => 'subtitle', 'value' => 'Entre em contato conosco ou explore nosso conteúdo', 'type' => 'text'],
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
