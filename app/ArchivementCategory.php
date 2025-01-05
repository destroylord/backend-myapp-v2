<?php

namespace App;

enum ArchivementCategory: string
{
    case AWARDS = 'AWARDS';
    case CERTIFICATES = 'CERTIFICATES';

    public static function labels(self $category): string
    {
        return match ($category) {
            self::AWARDS => 'Awards',
            self::CERTIFICATES => 'Certificates',
        };
    }
}
