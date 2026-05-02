<?php

namespace App\Controller;

use App\Middleware\AuthMiddleware;
use App\Service\ActivityService;
use App\Service\RecommendationService;

class DashboardController {
    private ActivityService $activityService;
    private RecommendationService $recommendationService;

    public function __construct() {
        $this->activityService = new ActivityService();
        $this->recommendationService = new RecommendationService();
    }

    public function index() {
        AuthMiddleware::check();

        // activities grouped by day
        $grouped = $this->activityService->getLast7DaysSummary($_SESSION['user']->getId());

        $dailySummaries = [];

        foreach ($grouped as $date => $activities) {

            $totalEmission = 0;
            $totalSaved = 0;
            $count = 0;
            $netImpact = 0;
            $processedActivities = [];

            foreach ($activities as $activity) {
                $count++;
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
            $netImpact = $totalEmission - $totalSaved;
            $recommendation = $this->recommendationService->generate([
                'net_impact' => $netImpact,
                'count' => $count
            ]);

            // Used in dashboard view
            $dailySummaries[] = [
                'date' => $date,
                'total_emission' => $totalEmission,
                'total_saved' => $totalSaved,
                'net_impact' => $totalEmission - $totalSaved,
                'activities' => $processedActivities,
                'recommendation' => $recommendation
            ];
        }

        $referenceActivities = $this->activityService->getReferenceActivities();

        require __DIR__ . '/../../views/dashboard/index.php';
    }
}