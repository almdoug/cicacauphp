<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PageContent;

class ResetPageContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:reset {--page=* : Páginas específicas para resetar (home, sobre)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reseta o conteúdo das páginas para os valores padrão dos seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pages = $this->option('page');
        
        if (empty($pages)) {
            if (!$this->confirm('Deseja resetar TODAS as páginas?')) {
                $this->info('Operação cancelada.');
                return;
            }
            $pages = ['home', 'sobre'];
        }

        foreach ($pages as $page) {
            $this->info("Resetando conteúdo da página: {$page}");
            
            // Remove todo o conteúdo da página
            PageContent::where('page', $page)->delete();
            
            // Executa o seeder específico
            if ($page === 'home') {
                $this->call('db:seed', ['--class' => 'PageContentSeeder']);
            } elseif ($page === 'sobre') {
                $this->call('db:seed', ['--class' => 'SobrePageContentSeeder']);
            }
        }

        $this->info('✓ Conteúdo resetado com sucesso!');
    }
}
