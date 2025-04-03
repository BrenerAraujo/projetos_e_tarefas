@extends('layouts.default')

@section('title', 'Criar Tarefa')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <h1>Criar Nova Tarefa</h1>
            <a href="{{ route('tasks.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST" class="entity-form">
            @csrf

            <div class="form-group">
                <label for="description" class="bold">Descrição</label>
                <textarea name="description" id="description"
                          class="@error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="bold">Status</label>
                <select name="status" id="status">
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Pendente</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Concluída</option>
                </select>

                <label for="project_id" class="bold">Projeto</label>
                <select name="project_id" id="project_id" class="@error('project_id') is-invalid @enderror">
                    <option value="" selected>Selecione um projeto</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}">{{ $project->title }}</option>
                    @endforeach
                </select>
                @error('project_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Salvar Tarefa
                </button>
            </div>
        </form>
    </div>
@endsection
