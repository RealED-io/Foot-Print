<?php

use App\Entity\Activity;

require __DIR__ . '/../layouts/header.php';
?>

    <h2>Your Activities</h2>

    <section class="add-activity">
        <?php
        include __DIR__ . '/../../views/partials/activity_form.php';
        ?>
    </section>

    <ul>
        <?php /** @var Activity[] $activities */
        krsort($activities);
        foreach ($activities as $activity): ?>
            <li>
                <?php
                $activity_item = $activity;
                require __DIR__ . '/../../views/partials/activity_item.php';
                ?>
                <form method="POST" action="<?= BASE_URL ?>/activities/delete">
                    <input type="hidden" name="id" value="<?= $activity->getId() ?>">
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

<?php require __DIR__ . '/../layouts/footer.php'; ?>