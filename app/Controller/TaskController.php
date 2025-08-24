<?php

namespace App\Controller;

use App\Model\Task;
use App\Utils\Request;
use App\Utils\Response;

class TaskController
{
    private Task $model;

    public function __construct()
    {
        $this->model = new Task();
    }

    public function create(Request $request)
    {
        try {
            $data = $request->getBody();
            $taskID = $this->model->create($data);
            Response::send(['id' => $taskID, 'message' => 'Task created successfully'], 201);
        } catch (\Exception $e) {
            Response::send(['error' => $e->getMessage()], 400);
        }
    }

    public function getAll()
    {
        $tasks = $this->model->getAll();
        Response::send($tasks);
    }

    public function getByID(Request $request)
    {
        try {
            $taskID = $request->getPathParam('id');
            $task = $this->model->getByID($taskID);
            Response::send($task);
        } catch (\Exception $e) {
            Response::send(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        try {
            $taskID = $request->getPathParam('id');
            $data = $request->getBody();
            $this->model->update($taskID, $data);
            Response::send(['message' => 'Task updated successfully']);
        } catch (\Exception $e) {
            Response::send(['error' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $taskID = $request->getPathParam('id');
            $this->model->delete($taskID);
            Response::send(['message' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            Response::send(['error' => $e->getMessage()], 400);
        }
    }
}
