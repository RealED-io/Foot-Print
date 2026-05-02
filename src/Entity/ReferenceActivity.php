<?php

namespace App\Entity;

class ReferenceActivity {
    private ?int $id = null;

    private string $name;

    private string $unit;

    private float $emissionFactor;

    private ?int $baselineId = null;

    private ?ReferenceActivity $baseline = null;

    public function hasBaseline(): bool {
        return $this->baseline !== null;
    }

    public function getBaselineName(): ?string {
        return $this->baseline?->name;
    }
    /* POJO METHODS */
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getUnit(): string {
        return $this->unit;
    }

    public function setUnit(string $unit): void {
        $this->unit = $unit;
    }

    public function getEmissionFactor(): float {
        return $this->emissionFactor;
    }

    public function setEmissionFactor(float $emissionFactor): void {
        $this->emissionFactor = $emissionFactor;
    }

    public function getBaselineId(): ?int {
        return $this->baselineId;
    }

    public function setBaselineId(?int $baselineId): void {
        $this->baselineId = $baselineId;
    }

    public function getBaseline(): ?ReferenceActivity {
        return $this->baseline;
    }

    public function setBaseline(?ReferenceActivity $baseline): void {
        $this->baseline = $baseline;
    }
}