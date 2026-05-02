<?php

namespace App\Entity;

class Activity {
    private ?int $id = null;
    private int $userId;
    private float $value;
    private string $createdAt;
    private ?ReferenceActivity $referenceActivity;

    public function hasReference(): bool {
        return $this->referenceActivity !== null;
    }

    public function getUnit(): ?string {
        return $this->referenceActivity?->getUnit();
    }

    public function getName(): ?string {
        return $this->referenceActivity?->getName();
    }

    public function getCarbonSaved(): float {
        // If baseline is also the reference, return 0 saved
        if (!$this->referenceActivity->hasBaseline()) {
            return 0;
        }

        return $this->value * (
                $this->referenceActivity->getBaseline()->getEmissionFactor()
                - $this->referenceActivity->getEmissionFactor()
            );
    }

    public function getEmission(): float {
        return $this->value * $this->referenceActivity->getEmissionFactor();
    }

    /* POJO METHODS */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getReferenceActivity(): ?ReferenceActivity {
        return $this->referenceActivity;
    }

    public function setReferenceActivity(?ReferenceActivity $referenceActivity): void {
        $this->referenceActivity = $referenceActivity;
    }

    public function getValue(): float {
        return $this->value;
    }

    public function setValue(float $value): void {
        $this->value = $value;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }
}