<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public $rules = [
            'title' => 'required|max:255',
            'due_date' => 'required|date|after_or_equal:today',
        ];

    public $messages = [
            'title.required'          => 'Preencha o título do projeto!',
            'title.max'               => 'O título deve ter no máximo 255 caracteres!',
            'due_date.required'       => 'Preencha a data de entrega do projeto!',
            'due_date.after_or_equal' => 'A data de entrega não pode ser anterior a hoje!'
        ];

    public function index() {
        $projects = Project::orderBy('due_date', 'asc')->get();

        return view('pages.projects.index', compact('projects'));
    }

    public function create() {
        return view('pages.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules, $this->messages);

        Project::create($request->all());

        return redirect()->route('projects.index');
    }

    public function edit($id) {
        $project = Project::find($id);

        return view('pages.projects.update', compact('project'));
    }

    public function update(Request $request, $id) {
        $request->validate($this->rules, $this->messages);

        $project = Project::find($id);
        $project->update($request->all());

        return redirect()->route('projects.index');
    }

    public function destroy($id) {
        $project = Project::find($id);

        $project->delete();

        return redirect()->route('projects.index');
    }
}
