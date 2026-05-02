<?php
/** @var ReferenceActivity[] $refs */

use App\Entity\ReferenceActivity;

?>

<form method="POST" action="<?= BASE_URL ?>/activities">
    <label for="reference_activity">
        <select id="reference_activity" name="reference_activity_id" required>
            <?php /** @var ReferenceActivity[] $referenceActivities */
            foreach ($referenceActivities as $ref): ?>
                <option value="<?= $ref->id ?>">
                    <?= $ref->name ?> (<?= $ref->unit ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="value">
        <input id="value"
               type="number"
               step="0.01"
               name="value"
               placeholder="Enter value"
               required
        >
    </label>
    <button type="submit">Add Activity</button>
</form>