<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacteristicItemForCategoryRepository")
 */
class CharacteristicItemForCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="characteristicItemForCategory", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $characteristicItemForCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCharacteristic", inversedBy="characteristicItemForCategory", cascade={"persist"})
     *@ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $CharacteristicProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacteristicItemForCategory(): ?Category
    {
        return $this->characteristicItemForCategory;
    }

    public function setCharacteristicItemForCategory(?Category $characteristicItemForCategory): self
    {
        $this->characteristicItemForCategory = $characteristicItemForCategory;

        return $this;
    }

    public function getCharacteristicProduct(): ?ProductCharacteristic
    {
        return $this->CharacteristicProduct;
    }

    public function setCharacteristicProduct(?ProductCharacteristic $CharacteristicProduct): self
    {
        $this->CharacteristicProduct = $CharacteristicProduct;

        return $this;
    }

}
