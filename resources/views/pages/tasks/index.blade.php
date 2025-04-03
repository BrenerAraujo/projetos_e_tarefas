@extends('layouts.default')

@section('title', 'Tarefas')

@section('content')
    <div class="entity-container">
        <div class="entity-header">
            <h1>Tarefas</h1>
            <a href="{{ route('tasks.create') }}" class="btn-new-entity">
                <i class="fas fa-plus"></i> Nova Tarefa
            </a>
        </div>

        @if($tasks->count() > 0)
            <div class="entity-table-container">
                <table class="entity-table">
                    <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Projeto</th>
                        <th>Data de criação</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ Str::limit($task->description, 50) }}</td>
                            <td>{{ $task->statusAttribute($task->status) }}</td>
                            <td>{{ $task->project->title }}</td>
                            <td>{{ date('d/m/Y', strtotime($task->created_at)) }}</td>
                            <td class="actions">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirmDelete(this)">
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
                <p>Não existem tarefas registrados ainda.</p>
                <a href="{{ route('tasks.create') }}" class="btn-new-entity">
                    <i class="fas fa-plus"></i> Criar Primeira Tarefa
                </a>
            </div>
        @endif
    </div>
    <script>
        function confirmDelete(button) {
            const taskName = button.closest('tr').querySelector('td:first-child').textContent;
            return confirm('Tem certeza que deseja excluir esta tarefa? Esta ação não pode ser desfeita.');
        }
    </script>
@endsection
