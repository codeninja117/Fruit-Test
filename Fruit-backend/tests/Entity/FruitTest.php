<?php

namespace App\Tests\Entity;

use App\Entity\FruitFactory;
use PHPUnit\Framework\TestCase;

class FruitTest extends TestCase
{

    public function testFruit()
    {
        $nutrition = NutritionFactory::createNutrition(
            96, // calories
            0.2, // fat
            17.2, // sugar
            22, // carbohydrates
            1, // protein
        );

        $fruit = FruitFactory::createFruit(
            5, // id
            "Banana", // name
            "Zingiberales", // order
            "Musa", // genus
            "Musaceae", // family
        );

        $this->assertEquals("tests fruit name", $fruit->getName());
        $this->assertEquals("tests fruit genus", $fruit->getGenus());
        $this->assertEquals("tests fruit sugar", $nutrition->getSugar());
        $this->assertEquals("tests fruit protein", $nutrition->getProtein());
    }
}
