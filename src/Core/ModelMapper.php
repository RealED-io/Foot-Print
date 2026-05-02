<?php

namespace App\Core;

use App\Entity\Activity;
use App\Entity\ReferenceActivity;
use App\Entity\User;

class ModelMapper {

    // Maps raw array to User Entity
    public static function mapUser(array $data): User {
        $user = new User();

        $user->setId((int)$data['id']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']); 

        return $user;
    }

    public static function mapReferenceActivity(array $data): ReferenceActivity {
        $activity = new ReferenceActivity();

        $activity->setId((int)$data['id']);
        $activity->setName($data['name']);
        $activity->setUnit($data['unit']);
        $activity->setEmissionFactor((float)$data['emission_factor']);
        $activity->setBaselineId($data['baseline_id']
            ? (int)$data['baseline_id']
            : null);

        return $activity;
    }

    public static function mapActivity(array $data): Activity {
        $activity = new Activity();

        $activity->setId($data['id']);
        $activity->setUserId($data['user_id']);
        $activity->setValue($data['value']);
        $activity->setCreatedAt($data['created_at']);

        return $activity;
    }
}