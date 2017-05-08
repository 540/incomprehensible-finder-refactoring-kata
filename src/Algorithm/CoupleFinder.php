<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

final class CoupleFinder
{
    /** @var Person[] */
    private $people;

    /**
     * @param Person[] $people
     */
    public function __construct(array $people)
    {
        $this->people = $people;
    }

    /**
     * @param AgeFindCriteria $criteria
     *
     * @return CoupleAgeDifference
     */
    public function find(AgeFindCriteria $criteria): CoupleAgeDifference
    {
        $coupleAgeDifferences = $this->buildAgeDifferencesByCouple();

        if (empty($coupleAgeDifferences)) {
            return CoupleAgeDifference::unavailable();
        }

        return $criteria->apply($coupleAgeDifferences);
    }

    /**
     * @return CoupleAgeDifference[]
     */
    private function buildAgeDifferencesByCouple(): array
    {
        /** @var CoupleAgeDifference[] $couples */
        $couples = [];

        for ($i = 0; $i < count($this->people); $i ++) {
            for ($j = $i + 1; $j < count($this->people); $j ++) {
                $couples[] = CoupleAgeDifference::forCouple($this->people[$i], $this->people[$j]);
            }
        }

        return $couples;
    }
}
