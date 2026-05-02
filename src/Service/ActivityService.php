<?php

namespace App\Service;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use App\Repository\ReferenceActivityRepository;

class ActivityService {
    private ActivityRepository $repo;
    private ReferenceActivityRepository $refRepo;

    public function __construct() {
        $this->repo = new ActivityRepository();
        $this->refRepo = new ReferenceActivityRepository();
    }

    public function create(int $userId, int $refId, float $value): Activity {
        $activity = new Activity();
        $activity->setUserId($userId);
        $activity->setReferenceActivity($this->refRepo->findById($refId));
        $activity->setValue($value);

        return $this->repo->save($activity);
    }

    public function getUserActivities(int $userId): array {
        return $this->repo->findByUser($userId);
    }

    public function delete(int $activityId): void {
        $this->repo->delete($activityId);
    }

    public function getLast7DaysSummary(int $userId): array {
        return $this->repo->getLast7DaysSummary($userId);
    }

    public function getReferenceActivities(): array {
        return $this->refRepo->findAll();
    }
}