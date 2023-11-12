<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public const ACTIVE = 1;
    public const INACTIVE = 2;
    protected $fillable = ['name','status','project_id'];
    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function time()
    {
        return $this->hasMany(TimeEntry::class);
    }

    protected $appends = ['task_time'];

    public function getTaskTimeAttribute()
    {
       $total_seconds=0;
       if($this->time()->select('hours')->get()->isNotEmpty()){
            foreach($this->time()->select('hours')->get() as $time){
                list($hours, $minutes, $seconds) = explode(":", $time->hours);
                $total_seconds+= ($hours * 3600) + ($minutes * 60) + $seconds;
            }
        }
        return $total_seconds;
    }
}
