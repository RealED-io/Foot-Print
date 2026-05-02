<?php
/** @var Activity $activity_item */

use App\Entity\Activity;

?>

<strong><?= $activity_item->getName() ?></strong>
- <?= $activity_item->getValue() ?> <?= $activity_item->getUnit() ?>

<br>

Emission: <?= floor($activity_item->getEmission()) ?> g CO₂

<br>

Saved: <?= floor($activity_item->getCarbonSaved()) ?> g CO₂

<?php if ($activity_item->getReferenceActivity()->hasBaseline()): ?>
    vs <?= $activity_item->getReferenceActivity()->getBaselineName() ?>
<?php endif; ?>