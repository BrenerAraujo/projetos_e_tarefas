<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'due_date'];

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
