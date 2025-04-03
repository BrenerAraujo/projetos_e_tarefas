<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $rules = [
        'description' => 'required|min:5',
        'project_id'  => 'required|exists:projects,id',
    ];

    public $messages = [
        'description.required' => 'Preencha a descrição!',
        'description.min'      => 'A descrição deve conter ao menos 5 caracteres!',
        'project_id.required'  => 'Selecione um projeto!',
        'project_id.exists'    => 'Selecione um projeto!',
    ];

    public function index($project_id = null) {
        if($project_id == null)
            $tasks = Task::orderBy('created_at', 'asc')->get();
        else
            $tasks = Task::where('project_id', $project_id)->orderBy('created_at', 'asc')->get();

        return view('pages.tasks.index', compact('tasks'));
    }

    public function create() {
        $projects = Project::all();

        return view('pages.tasks.create', compact('projects'));
    }

    public function store(Request $request) {
        $request->validate($this->rules, $this->messages);

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function edit($id) {
        $task = Task::find($id);
        $projects = Project::all();

        return view('pages.tasks.update', compact('task', 'projects'));
    }

    public function update(Request $request, $id) {
        $request->validate($this->rules, $this->messages);

        $task = Task::find($id);
        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    public function destroy($id) {
        $task = Task::find($id);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
