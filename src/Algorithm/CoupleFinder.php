<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class CoupleFinder
{
    /** @var Person[] */
    private $people;

        public function __construct(array $people)
    {
        $this->people = $people;
    }

    public function find(int $criteria): CoupleAgeDifference
    {
        /** @var CoupleAgeDifference[] $couples */
        $couples = [];

        for ($i = 0; $i < count($this->people); $i++) {
            for ($j = $i + 1; $j < count($this->people); $j++) {
                $couple = new CoupleAgeDifference();

                if ($this->people[$i]->birthDate < $this->people[$j]->birthDate) {
                    $couple->youngest = $this->people[$i];
                    $couple->oldest = $this->people[$j];
                } else {
                    $couple->youngest = $this->people[$j];
                    $couple->oldest = $this->people[$i];
                }

                $couple->difference = $couple->oldest->birthDate->getTimestamp()
                    - $couple->youngest->birthDate->getTimestamp();

                $couples[] = $couple;
            }
        }

        if (count($couples) >= 1) {
            $bestCouple = $couples[0];

            foreach ($couples as $aCouple) {
                switch ($criteria) {
                    case AgeFindCriteria::CLOSEST:
                        if ($aCouple->difference < $bestCouple->difference) {
                            $bestCouple = $aCouple;
                        }
                        break;

                    case AgeFindCriteria::FURTHEST:
                        if ($aCouple->difference > $bestCouple->difference) {
                            $bestCouple = $aCouple;
                        }
                        break;
                }
            }
        } else {
            $bestCouple = new CoupleAgeDifference();
        }

        return $bestCouple;
    }
}
