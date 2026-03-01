<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projects = [
            [
                'name' => 'Projeto Horizonte Digital',
                'description' => 'Iniciativa voltada à modernização de processos internos por meio de soluções digitais e automação operacional.'
            ],
            [
                'name' => 'Projeto Atlas Corporativo',
                'description' => 'Estruturação e padronização de fluxos corporativos para aumento de produtividade e governança.'
            ],
            [
                'name' => 'Projeto Nexus Gestão',
                'description' => 'Plataforma integrada para centralização de dados estratégicos e acompanhamento de indicadores.'
            ],
            [
                'name' => 'Projeto Aurora Estratégica',
                'description' => 'Planejamento e execução de melhorias estratégicas focadas em crescimento sustentável.'
            ],
            [
                'name' => 'Projeto Conecta Brasil',
                'description' => 'Solução voltada à integração de equipes e otimização da comunicação organizacional.'
            ],
            [
                'name' => 'Projeto Evolução Ágil',
                'description' => 'Implementação de metodologias ágeis para acelerar entregas e melhorar a eficiência dos times.'
            ],
            [
                'name' => 'Projeto Sigma Operacional',
                'description' => 'Otimização de processos operacionais com foco em redução de custos e aumento de performance.'
            ],
            [
                'name' => 'Projeto Integra Saúde',
                'description' => 'Sistema para organização e gestão eficiente de atendimentos e informações clínicas.'
            ],
            [
                'name' => 'Projeto Impulso Tech',
                'description' => 'Desenvolvimento de soluções tecnológicas para inovação e escalabilidade de serviços.'
            ],
            [
                'name' => 'Projeto Nova Era',
                'description' => 'Transformação digital com foco em inovação, competitividade e adaptação ao mercado atual.'
            ],
        ];

        return $this->faker->randomElement($projects);
    }
}
