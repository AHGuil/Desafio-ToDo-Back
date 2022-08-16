<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class ApiController extends Controller
{
    public function getAllTasks() {
    // Busca todas as tarefas
        $tasks = Task::get()->toJson(JSON_PRETTY_PRINT);
        return response($tasks, 200);
    }

    public function createTask(Request $request) {
    // Inclui tarefa no banco
        $task = new Task;
        $task->name = $request->name;
        $task->status = $request->status;
        $task->save();

        return response()->json([
            "message" => "Tarefa incluída com sucesso"
        ], 201);
    }

    public function getTask($id) {
    // Busca tarefa específica
        if (Task::where('id', $id)->exists()) {
            $task = Task::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($task, 200);
        } else {
            return response()->json([
            "message" => "Tarefa não encontrada!"
            ], 404);
        }
    }

    public function updateTask(Request $request, $id) {
    // Atualiza tarefa
        if (Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->name = is_null($request->name) ? $task->name : $request->name;
            $task->status = is_null($request->status) ? $task->status : $request->status;
            $task->save();

            return response()->json([
                "message" => "Tarefa alterada com sucesso!"
            ], 200);
            } else {
            return response()->json([
                "message" => "Tarefa não encontrada!"
            ], 404);
            
        }
    }

    public function deleteTask ($id) {
    // Exclui tarefa
        if(Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->delete();

            return response()->json([
                "message" => "Tarefa excluída com sucesso!"
            ], 202);
          
        } else {
            return response()->json([
                "message" => "Tarefa não encontrada!"
            ], 404);
        }
    }
}
