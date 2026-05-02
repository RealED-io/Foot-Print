<?php

namespace App\Controller;

use App\Middleware\AuthMiddleware;
use App\Service\ActivityService;

class DashboardController {
    private ActivityService $activityService;

    public function __construct() {
        $this->activityService = new ActivityService();
    }

    public function index() {
        AuthMiddleware::check();

        // activities grouped by day
        $grouped = $this->activityService->getLast7DaysSummary($_SESSION['user']->getId());

        $dailySummaries = [];

        foreach ($grouped as $date => $activities) {

            $totalEmission = 0;
            $totalSaved = 0;

            $processedActivities = [];

            foreach ($activities as $activity) {

                $emission = $activity->getEmission();
                $saved = $activity->getCarbonSaved();

                $totalEmission += $emission;
                $totalSaved += $saved;

                $processedActivities[] = [
                    'activity' => $activity,
                    'emission' => $emission,
                    'saved' => $saved
                ];
            }

            // Used in dashboard view
            $dailySummaries[] = [
                'date' => $date,
                'total_emission' => $totalEmission,
                'total_saved' => $totalSaved,
                'activities' => $processedActivities
            ];
        }

        $referenceActivities = $this->activityService->getReferenceActivities();

        require __DIR__ . '/../../views/dashboard/index.php';
    }
}