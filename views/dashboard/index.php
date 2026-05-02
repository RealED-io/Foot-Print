<?php
require __DIR__ . '/../layouts/header.php';
?>

    <h1>Dashboard</h1>

    <p>
        Welcome, <?= $_SESSION['user']->name ?>
    </p>

    <hr>

    <a href="<?= BASE_URL ?>/activities">
        Activities
    </a>

    <hr>

    <h2>Quick Add Activity</h2>

<?php require __DIR__ . '/../partials/activity_form.php'; ?>

    <hr>

    <h2>Last 7 Days Summary</h2>

<?php /** @var $dailySummaries */
foreach ($dailySummaries as $day): ?>

    <details style="margin-bottom: 10px;">
        <summary>
            <strong><?= $day['date'] ?></strong>
            |
            Total Emission: <?= floor($day['total_emission']) ?> g CO₂
            |
            Saved: <?= floor($day['total_saved']) ?> g CO₂ compared to
        </summary>

        <ul>
            <?php foreach ($day['activities'] as $item): ?>
                <?php $a = $item['activity'];
                $activity_item = $a;
                require __DIR__ . '/../partials/activity_item.php'; ?>
            <?php endforeach; ?>
        </ul>
    </details>
<?php endforeach; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>