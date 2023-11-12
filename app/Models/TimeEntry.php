<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;
    public const ACTIVE = 1;
    public const INACTIVE = 2;
    protected $table = 'time_entry';
    protected $fillable = ['hours','entry_date','description','task_id'];
    public function task(){
        return $this->belongsTo(Task::class);
    }
}
