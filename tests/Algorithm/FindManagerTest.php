<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\FindManager;
use CodelyTV\FinderKata\Algorithm\FTInterface;
use CodelyTV\FinderKata\Algorithm\Thing;
use PHPUnit\Framework\TestCase;

final class FindManagerTest extends TestCase
{
    /** @var Thing */
    private $sue;

    /** @var Thing */
    private $greg;

    /** @var Thing */
    private $sarah;

    /** @var Thing */
    private $mike;

    protected function setUp()
    {
        $this->sue            = new Thing();
        $this->sue->nameString      = "Sue";
        $this->sue->bthdt = new \DateTime("1950-01-01");

        $this->greg            = new Thing();
        $this->greg->nameString      = "Greg";
        $this->greg->bthdt = new \DateTime("1952-05-01");

        $this->sarah            = new Thing();
        $this->sarah->nameString      = "Sarah";
        $this->sarah->bthdt = new \DateTime("1982-01-01");

        $this->mike            = new Thing();
        $this->mike->nameString      = "Mike";
        $this->mike->bthdt = new \DateTime("1979-01-01");
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $list   = [];
        $manager = new FindManager($list);

        $result = $manager->find(FTInterface::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list   = [];
        $list[] = $this->sue;
        $manager = new FindManager($list);

        $result = $manager->find(FTInterface::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $manager = new FindManager($list);

        $result = $manager->find(FTInterface::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $manager = new FindManager($list);

        $result = $manager->find(FTInterface::TWO);

        $this->assertEquals($this->greg, $result->p1);
        $this->assertEquals($this->mike, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $manager = new FindManager($list);

        $result = $manager->find(FTInterface::TWO);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->sarah, $result->p2);
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $manager = new FindManager($list);

        $result = $manager->find(FTInterface::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }
}
