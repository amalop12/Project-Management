<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public const ACTIVE = 1;
    public const INACTIVE = 2;

    protected $fillable = ['name', 'status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected $appends = ['project_time'];

    public function getProjectTimeAttribute()
    {
        $total_seconds = 0;
        if ($this->tasks()->get()->isNotEmpty()) {
            foreach ($this->tasks()->get() as $time) {
                $total_seconds += $time->task_time ?? 0;
            }
        }
        return $total_seconds;
    }

}
