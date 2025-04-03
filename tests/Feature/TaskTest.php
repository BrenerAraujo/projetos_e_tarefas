<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_tarefa_vinculada()
    {
        $projeto = Project::create([
            'title' => 'Projeto Teste',
            'due_date' => now()->addWeek()
        ]);

        $dados = [
            'description' => 'Tarefa Teste',
            'project_id' => $projeto->id
        ];

        $response = $this->post(route('tasks.store'), $dados);

        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $dados);
    }

    /** @test */
    public function descricao_e_obrigatoria()
    {
        $projeto = Project::create([
            'title' => 'Projeto Teste',
            'due_date' => now()->addWeek()
        ]);

        $response = $this->post(route('tasks.store'), [
            'project_id' => $projeto->id
        ]);

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function projeto_e_obrigatorio()
    {
        $response = $this->post(route('tasks.store'), [
            'description' => 'Tarefa sem Projeto'
        ]);

        $response->assertSessionHasErrors('project_id');
    }

    /** @test */
    public function pode_listar_tarefas_do_projeto()
    {
        $projeto = Project::create([
            'title' => 'Projeto Teste',
            'due_date' => now()->addWeek()
        ]);

        Task::create([
            'description' => 'Tarefa 1',
            'project_id' => $projeto->id
        ]);

        Task::create([
            'description' => 'Tarefa 2',
            'project_id' => $projeto->id
        ]);

        $response = $this->get(route('tasks.index', $projeto->id));

        $tarefas = $response->viewData('tasks');
        $this->assertCount(2, $tarefas);
        $this->assertEquals($projeto->id, $tarefas->first()->project_id);
    }
}
