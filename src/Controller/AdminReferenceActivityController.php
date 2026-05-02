<?php

namespace App\Controller;

use App\Middleware\AdminMiddleware;
use App\Service\ReferenceActivityService;

class AdminReferenceActivityController {
    private ReferenceActivityService $service;

    public function __construct() {
        $this->service = new ReferenceActivityService();
    }

    public function index() {
        AdminMiddleware::check();

        $referenceActivities = $this->service->getAll();

        require __DIR__ . '/../../views/admin/reference_activities/index.php';
    }

    public function create() {
        AdminMiddleware::check();

        $referenceActivities = $this->service->getAll();

        require __DIR__ . '/../../views/admin/reference_activities/create.php';
    }

    public function store() {
        AdminMiddleware::check();

        $baselineId = !empty($_POST['baseline_id']) ? (int)$_POST['baseline_id'] : null;

        $this->service->create(
            $_POST['name'] ?? '',
            $_POST['unit'] ?? '',
            (float)($_POST['emission_factor'] ?? 0),
            $baselineId
        );

        header("Location: " . BASE_URL . "/admin/reference-activities");
        exit;
    }

    public function delete() {
        AdminMiddleware::check();

        $this->service->delete((int)$_POST['id']);

        header("Location: " . BASE_URL . "/admin/reference-activities");
        exit;
    }

    public function logout() {
        unset($_SESSION['is_admin']);
        header("Location: " . BASE_URL . "/admin/reference-activities");
        exit;
    }
}