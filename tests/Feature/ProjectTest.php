<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_projeto_com_dados_validos()
    {
        $dados = [
            'title' => 'Projeto Teste',
            'due_date' => now()->addWeek()->format('Y-m-d')
        ];

        $response = $this->post(route('projects.store'), $dados);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $dados);
    }

    /** @test */
    public function titulo_e_obrigatorio()
    {
        $response = $this->post(route('projects.store'), [
            'due_date' => now()->addDay()->format('Y-m-d')
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('projects', 0);
    }

    /** @test */
    public function data_deve_ser_futura()
    {
        $response = $this->post(route('projects.store'), [
            'title' => 'Título Válido',
            'due_date' => now()->subDay()->format('Y-m-d')
        ]);

        $response->assertSessionHasErrors('due_date');
    }

    /** @test */
    public function descricao_e_opcional()
    {
        $response = $this->post(route('projects.store'), [
            'title' => 'Projeto sem Descrição',
            'due_date' => now()->addWeek()->format('Y-m-d')
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', ['description' => null]);
    }

    /** @test */
    public function listagem_ordenada_por_data()
    {
        $projeto1 = Project::create([
            'title' => 'Projeto 3 Dias',
            'due_date' => now()->addDays(3)
        ]);

        $projeto2 = Project::create([
            'title' => 'Projeto 1 Dia',
            'due_date' => now()->addDay()
        ]);

        $response = $this->get(route('projects.index'));

        $projetos = $response->viewData('projects');
        $this->assertEquals($projeto2->id, $projetos->first()->id);
    }

    /** @test */
    public function pode_atualizar_projeto()
    {
        $projeto = Project::create([
            'title' => 'Título Antigo',
            'due_date' => now()->addWeek()
        ]);

        $novosDados = [
            'title' => 'Título Atualizado',
            'due_date' => now()->addMonth()->format('Y-m-d')
        ];

        $response = $this->put(route('projects.update', $projeto), $novosDados);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $novosDados);
    }

    /** @test */
    public function pode_excluir_projeto()
    {
        $projeto = Project::create([
            'title' => 'Projeto para Excluir',
            'due_date' => now()->addWeek()
        ]);

        $response = $this->delete(route('projects.destroy', $projeto));

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $projeto->id]);
    }
}
