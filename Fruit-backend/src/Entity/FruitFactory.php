<?php

namespace App\Entity;

class FruitFactory
{
    public static function createFruit(
        int $id,
        string $name, 
        string $family,
        string $fruitOrder,
        string $genus,
    ): Fruit
    {
        $fruit = new Fruit();
        $fruit->setId($id);
        $fruit->setName($name);
        $fruit->setFamily($family);
        $fruit->setGenus($genus);
        $fruit->setFruitOrder($fruitOrder);

        return $fruit;
    }

    public static function createNutrition(
        int $calories,
        float $fat,
        float $sugar,
        float $carbohydrates,
        float $protein
    ): Nutrition
    {
        $nutrition = new Nutrition();
        $nutrition->setCalories($calories);
        $nutrition->setFat($fat);
        $nutrition->setSugar($sugar);
        $nutrition->setCarbohydrates($carbohydrates);
        $nutrition->setProtein($protein);

        return $nutrition;
    }
}