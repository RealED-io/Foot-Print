<?php

use App\Service\ActivityService;

$activityService = new ActivityService();
$referenceActivities = $activityService->getReferenceActivities();

include __DIR__ . '/../../views/layouts/header.php';
include __DIR__ . '/../../views/partials/activity_form.php';
include __DIR__ . '/../../views/layouts/footer.php';