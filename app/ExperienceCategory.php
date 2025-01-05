<?php

namespace App;

enum ExperienceCategory: string
{
    case FULLTIME = 'FULLTIME';
    case PARTTIME = 'PARTTIME';
    case INTERNSHIP = 'INTERNSHIP';
    case APPRENTICESHIP = 'APPRENTICESHIP';
    case FREELANCE = 'FREELANCE';

    public static function labels(self $category): string
    {
        return match ($category) {
            self::FULLTIME => 'FULL-TIME',
            self::PARTTIME => 'PART-TIME',
            self::INTERNSHIP => 'INTERNSHIP',
            self::APPRENTICESHIP => 'APPRENTICESHIP',
            self::FREELANCE => 'FREELANCE',
        };
    }
}
