<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTime;

final class Thing
{
    /** @var string */
    public $nameString;

    /** @var DateTime */
    public $bthdt;

    public function getNameString(): string
    {
        return $this->nameString;
    }

    public function setNameString(string $nameString)
    {
        $this->nameString = $nameString;
    }

    public function fetchBthdt(): DateTime
    {
        return $this->bthdt;
    }

    public function setBthdt(DateTime $bthdt)
    {
        $this->bthdt = $bthdt;
    }
}
