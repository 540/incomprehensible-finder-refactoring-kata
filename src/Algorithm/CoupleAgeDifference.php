<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

final class CoupleAgeDifference
{
    /** @var Person */
    private $youngest;

    /** @var Person */
    private $oldest;

    /** @var int */
    private $differenceInSeconds;

    /**
     * @param Person $youngest
     * @param Person $oldest
     */
    private function __construct(Person $youngest = null, Person $oldest = null)
    {
        $this->youngest = $youngest;
        $this->oldest = $oldest;

        if (!is_null($youngest) && !is_null($oldest)) {
            $this->differenceInSeconds = $oldest->differenceInSeconds($youngest);
        }
    }

    /**
     * @return Person
     */
    public function youngest(): Person
    {
        return $this->youngest;
    }

    /**
     * @return Person
     */
    public function oldest(): Person
    {
        return $this->oldest;
    }

    /**
     * @param CoupleAgeDifference $couple
     *
     * @return bool
     */
    public function isDifferenceBiggerThan(CoupleAgeDifference $couple): bool
    {
        return $this->differenceInSeconds > $couple->differenceInSeconds;
    }

    /**
     * @param CoupleAgeDifference $couple
     *
     * @return bool
     */
    public function isDifferenceSmallerThan(CoupleAgeDifference $couple): bool
    {
        return $this->differenceInSeconds < $couple->differenceInSeconds;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return !is_null($this->youngest) && !is_null($this->oldest());
    }

    /**
     * @param Person $person1
     * @param Person $person2
     *
     * @return self
     */
    public static function forCouple(Person $person1, Person $person2): self
    {
        if ($person1->isOlderThan($person2)) {
            return new CoupleAgeDifference($person2, $person1);
        }

        return new CoupleAgeDifference($person1, $person2);
    }

    /**
     * @return self
     */
    public static function unavailable(): self
    {
        return new self();
    }
}
