<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_user_id',
        'task_project_id',
        'task_name',
        'task_details',
        'task_status',
    ];


    /**
     * The attributes that are mass assignable.
     */
    public function projects()
    {
        return $this->belongsTo(Project::class, 'task_project_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'task_user_id', 'id');
    }
}
