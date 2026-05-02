<?php

namespace App\Repository;

use App\Config\Database;
use App\Core\ModelMapper;
use App\Entity\Activity;
use PDO;

class ActivityRepository {

    public function save(Activity $activity): Activity {
        $db = Database::connect();

        $stmt = $db->prepare("
            INSERT INTO activities (user_id, reference_activity_id, value)
            VALUES (:user_id, :ref_id, :value)
        ");

        // Reference activity existence will be enforced by DB
        $stmt->execute([
            'user_id' => $activity->getUserId(),
            'ref_id' => $activity->getReferenceActivity()->getId(),
            'value' => $activity->getValue()
        ]);

        $activity->setId((int)$db->lastInsertId());

        return $activity;
    }

    public function findByUser(int $userId): array {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT 
                a.id as activity_id,
                a.user_id,
                a.value,
                a.created_at,
            
                r.id as ref_id,
                r.name as ref_name,
                r.unit,
                r.emission_factor,
                r.baseline_id,
            
                b.id as base_id,
                b.name as base_name,
                b.unit as base_unit,
                b.emission_factor as base_emission_factor
            
            FROM activities a
            JOIN reference_activities r
                ON a.reference_activity_id = r.id
            LEFT JOIN reference_activities b
                ON r.baseline_id = b.id
            
            WHERE a.user_id = :user_id
        ");

        $stmt->execute(['user_id' => $userId]);

        $activities = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $activity = ModelMapper::mapActivity([
                'id' => $row['activity_id'],
                'user_id' => $row['user_id'],
                'value' => $row['value'],
                'created_at' => $row['created_at']
            ]);

            $ref = ModelMapper::mapReferenceActivity([
                'id' => $row['ref_id'],
                'name' => $row['ref_name'],
                'unit' => $row['unit'],
                'emission_factor' => $row['emission_factor'],
                'baseline_id' => $row['baseline_id']
            ]);

            if ($row['base_id']) {
                $baseline = ModelMapper::mapReferenceActivity([
                    'id' => $row['base_id'],
                    'name' => $row['base_name'],
                    'unit' => $row['base_unit'],
                    'emission_factor' => $row['base_emission_factor'],
                    'baseline_id' => null
                ]);

                $ref->setBaseline($baseline);
            }

            $activity->setReferenceActivity($ref);

            $activities[] = $activity;
        }

        return $activities;
    }

    public function delete(int $id): void {
        $db = Database::connect();

        $stmt = $db->prepare("DELETE FROM activities WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function getLast7DaysSummary(int $userId): array {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT 
                DATE(a.created_at) as activity_date,
    
                a.id as activity_id,
                a.value,
                a.created_at,
    
                r.id as ref_id,
                r.name as ref_name,
                r.unit,
                r.emission_factor,
                r.baseline_id,
    
                b.id as base_id,
                b.name as base_name,
                b.emission_factor as base_emission_factor
    
            FROM activities a
            JOIN reference_activities r ON a.reference_activity_id = r.id
            LEFT JOIN reference_activities b ON r.baseline_id = b.id
    
            WHERE a.user_id = :user_id
            AND a.created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    
            ORDER BY a.created_at DESC
        ");

        $stmt->execute(['user_id' => $userId]);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $date = $row['activity_date'];

            $activity = ModelMapper::mapActivity([
                'id' => $row['activity_id'],
                'user_id' => $userId,
                'value' => $row['value'],
                'created_at' => $row['created_at']
            ]);

            $ref = ModelMapper::mapReferenceActivity([
                'id' => $row['ref_id'],
                'name' => $row['ref_name'],
                'unit' => $row['unit'],
                'emission_factor' => $row['emission_factor'],
                'baseline_id' => $row['baseline_id']
            ]);

            if ($row['base_id']) {
                $baseline = ModelMapper::mapReferenceActivity([
                    'id' => $row['base_id'],
                    'name' => $row['base_name'],
                    'unit' => $row['unit'],
                    'emission_factor' => $row['base_emission_factor'],
                    'baseline_id' => null
                ]);

                $ref->setBaseline($baseline);
            }

            $activity->setReferenceActivity($ref);

            $data[$date][] = $activity;
        }

        return $data;
    }
}