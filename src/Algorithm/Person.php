<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTime;

final class Person
{
    /** @var string */
    private $name;

    /** @var DateTime */
    private $birthDate;

    /**
     * @param string   $name
     * @param DateTime $birthDate
     */
    public function __construct(string $name, DateTime $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    /**
     * @param Person $person
     *
     * @return int
     */
    public function differenceInSeconds(Person $person): int
    {
        return $this->birthDate->getTimestamp() - $person->birthDate->getTimestamp();
    }

    /**
     * @param Person $person
     *
     * @return bool
     */
    public function isOlderThan(Person $person): bool
    {
        return $this->birthDate > $person->birthDate;
    }
}
