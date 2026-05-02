<?php

namespace App\Entity;

class ReferenceActivity {
    public ?int $id = null;

    public string $name;

    public string $unit;

    public float $emissionFactor;

    public ?int $baselineId = null;

    public ?ReferenceActivity $baseline = null;

    public function hasBaseline(): bool {
        return $this->baseline !== null;
    }

    public function getBaselineName(): ?string {
        return $this->baseline?->name;
    }
}