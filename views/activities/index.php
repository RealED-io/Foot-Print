<?php

use App\Entity\Activity;

require __DIR__ . '/../layouts/header.php';
?>

    <h2>Your Activities</h2>

    <hr>

    <a href="<?= BASE_URL ?>/dashboard">Back to Dashboard</a>

    <hr>

<?php
include __DIR__ . '/../../views/partials/activity_form.php';
?>

    <ul>
        <?php /** @var Activity[] $activities */
        krsort($activities);
        foreach ($activities as $activity): ?>
            <?php
            $activity_item = $activity;
            require __DIR__ . '/../../views/partials/activity_item.php';
            ?>
        <?php endforeach; ?>
    </ul>

<?php require __DIR__ . '/../layouts/footer.php'; ?>