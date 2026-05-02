<?php

namespace App\Entity;

class Activity {
    public ?int $id = null;
    public int $userId;

    public ?ReferenceActivity $referenceActivity;

    public float $value;
    public string $createdAt;

    public function hasReference(): bool {
        return $this->referenceActivity !== null;
    }

    public function getUnit(): ?string {
        return $this->referenceActivity?->unit;
    }

    public function getName(): ?string {
        return $this->referenceActivity?->name;
    }

    public function getCarbonSaved(): float {
        // If baseline is also the reference, return 0 saved
        if (!$this->referenceActivity->hasBaseline()) {
            return 0;
        }

        return $this->value * (
                $this->referenceActivity->baseline->emissionFactor
                - $this->referenceActivity->emissionFactor
            );
    }

    public function getEmission(): float {
        return $this->value * $this->referenceActivity->emissionFactor;
    }
}