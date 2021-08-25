<?php


namespace App\Tests\AppBundle\Factory;


use App\Entity\Dinosaur;
use App\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;

class DinosaurFactoryTest extends TestCase
{
    /**
     * @var DinosaurFactory
     */
    private $factory;

    public function setUp(): void
    {
        $this->factory = new DinosaurFactory();
    }

    public function testItGrowsALargeVelociraptor()
    {
        $dinosaur = $this->factory->growVelociraptor(5);
        $this->assertInstanceOf(Dinosaur::class, $dinosaur, 'Is not class Dinosaur');
        $this->assertIsString($dinosaur->getGenus(), 'This is not a string');
        $this->assertSame('Velociraptor', $dinosaur->getGenus(), 'Is not Genus Velociraptor');
        $this->assertSame(5, $dinosaur->getLength(), 'Length is wrong');
    }

    public function testItGrowsATriceraptors()
    {
        $this->markTestIncomplete('Waiting for confirmation from GenLab');
    }

    public function testItGrowsABabyVelociraptor()
    {
        if (!class_exists('Nanny')) {
            $this->markTestSkipped('There is nobody to watch the baby!');
        }
        $dinosaur = $this->factory->growVelociraptor(1);
        $this->assertSame(1, $dinosaur->getLength());
    }

    /**
     * @param string $spec
     * @param bool $expectedIsLarge
     * @param bool $expectedIsCarnivorous
     * @dataProvider getSpecificationTests
     */
    public function testItGrowsADinosaurFromSpecification(string $spec, bool $expectedIsLarge, bool $expectedIsCarnivorous)
        {
            $dinosaur = $this->factory->growFromSpecification($spec);

            if ($expectedIsLarge) {
                $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dinosaur->getLength());
            } else {
                $this->assertLessThan(Dinosaur::LARGE, $dinosaur->getLength());
            }
            $this->assertSame($expectedIsCarnivorous, $dinosaur->isCarnivorous(), 'Diets do not match');
        }

    public function getSpecificationTests(): array
    {
        return[
            //specification, is large, is carnivorous
            ['large carnivorous dinosaur', true, true],
            ['give me all the cookies!!!', false, false], #default
            ['large herbivore', true, false]
        ];
    }

    /**
     * @param string $spec
     * @dataProvider getHugeDinosaurSpecTests
     */
    public function testItGrowsAHugeDinosaur(string $spec)
    {
        $dino = $this->factory->growFromSpecification($spec);

        $this->assertGreaterThanOrEqual(Dinosaur::HUGE, $dino->getLength());
    }

    public function getHugeDinosaurSpecTests(): array
    {
        return [
            ['huge dinosaur'],
            ['huge dino'],
            ['huge'],
            ['OMG'],
            ['😱'],
        ];
    }
}