<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTime;

final class Thing
{
    /** @var string */
    public $nameString;

    /** @var DateTime */
    public $birthDate;

    public function getNameString(): string
    {
        return $this->nameString;
    }

    public function setNameString(string $nameString)
    {
        $this->nameString = $nameString;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
}
