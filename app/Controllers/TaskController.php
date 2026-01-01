<?php
namespace App\Controllers;

use App\Models\Task;

class TaskController
{
    public function index()
    {
        $taskModel = new Task;
        $tasks = $taskModel->getAllTasks();

        return $this->jsonResponse([
            'status' => 'success',
            'count' => count($tasks),
            'data' => $tasks
        ]);
    }

    public function store()
    {
        $inputData = file_get_contents('php://input');

        $data = json_decode($inputData, true);

        if (!isset($data['title']) || empty(trim($data['title']))) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'حقل العنوان (title) مطلوب'
            ], 422);
        }

        $taskModel = new Task;
        $id = $taskModel->create($data['title']);

        if ($id) {
            return $this->jsonResponse([
                'status' => 'success',
                'message' => 'تم إنشاء المهمة بنجاح',
                'data' => [
                    'id' => $id,
                    'title' => $data['title']
                ]
            ], 201);
        }

        return $this->jsonResponse([
            'status' => 'error',
            'message' => 'فشل الحفظ'
        ], 500);
    }

    public function update() {
        $dataInput = file_get_contents('php://input');
        $data = json_decode($dataInput, true);

        if (!isset($data['id'])) {
            return $this->jsonResponse(['message' => 'رقم المهمة (id) مطلوب'], 400);
        }

        $taskModel = new Task();
        $success = $taskModel->update($data['id'], $data['is_completed'] ?? 1);

        if ($success) {
            return $this->jsonResponse(['message' => 'تم تحديث المهمة بنجاح']);
        }

        return $this->jsonResponse(['message' => 'فشل التحديث'], 500);
    }

    public function delete() {
        $id = $_GET['id'] ?? null;

        if(!$id) {
            return $this->jsonResponse(['message' => 'رقم المهمة (id) مطلوب في الرابط'], 400);
        }

        $taskModel = new Task();
        $success = $taskModel->delete($id);

        if($success) {
            return $this->jsonResponse(['message' => 'تم حذف المهمة']);
        }

        return $this->jsonResponse(['message' => 'فشل الحذف'], 500);
    }

    public function jsonResponse(array $data, int $status = 200)
    {
        header('Content-Type: Application/json');

        http_response_code($status);

        echo json_encode($data);
        exit;
    }
}