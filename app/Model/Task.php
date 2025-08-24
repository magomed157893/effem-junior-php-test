<?php

namespace App\Model;

use App\Utils\Database;
use App\Utils\Response;
use App\Utils\Validator;

class Task
{
    private \PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function create(array $data)
    {
        $title = $data['title'] ?? null;
        $description = $data['description'] ?? null;
        $status = $data['status'] ?? false;

        Validator::check(Validator::canBeString($title), 'Title is must be string');
        Validator::check(Validator::notBlank($title), 'Title is cannot be blank');
        Validator::check(Validator::maxChars($title, 100), 'Title is cannot be longer than 100 characters');
        Validator::check(Validator::canBeString($description), 'Description is must be string');
        Validator::check(Validator::trueOrFalse($status), 'Status is must be equal true or false');

        $query = 'INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)';

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':status' => $status ? 1 : 0
        ]);

        return (int)$this->conn->lastInsertId();
    }

    public function getAll()
    {
        $query = 'SELECT id, title, description, status FROM tasks';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getByID(int $id)
    {
        $query = 'SELECT id, title, description, status FROM tasks WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $task = $stmt->fetch();

        Validator::check(!!$task, 'Task not found with ID: ' . $id);

        return $task;
    }

    public function update(int $id, array $data)
    {
        $fields = ['title', 'description', 'status'];

        $updatedFields = [];
        $bindValues = [':id' => $id];

        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $value = $data[$field];

                switch ($field) {
                    case $fields[0]:
                        Validator::check(Validator::notBlank($value), 'Title is cannot be blank');
                        Validator::check(Validator::maxChars($value, 100), 'Title is cannot be longer than 100 characters');
                        break;
                    case $fields[1]:
                        Validator::check(Validator::canBeString($value), 'Description is must be string');
                        break;
                    case $fields[2]:
                        Validator::check(Validator::trueOrFalse($value), 'Status is must be equal true or false');
                        break;
                }

                $updatedFields[] = "$field = :$field";
                $bindValues[":$field"] = $value;
            }
        }

        Validator::check(!empty($updatedFields), 'No valid fields to update');

        $query = 'UPDATE tasks SET ' . implode(', ', $updatedFields) . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->execute($bindValues);

        Validator::check($stmt->rowCount() !== 0, 'Failed to update task with ID: ' . $id);
    }

    public function delete(int $id)
    {
        $query = 'DELETE FROM tasks WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        Validator::check($stmt->rowCount() !== 0, 'Failed to delete task with ID: ' . $id);
    }
}
