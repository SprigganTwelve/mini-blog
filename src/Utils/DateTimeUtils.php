<?php

namespace App\Controller\Posts;
use DateTimeImmutable;

class DateTimeUtils
{
    /**
     * Vérifie si $date est dans le futur par rapport à $comparedTo.
     *
     * @param DateTimeImmutable $comparedTo La date de référence (ex: today)
     * @param DateTimeImmutable $date La date à comparer
     * @param bool $sameDayIncluded Si true, la même journée compte comme futur
     *
     * @return bool
     */
    public static function isFuture(DateTimeImmutable $comparedTo, DateTimeImmutable $date, bool $sameDayIncluded = false): bool
    {
        // On normalise $comparedTo et $date pour comparer uniquement les dates si $sameDayIncluded est vrai
        if ($sameDayIncluded) {
            $comparedTo = $comparedTo->setTime(0, 0, 0);
            $date = $date->setTime(0, 0, 0);
        }

        return $date > $comparedTo;
    }
}