@extends('layouts.default')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Bem-vindo ao TaskManager</h1>
            <p class="subtitle">Sua solução completa para gerenciamento de projetos e tarefas</p>
        </div>

        <div class="dashboard-description">
            <div class="description-card">
                <h2>Sobre o Sistema</h2>
                <p>
                    Esta aplicação foi desenvolvida para ajudar você a organizar seus projetos e tarefas de forma eficiente.
                    Com ela você pode:
                </p>
                <ul class="features-list">
                    <li>Criar e acompanhar múltiplos projetos</li>
                    <li>Definir prazos e prioridades</li>
                    <li>Monitorar o status de cada tarefa</li>
                    <li>Visualizar seu progresso de forma clara</li>
                </ul>

                <div class="cta-section">
                    <a href="{{ route('projects.index') }}" class="cta-button">
                        Comece criando seu primeiro projeto →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
