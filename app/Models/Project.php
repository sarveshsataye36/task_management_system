<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\ProjectRequest;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_user_id',
        'project_name',
        'project_desc',
        'project_status',
    ];

    /**
     * Deleting all tasks if project delete
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($project) {
            $project->tasks()->delete();
        });
    }


    /**
     * Define one to many relationship between projects and tasks
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_project_id', 'id');
    }

    /**
     * Define one to many relationship between projects and tasks
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'project_user_id', 'id');
    }
}
