<?php

namespace App\Services;

class PriorityService
{
    public function calculatePriority($title, $description, $category, $hasEvidence)
    {
        $score = 0;

        /*
        =========================================
        CATEGORY CLASSIFICATION
        =========================================
        */

        $highPriorityCategories = [
            'System Access & Security',
            'Workplace Conduct & Harassment',
            'Payroll & Salary',
            'Finance & Billing'
        ];

        $mediumPriorityCategories = [
            'IT & System Issues',
            'Human Resource',
            'Facility & Maintenance',
            'Office Equipment & Environment',
            'Policy & Compliance',
            'Management & Communication',
            'Customer Service',
            'Attendance & Leave',
            'Procurement & Purchasing'
        ];

        $lowPriorityCategories = [
            'Transportation & Parking',
            'Training & Performance',
            'Other'
        ];

        /*
        =========================================
        BASE SCORE FROM CATEGORY
        =========================================
        */

        if (in_array($category, $highPriorityCategories)) {
            $score = 7;
        } elseif (in_array($category, $mediumPriorityCategories)) {
            $score = 4;
        } else {
            $score = 2; // low category base
        }

        /*
        =========================================
        URGENT KEYWORDS BOOST
        =========================================
        */

        $urgentKeywords = [
            'urgent',
            'immediately',
            'asap',
            'security',
            'harassment',
            'cannot work',
            'system down',
            'not functioning',
            'danger',
            'threat'
        ];

        $combinedText = strtolower($title . ' ' . $description);

        foreach ($urgentKeywords as $keyword) {
            if (str_contains($combinedText, strtolower($keyword))) {
                $score += 1;
            }
        }

        /*
        =========================================
        EVIDENCE BOOST
        =========================================
        */

        if ($hasEvidence) {
            $score += 1;
        }

        /*
        =========================================
        FINAL PRIORITY RULE (SAFE THRESHOLD)
        =========================================
        */

        if ($score >= 7) {
            return 'High';
        }

        if ($score >= 4) {
            return 'Medium';
        }

        return 'Low';
    }
}