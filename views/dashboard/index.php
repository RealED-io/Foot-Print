<?php
require __DIR__ . '/../layouts/header.php';
?>

    <section>
        <h1>Dashboard</h1>
        <p>
            Welcome, <?= $_SESSION['user']->getName() ?>
        </p>
    </section>

    <hr>

    <section class="add-activity">
        <h2>Quick Add Activity</h2>
        <?php require __DIR__ . '/../partials/activity_form.php'; ?>
    </section>

    <hr>

    <section>
        <h2>Last 7 Days Summary</h2>

        <?php /** @var $dailySummaries */
        foreach ($dailySummaries as $day): ?>
            <?php $recommendation = $day['recommendation']; ?>
            <details class="details <?= $recommendation['type'] ?>">
                <summary>
                    <strong><?= $day['date'] ?></strong>
                    |
                    Net Impact: <?= floor($day['net_impact']) ?> g CO₂
                    <br>
                    <strong>Recommendation:</strong> <?= $recommendation['message'] ?>
                </summary>

                <ul>
                    <?php foreach ($day['activities'] as $item): ?>
                        <li>
                            <?php $a = $item['activity'];
                            $activity_item = $a;
                            require __DIR__ . '/../partials/activity_item.php'; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </details>
        <?php endforeach; ?>
    </section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>