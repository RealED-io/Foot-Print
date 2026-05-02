<?php

namespace App\Service;

class RecommendationService {

    public function generate(array $data): array {
        $netImpact = $data['net_impact'] ?? 0;
        $count = $data['count'] ?? 0;

        // CASE 1: no activity
        if ($count === 0) {
            return [
                'type' => 'neutral',
                'message' => "You haven't logged any activities. Start tracking to understand your carbon footprint."
            ];
        }

        // CASE 2: very bad (high positive net impact)
        if ($netImpact > 2000) {
            return [
                'type' => 'warning',
                'message' => "Your net carbon impact is high. Try replacing high-emission activities with greener alternatives."
            ];
        }

        // CASE 3: slightly bad
        if ($netImpact > 1000) {
            return [
                'type' => 'warning',
                'message' => "You're emitting more than you're saving. Small changes can reduce your impact."
            ];
        }

        // CASE 4: good (negative net impact)
        if ($netImpact < 0) {
            return [
                'type' => 'good',
                'message' => "Excellent! You're saving more carbon than you emit. Keep it up!"
            ];
        }

        // CASE 5: balanced
        return [
            'type' => 'neutral',
            'message' => "Your carbon impact is balanced. Try pushing it further into the positive (saving more than emitting)."
        ];
    }
}