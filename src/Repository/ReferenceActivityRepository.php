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

        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = ModelMapper::mapReferenceActivity($row);
        }

        return $results;
    }

    public function findById(int $id): ?ReferenceActivity {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM reference_activities WHERE id = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return ModelMapper::mapReferenceActivity($row);
    }
}