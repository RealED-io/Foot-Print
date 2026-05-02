<?php

use App\Service\ActivityService;

$activityService = new ActivityService();
$referenceActivities = $activityService->getReferenceActivities();

include __DIR__ . '/../../views/layouts/header.php';
?>
    <section class="add-activity">
        <?php
        include __DIR__ . '/../../views/partials/activity_form.php';
        ?>
    </section>
<?php
include __DIR__ . '/../../views/layouts/footer.php';
?>