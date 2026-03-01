<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tasks = [
            [
                'title' => 'Definir requisitos do sistema',
                'description' => 'Levantamento e documentação dos requisitos funcionais e não funcionais do projeto.',
                'status' => 'todo',
                'priority' => 'high',
            ],
            [
                'title' => 'Configurar ambiente de desenvolvimento',
                'description' => 'Preparar ambiente local com Docker, banco de dados e dependências necessárias.',
                'status' => 'in_progress',
                'priority' => 'medium',
            ],
            [
                'title' => 'Implementar autenticação de usuários',
                'description' => 'Desenvolver fluxo de login, registro e validação de permissões.',
                'status' => 'todo',
                'priority' => 'high',
            ],
            [
                'title' => 'Criar API de gerenciamento de tarefas',
                'description' => 'Desenvolver endpoints REST para criação, listagem e atualização de tarefas.',
                'status' => 'done',
                'priority' => 'high',
            ],
            [
                'title' => 'Desenvolver interface do dashboard',
                'description' => 'Criar layout responsivo para visualização de projetos e tarefas.',
                'status' => 'in_progress',
                'priority' => 'medium',
                'due_date' => now()->subWeek(),
            ],
            [
                'title' => 'Implementar testes automatizados',
                'description' => 'Criar testes unitários e de integração para garantir estabilidade do sistema.',
                'status' => 'todo',
                'priority' => 'medium',
            ],
            [
                'title' => 'Configurar CI/CD',
                'description' => 'Automatizar pipeline de build, testes e deploy da aplicação.',
                'status' => 'todo',
                'priority' => 'low',
                'due_date' => now()->subDay(),
            ],
            [
                'title' => 'Otimizar consultas ao banco',
                'description' => 'Revisar queries e implementar índices para melhorar performance.',
                'status' => 'in_progress',
                'priority' => 'high',
            ],
            [
                'title' => 'Documentar API',
                'description' => 'Criar documentação clara dos endpoints utilizando padrão OpenAPI.',
                'status' => 'done',
                'priority' => 'low',
            ],
            [
                'title' => 'Realizar deploy em produção',
                'description' => 'Publicar aplicação no ambiente de produção e validar funcionamento.',
                'status' => 'todo',
                'priority' => 'high',
                'due_date' => now()->addDays(7),
            ],
        ];

        return $this->faker->randomElement($tasks);
    }
}
