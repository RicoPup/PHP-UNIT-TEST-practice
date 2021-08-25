<?php

namespace App\Tests\AppBundle\Entity;

use App\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{
    public function testSettingLength()
    {
        $dino = new Dinosaur ();

        $this->assertSame(0, $dino->getLength());

        $dino->setLength(9);
        $this->assertSame(9, $dino->getLength());
    }

    public function testDinoNotShrunk()
    {
        $dino = new Dinosaur ();
        $dino->setLength(15);

        $this->assertGreaterThan(12, $dino->getLength(), 'Dino is shrinking');
    }

    public function testReturnsFullSpecOfDino()
    {
        $dino = new Dinosaur ();


        $this->assertSame(
            'The Unknown non-carnivorous dinosaur is 0 meters long',
            $dino->getSpecification()
        );
    }

    public function testReturnsFullSpecificationForTyrannosaurus()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);
        $dinosaur->setLength(12);
        $this->assertSame(
            'The Tyrannosaurus carnivorous dinosaur is 12 meters long',
            $dinosaur->getSpecification()
        );
    }

}