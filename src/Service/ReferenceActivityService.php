<?php

namespace App\Service;

use App\Entity\ReferenceActivity;
use App\Repository\ReferenceActivityRepository;

class ReferenceActivityService {
    private ReferenceActivityRepository $repo;

    public function __construct() {
        $this->repo = new ReferenceActivityRepository();
    }

    public function create(string $name, string $unit, float $ef, ?int $baselineId): ReferenceActivity {
        $ref = new ReferenceActivity();
        $ref->setName($name);
        $ref->setUnit($unit);
        $ref->setEmissionFactor($ef);

        if ($baselineId) {
            $baseline = $this->repo->findById($baselineId);
            $ref->setBaseline($baseline);
        }

        return $this->repo->create($ref);
    }

    public function getAll(): array {
        return $this->repo->findAll();
    }

    public function delete(int $id): void {
        $this->repo->delete($id);
    }
}
