<?php

namespace App\Controller;

use App\Middleware\AuthMiddleware;
use App\Service\ActivityService;

class ActivityController {
    private ActivityService $service;

    public function __construct() {
        $this->service = new ActivityService();
    }

    public function index() {
        AuthMiddleware::check();

        $referenceActivities = $this->service->getReferenceActivities();
        $activities = $this->service->getUserActivities($_SESSION['user']->getId());

        require __DIR__ . '/../../views/activities/index.php';
    }

    public function create() {
        AuthMiddleware::check();

        $refs = $this->service->getReferenceActivities();

        require __DIR__ . '/../../views/activities/create.php';
    }

    public function store() {
        AuthMiddleware::check();

        $this->service->create(
            $_SESSION['user']->getId(),
            $_POST['reference_activity_id'],
            $_POST['value']
        );

        header("Location: " . BASE_URL . "/activities");
        exit;
    }

    public function delete() {
        AuthMiddleware::check();

        $this->service->delete($_POST['id']);

        header("Location: " . BASE_URL . "/activities");
        exit;
    }
}