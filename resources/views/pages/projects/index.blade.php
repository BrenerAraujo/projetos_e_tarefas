@extends('layouts.default')

@section('title', 'Projetos')

@section('content')
    <div class="entity-container">
        <div class="entity-header">
            <h1>Projetos</h1>
            <a href="{{ route('projects.create') }}" class="btn-new-entity">
                <i class="fas fa-plus"></i> Novo Projeto
            </a>
        </div>

        @if($projects->count() > 0)
            <div class="entity-table-container">
                <table class="entity-table">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Tarefas</th>
                        <th>Data de Entrega</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td><a class="project-title" href="{{ route('tasks.index', $project->id) }}">{{ $project->title }}</a></td>
                            <td>{{ Str::limit($project->description, 50) }}</td>
                            <td>{{ count($project->tasks()->get()) }}</td>
                            <td>{{ date('d/m/Y', strtotime($project->due_date)) }}</td>
                            <td class="actions">
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn-edit" title="Editar Projeto">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirmDelete(this)" title="Excluir Projeto">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <p>Não existem projetos registrados ainda.</p>
                <a href="{{ route('projects.create') }}" class="btn-new-entity">
                    <i class="fas fa-plus"></i> Criar Primeiro Projeto
                </a>
            </div>
        @endif
    </div>
    <script>
        function confirmDelete(button) {
            const projectName = button.closest('tr').querySelector('td:first-child').textContent;
            return confirm(`Tem certeza que deseja excluir o projeto "${projectName.trim()}"? Esta ação não pode ser desfeita.`);
        }
    </script>
@endsection
