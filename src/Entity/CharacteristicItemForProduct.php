<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacteristicItemForProductRepository")
 */
class CharacteristicItemForProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="characteristicItemForProduct", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCharacteristic", inversedBy="characteristicItemForProduct", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $productCharacteristic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharacteristicValue", inversedBy="characteristicValueForProduct", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $characteristicValue;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProductCharacteristic(): ?ProductCharacteristic
    {
        return $this->productCharacteristic;
    }

    public function setProductCharacteristic(?ProductCharacteristic $productCharacteristic): self
    {
        $this->productCharacteristic = $productCharacteristic;

        return $this;
    }

    public function getCharacteristicValue(): ?CharacteristicValue
    {
        return $this->characteristicValue;
    }

    public function setCharacteristicValue(?CharacteristicValue $characteristicValue): self
    {
        $this->characteristicValue = $characteristicValue;

        return $this;
    }
    
}
