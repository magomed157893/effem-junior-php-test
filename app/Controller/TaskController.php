<?php

namespace App\Controller;

use App\Utils\Request;
use App\Utils\Response;

class TaskController
{
    public function create(Request $request)
    {
        Response::send(['message' => 'Task created successfully'], 201);
    }

    public function getAll(Request $request)
    {
        Response::send(['message' => 'All tasks received successfully']);
    }

    public function getByID(Request $request)
    {
        Response::send(['message' => 'The task received successfully']);
    }

    public function update(Request $request)
    {
        Response::send(['message' => 'Task updated successfully']);
    }

    public function delete(Request $request)
    {
        Response::send(['message' => 'Task deleted successfully']);
    }
}
