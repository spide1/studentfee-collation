<?php

namespace App\Services;


class FeeCalculator
{
    public static function calculate($type, $amount)
    {
        return match ($type) {
            'MONTHLY' => [
                'monthly_fee'   => $amount,
                'quarterly_fee' => null,
                'annual_fee'    => null,
            ],
            'QUARTERLY' => [
                'monthly_fee'   => round($amount / 3, 2),
                'quarterly_fee' => $amount,
                'annual_fee'    => null,
            ],
            'ANNUAL', 'ADVANCE' => [
                'monthly_fee'   => round($amount / 12, 2),
                'quarterly_fee' => round($amount / 4, 2),
                'annual_fee'    => $amount,
            ],
        };
    }
}

