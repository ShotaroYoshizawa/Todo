<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rule;

class DeleteTask extends CreateTask
{
    use DeleteTask;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
}