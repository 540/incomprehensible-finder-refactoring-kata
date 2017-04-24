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
            return new CoupleAgeDifference();
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
                $couples[] = $this->buildAgeDifferenceForCouple($this->people[$i], $this->people[$j]);
            }
        }

        return $couples;
    }

    /**
     * @param Person $person1
     * @param Person $person2
     *
     * @return CoupleAgeDifference
     */
    private function buildAgeDifferenceForCouple(Person $person1, Person $person2)
    {
        $couple = new CoupleAgeDifference();

        if ($person1->birthDate < $person2->birthDate) {
            $couple->youngest = $person1;
            $couple->oldest = $person2;
        } else {
            $couple->youngest = $person2;
            $couple->oldest = $person1;
        }

        $couple->differenceInSeconds = $couple->oldest->birthDate->getTimestamp()
            - $couple->youngest->birthDate->getTimestamp();

        return $couple;
    }
}
