<?php
/** @var Activity $activity_item */

use App\Entity\Activity;

?>

<li>
    <strong><?= $activity_item->getName() ?></strong>
    - <?= $activity_item->value ?> <?= $activity_item->getUnit() ?>

    <br>

    Emission: <?= floor($activity_item->getEmission()) ?> g CO₂

    <br>

    Saved: <?= floor($activity_item->getCarbonSaved()) ?> g CO₂

    <?php if ($activity_item->referenceActivity->hasBaseline()): ?>
        vs <?= $activity_item->referenceActivity->getBaselineName() ?>
    <?php endif; ?>
</li>