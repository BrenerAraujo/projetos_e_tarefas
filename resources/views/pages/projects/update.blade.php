@extends('layouts.default')

@section('title', 'Editar Projeto')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <h1>Editar Projeto</h1>
            <a href="{{ route('projects.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="project-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="bold">Título</label>
                <input type="text" name="title" id="title"
                       class="@error('title') is-invalid @enderror"
                       value="{{ old('title', $project->title) }}">
                @error('title')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description"
                          class="@error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="due_date" class="bold">Data de Entrega</label>
                <input type="date" name="due_date" id="due_date"
                       class="@error('due_date') is-invalid @enderror"
                       value="{{ old('due_date', date('Y-d-m', strtotime($project->due_date))) }}"
                       min="{{ now()->format('Y-m-d') }}">
                @error('due_date')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('projects.index') }}" class="btn-cancel">
                    Cancelar
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Atualizar Projeto
                </button>
            </div>
        </form>
    </div>
@endsection
