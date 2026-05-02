<?php

use App\Entity\ReferenceActivity;

require __DIR__ . '/../../layouts/header.php';
?>

    <section>
        <h2>Reference Activities</h2>

        <!-- ADMIN LOGOUT -->
        <form method="POST" action="<?= BASE_URL ?>/admin/logout" style="display:inline;">
            <button type="submit">Admin Logout</button>
        </form>

    </section>

    <hr>

    <section>
        <a href="<?= BASE_URL ?>/admin/reference-activities/create">Add New</a>
    </section>

    <hr>

    <section>
        <ul>
            <?php /** @var ReferenceActivity[] $referenceActivities */
            foreach ($referenceActivities as $referenceActivity): ?>
                <li>
                    <?= $referenceActivity->getName() ?>
                    (<?= $referenceActivity->getUnit() ?>)
                    | EF: <?= $referenceActivity->getEmissionFactor() ?>
                    <?php if ($referenceActivity->hasBaseline()): ?>
                        | Baseline: <?= $referenceActivity->getBaseline()->getName() ?>
                    <?php endif; ?>


                    <form method="POST" action="<?= BASE_URL ?>/admin/reference-activities/delete"
                          style="display:inline;">
                        <input type="hidden" name="id" value="<?= $referenceActivity->getId() ?>">
                        <button type="submit">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>