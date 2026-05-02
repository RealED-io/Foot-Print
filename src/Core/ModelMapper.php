<?php

namespace App\Core;

use App\Entity\Activity;
use App\Entity\ReferenceActivity;
use App\Entity\User;

class ModelMapper {

    // Maps raw array to User Entity
    public static function mapUser(array $data): User {
        $user = new User();

        $user->id = (int)$data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        return $user;
    }

    public static function mapReferenceActivity(array $data): ReferenceActivity {
        $activity = new ReferenceActivity();

        $activity->id = $data['id'];
        $activity->name = $data['name'];
        $activity->unit = $data['unit'];
        $activity->emissionFactor = $data['emission_factor'];
        $activity->baselineId = $data['baseline_id']
            ? (int)$data['baseline_id']
            : null;

        return $activity;
    }

    public static function mapActivity(array $data): Activity {
        $activity = new Activity();

        $activity->id = $data['id'];
        $activity->userId = $data['user_id'];
        $activity->value = $data['value'];
        $activity->createdAt = $data['created_at'];

        return $activity;
    }
}