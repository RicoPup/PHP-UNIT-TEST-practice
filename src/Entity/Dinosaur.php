<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{
    const LARGE = 20;
    const HUGE = 30;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $length = 0;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $genus;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isCarnivorous;

    /**
     * @var Enclosure
     * @ORM\ManyToOne(targetEntity="App\Entity\Enclosure", inversedBy="dinosaurs")
     */
    private $enclosure;

    public function __construct(string $genus = 'Unknown', bool $isCarnivorous = false)
    {
        $this->genus = $genus;
        $this->isCarnivorous = $isCarnivorous;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getSpecification(): string
    {
        return sprintf(
            'The %s %scarnivorous dinosaur is %d meters long',
            $this->genus,
            $this->isCarnivorous ? '' : 'non-',
            $this->length
        );
    }

    /**
     * @return string
     */
    public function getGenus(): string
    {
        return $this->genus;
    }

    /**
     * @param string $genus
     * @return Dinosaur
     */
    public function setGenus(string $genus): Dinosaur
    {
        $this->genus = $genus;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCarnivorous(): bool
    {
        return $this->isCarnivorous;
    }

    /**
     * @param bool $isCarnivorous
     * @return Dinosaur
     */
    public function setIsCarnivorous(bool $isCarnivorous): Dinosaur
    {
        $this->isCarnivorous = $isCarnivorous;
        return $this;
    }


}
