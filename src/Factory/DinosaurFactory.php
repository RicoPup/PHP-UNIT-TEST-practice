<?php


namespace App\Factory;


use App\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptor($length): Dinosaur
    {
        return $this->createDinosaur('Velociraptor', true, 5);
    }

    public function growFromSpecification(string $specification): Dinosaur
    {
        //defaults
        $codename = 'InG-' . random_int(1, 99999);
        $length = $this->getLengthFromSpecification($specification);
        $isCarnivorous = false;

        if (stripos($specification, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }

        return $this->createDinosaur($codename, $isCarnivorous, $length);
    }

    public function isCarnivorous(): bool
    {
        return $this->isCarnivorous();
    }

    private function createDinosaur(string $genus,bool $isCarniv, int $length): Dinosaur
    {
        $dino = new Dinosaur($genus, $isCarniv);

        $dino->setLength($length);

        return $dino;
    }

    private function getLengthFromSpecification(string $specification): int
    {
        $availableLengths = [
            'huge' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'omg' => ['min' => Dinosaur::HUGE, 'max' => 100],
            '😱' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'large' => ['min' => Dinosaur::LARGE, 'max' => Dinosaur::HUGE - 1],
        ];
        $minLength = 1;
        $maxLength = Dinosaur::LARGE - 1;
        foreach (explode(' ', $specification) as $keyword) {
            $keyword = strtolower($keyword);
            if (array_key_exists($keyword, $availableLengths)) {
                $minLength = $availableLengths[$keyword]['min'];
                $maxLength = $availableLengths[$keyword]['max'];
                break;
            }
        }
        return random_int($minLength, $maxLength);
    }

}