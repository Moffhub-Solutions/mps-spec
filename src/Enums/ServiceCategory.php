<?php

declare(strict_types=1);

namespace Moffhub\MpsSpec\Enums;

enum ServiceCategory: string
{
    case Parking = 'parking';
    case Permits = 'permits';
    case SchoolFees = 'school_fees';
    case HospitalBilling = 'hospital_billing';
    case Revenue = 'revenue';
    case Utilities = 'utilities';
    case Transport = 'transport';
    case MarketFees = 'market_fees';
    case HousingLevy = 'housing_levy';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Parking => 'Parking Management',
            self::Permits => 'Business Permits & Licensing',
            self::SchoolFees => 'School & University Fees',
            self::HospitalBilling => 'Hospital & Clinic Billing',
            self::Revenue => 'County Revenue Collection',
            self::Utilities => 'Utility Payments',
            self::Transport => 'Transport & PSV',
            self::MarketFees => 'Market & Trade Fees',
            self::HousingLevy => 'Housing & Property Levies',
            self::Other => 'Other',
        };
    }
}
