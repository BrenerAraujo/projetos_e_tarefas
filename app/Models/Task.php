<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'description', 'status'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function statusAttribute($status) : String {
        if($status == 0) {
            return 'Pendente';
        } else {
            return 'Concluída';
        }
    }
}
