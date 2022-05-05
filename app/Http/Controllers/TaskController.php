<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        $tasks = Task::get()->toJson(JSON_PRETTY_PRINT);
        return response($tasks, 200);
    }

    public function createTask(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->content = $request->content;
        $task->save();

        return response()->json([
            "message" => "task record created"
        ], 201);
    }

    public function getTask($id)
    {
        if (Task::where('id', $id)->exists()) {
            $task = Task::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($task, 200);
        }
    }

    public function updateTask(Request $request, $id)
    {
        if (Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->title = is_null($request->title) ? $task->title : $request->title;
            $task->content = is_null($request->content) ? $task->content : $request->content;
            $task->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "task not found"
            ], 404);
        }
    }

    public function deleteTask($id)
    {
        if (Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "task not found"
            ], 404);
        }
    }
}
