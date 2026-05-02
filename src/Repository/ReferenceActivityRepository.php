<?php

namespace App\Repository;

use App\Config\Database;
use App\Core\ModelMapper;
use App\Entity\ReferenceActivity;
use PDO;

class ReferenceActivityRepository {
    public function findAll(): array {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM reference_activities");

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $activitiesById = [];
        $rawRows = [];

        // First pass, create all entity instances
        foreach ($rows as $row) {
            $activity = ModelMapper::mapReferenceActivity($row);
            $activitiesById[$activity->getId()] = $activity;
            $rawRows[$activity->getId()] = $row;
        }

        // Second pass, link baselines
        foreach ($activitiesById as $id => $activity) {
            $baselineId = $rawRows[$id]['baseline_id'] ?? null;
            if ($baselineId !== null && isset($activitiesById[$baselineId])) {
                $activity->setBaseline($activitiesById[$baselineId]);
            }
        }

        return array_values($activitiesById);
    }

    public function findById(int $id): ?ReferenceActivity {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM reference_activities WHERE id = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        $activity = ModelMapper::mapReferenceActivity($row);

        // Fetch and set the baseline if it exists
        if (!empty($row['baseline_id'])) {
            $baseline = $this->findById((int)$row['baseline_id']);
            if ($baseline) {
                $activity->setBaseline($baseline);
            }
        }

        return $activity;
    }

    public function create(ReferenceActivity $ref): ReferenceActivity {
        $db = Database::connect();

        $stmt = $db->prepare("
            INSERT INTO reference_activities (name, unit, emission_factor, baseline_id)
            VALUES (:name, :unit, :emission_factor, :baseline_id)
        ");

        $stmt->execute([
            'name' => $ref->getName(),
            'unit' => $ref->getUnit(),
            'emission_factor' => $ref->getEmissionFactor(),
            'baseline_id' => $ref->getBaseline()?->getId()
        ]);

        $ref->setId((int)$db->lastInsertId());

        return $ref;
    }

    public function delete(int $id): void {
        $db = Database::connect();

        $check = $db->prepare("SELECT COUNT(*) FROM activities WHERE reference_activity_id = ?");
        $check->execute([$id]);

        if ($check->fetchColumn() > 0) {
            throw new \Exception("Cannot delete: reference activity is in use.");
        }

        $stmt = $db->prepare("DELETE FROM reference_activities WHERE id = ?");
        $stmt->execute([$id]);
    }
}