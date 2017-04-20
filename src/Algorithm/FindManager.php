<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class FindManager
{
    /** @var Thing[] */
    private $_p;

    public function __construct(array $p)
    {
        $this->_p = $p;
    }

    public function find(int $ft): F
    {
        /** @var F[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->_p); $i++) {
            for ($j = $i + 1; $j < count($this->_p); $j++) {
                $r = new F();

                if ($this->_p[$i]->bthdt < $this->_p[$j]->bthdt) {
                    $r->p1 = $this->_p[$i];
                    $r->p2 = $this->_p[$j];
                } else {
                    $r->p1 = $this->_p[$j];
                    $r->p2 = $this->_p[$i];
                }

                $r->d = $r->p2->bthdt->getTimestamp()
                    - $r->p1->bthdt->getTimestamp();

                $tr[] = $r;
            }
        }

        if (count($tr) >= 1) {
            $answer = $tr[0];

            foreach ($tr as $result) {
                switch ($ft) {
                    case FTInterface::ONE:
                        if ($result->d < $answer->d) {
                            $answer = $result;
                        }
                        break;

                    case FTInterface::TWO:
                        if ($result->d > $answer->d) {
                            $answer = $result;
                        }
                        break;
                }
            }
        } else {
            $answer = new F();
        }

        return $answer;
    }
}
