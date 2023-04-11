<?php

namespace App\Entity;

use App\Repository\Repository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[Id]
    #[Column]
    private int $id;

    #[Column(type: "string", length: 255)]
    private string $name;

    #[Column(type: "string", length: 255)]
    private string $fruitOrder;

    #[Column(type: "string", length: 255)]
    private string $family;

    #[Column(type: "string", length: 255)]
    private string $genus;

    #[OneToOne(targetEntity: Nutrition::class)]
    private Nutrition $nutrition;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * @param string $family
     */
    public function setFamily(string $family): self
    {
        $this->family = $family;
        return $this;
    }

    /**
     * @return string
     */
    public function getFruitOrder(): string
    {
        return $this->fruitOrder;
    }

    /**
     * @param string $fruitOrder
     */
    public function setFruitOrder(string $fruitOrder): self
    {
        $this->fruitOrder = $fruitOrder;
        return $this;
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
     */
    public function setGenus(string $genus): self
    {
        $this->genus = $genus;
        return $this;
    }

    public function getNutrition(): Nutrition
    {
        return $this->nutrition;
    }


    public function setNutrition(Nutrition $nutrition): self
    {
        $this->nutrition = $nutrition;
        return $this;
    }

}
