<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar o primeiro usuário admin
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            $this->command->warn('Nenhum usuário admin encontrado. Crie um usuário admin primeiro.');
            return;
        }

        $newsData = [
            [
                'title' => 'Preço do Cacau Atinge Novo Patamar no Mercado Internacional',
                'summary' => 'Cotação da amêndoa de cacau registra alta significativa impulsionada pela demanda global e condições climáticas favoráveis nas principais regiões produtoras.',
                'content' => "O mercado internacional de cacau registrou nas últimas semanas uma valorização expressiva, com a cotação da amêndoa atingindo patamares não vistos nos últimos meses. Segundo analistas de mercado, diversos fatores contribuíram para essa alta, incluindo o aumento da demanda global por chocolate e produtos derivados de cacau.

As condições climáticas nas principais regiões produtoras, especialmente na África Ocidental e na América Latina, têm se mostrado favoráveis, o que contribui para expectativas de uma safra de qualidade. No entanto, a oferta ainda permanece ajustada devido aos impactos de safras anteriores.

Produtores brasileiros, especialmente da região Sul da Bahia, têm acompanhado com atenção essas movimentações do mercado internacional. A valorização pode representar uma oportunidade importante para o setor cacaueiro nacional, que tem investido em qualidade e certificações.

Especialistas recomendam que produtores se mantenham informados sobre as tendências de mercado e busquem formas de agregar valor à produção, como através de certificações de sustentabilidade e melhoria na qualidade das amêndoas.",
                'source' => 'CI Cacau / Análise de Mercado',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Nova Tecnologia Promete Revolucionar o Cultivo de Cacau',
                'summary' => 'Pesquisadores desenvolvem sistema de monitoramento inteligente que utiliza sensores e inteligência artificial para otimizar a produção e combater pragas de forma mais eficiente.',
                'content' => "Um grupo de pesquisadores da UESC (Universidade Estadual de Santa Cruz) em parceria com instituições internacionais desenvolveu um sistema inovador de monitoramento para plantações de cacau que promete revolucionar o cultivo da cultura.

O sistema, que combina sensores IoT (Internet das Coisas) e algoritmos de inteligência artificial, é capaz de monitorar em tempo real diversos parâmetros da plantação, incluindo umidade do solo, temperatura, incidência de pragas e doenças, e até mesmo estimar a produtividade de cada área.

De acordo com os pesquisadores, a tecnologia permite que os produtores tomem decisões mais assertivas sobre irrigação, aplicação de defensivos e momento ideal de colheita. Os primeiros testes em propriedades piloto mostraram um aumento de até 25% na produtividade e redução de 30% no uso de insumos.

A expectativa é que a tecnologia seja disponibilizada para pequenos e médios produtores através de um modelo de assinatura acessível, democratizando o acesso a ferramentas de agricultura de precisão no setor cacaueiro.

O projeto conta com financiamento de agências de fomento à pesquisa e já despertou interesse de cooperativas e associações de produtores da região.",
                'source' => 'UESC / Inovação Agrícola',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Cacau Sustentável: Certificações Abrem Novos Mercados',
                'summary' => 'Produtores que investem em certificações ambientais e sociais conquistam melhores preços e acesso a mercados premium na Europa e América do Norte.',
                'content' => "O mercado de cacau sustentável tem crescido significativamente nos últimos anos, e produtores brasileiros que investem em certificações estão colhendo os frutos desse movimento global.

Certificações como Rainforest Alliance, UTZ e Orgânico têm aberto portas para mercados premium, especialmente na Europa e América do Norte, onde consumidores estão cada vez mais dispostos a pagar mais por produtos com garantias de sustentabilidade ambiental e social.

Na Bahia, diversas propriedades têm buscado essas certificações, adequando suas práticas de produção para atender aos rigorosos critérios exigidos. Isso inclui desde o manejo ambiental adequado, preservação de áreas de floresta, até garantias de condições dignas de trabalho e não utilização de mão de obra infantil.

Segundo dados de cooperativas da região, produtores certificados conseguem preços até 30% superiores aos praticados no mercado convencional. Além disso, estabelecem relações comerciais de longo prazo com compradores internacionais.

Especialistas destacam que, além dos benefícios econômicos, a adoção de práticas sustentáveis contribui para a preservação do bioma Mata Atlântica e fortalece as comunidades rurais, criando um ciclo virtuoso de desenvolvimento regional sustentável.",
                'source' => 'Associação de Produtores de Cacau',
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($newsData as $news) {
            News::create([
                'user_id' => $admin->id,
                'title' => $news['title'],
                'summary' => $news['summary'],
                'content' => $news['content'],
                'source' => $news['source'],
                'published_at' => $news['published_at'],
            ]);
        }

        $this->command->info('Notícias de exemplo criadas com sucesso!');
    }
}
