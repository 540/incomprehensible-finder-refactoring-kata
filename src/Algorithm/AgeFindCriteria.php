<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

class AgeFindCriteria
{
    private $orderFunction;

    /**
     * @param $orderFunction
     */
    public function __construct($orderFunction)
    {
        $this->orderFunction = $orderFunction;
    }

    /**
     * @param CoupleAgeDifference[] $couples
     *
     * @return CoupleAgeDifference
     */
    public function apply(array $couples): CoupleAgeDifference
    {
        $orderCouples = array_merge([], $couples);
        usort($orderCouples, $this->orderFunction);

        return $orderCouples[0];
    }

    /**
     * @return AgeFindCriteria
     */
    public static function closest(): AgeFindCriteria
    {
        return new self(
            function ($couple1, $couple2) {
                return $couple1->isDifferenceBiggerThan($couple2);
            }
        );
    }

    /**
     * @return AgeFindCriteria
     */
    public static function furthest(): AgeFindCriteria
    {
        return new self(
            function ($couple1, $couple2) {
                return $couple1->isDifferenceSmallerThan($couple2);
            }
        );
    }
}
