<?php
use App\Entity\Activity;

require __DIR__ . '/../../layouts/header.php';
?>

    <h2>Add Reference Activity</h2>

    <form method="POST" action="<?= BASE_URL ?>/admin/reference-activities">

        <label>
            Name:
            <input type="text" name="name" required>
        </label>

        <label>
            Unit:
            <input type="text" name="unit" placeholder="km / minutes" required>
        </label>

        <label>
            Emission Factor:
            <input type="number" step="0.0001" name="emission_factor" required>
        </label>

        <label>
            Baseline Activity (optional):
            <select name="baseline_id">
                <option value="">Select a baseline</option>
                <?php /** @var Activity[] $referenceActivities */
                foreach ($referenceActivities as $activity): ?>
                    <option value="<?= $activity->getId() ?>"><?= $activity->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit">Save</button>

    </form>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>