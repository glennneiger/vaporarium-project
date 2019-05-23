<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductCharacteristicRepository")
 */
class ProductCharacteristic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $searchName;

    /**
     * @var CharacteristicValue[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CharacteristicValue", mappedBy="characteristic", cascade={"persist"})
     */
    private $characteristicValue;

    /**
     * $var CharacteristicItemForCategory[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CharacteristicItemForCategory", mappedBy="CharacteristicProduct")
     */
    private $characteristicItemForCategory;

    /**
     * $var CharacteristicItemForProduct[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CharacteristicItemForProduct", mappedBy="productCharacteristic")
     */
    private $characteristicItemForProduct;

    public function __construct()
    {
        $this->name = "";
        $this->characteristicValue = new ArrayCollection();
        $this->characteristicItemForCategory = new ArrayCollection();
        $this->characteristicItemForProduct = new ArrayCollection();
    }

    public function __toString()
    {
       return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSearchName(): ?string
    {
        return $this->searchName;
    }

    public function setSearchName(?string $searchName): self
    {
        $this->searchName = $searchName;

        return $this;
    }

    /**
     * @return Collection|CharacteristicValue[]
     */
    public function getCharacteristicValue(): Collection
    {
        return $this->characteristicValue;
    }

    public function addCharacteristicValue(CharacteristicValue $characteristicValue): self
    {
        if (!$this->characteristicValue->contains($characteristicValue)) {
            $this->characteristicValue[] = $characteristicValue;
            $characteristicValue->setCharacteristic($this);
        }

        return $this;
    }

    public function removeCharacteristicValue(CharacteristicValue $characteristicValue): self
    {
        if ($this->characteristicValue->contains($characteristicValue)) {
            $this->characteristicValue->removeElement($characteristicValue);
            // set the owning side to null (unless already changed)
            if ($characteristicValue->getCharacteristic() === $this) {
                $characteristicValue->setCharacteristic(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CharacteristicItemForCategory[]
     */
    public function getCharacteristicItemForCategory(): Collection
    {
        return $this->characteristicItemForCategory;
    }

    public function addCharacteristicItemForCategory(CharacteristicItemForCategory $characteristicItemForCategory): self
    {
        if (!$this->characteristicItemForCategory->contains($characteristicItemForCategory)) {
            $this->characteristicItemForCategory[] = $characteristicItemForCategory;
            $characteristicItemForCategory->setCharacteristicProduct($this);
        }

        return $this;
    }

    public function removeCharacteristicItemForCategory(CharacteristicItemForCategory $characteristicItemForCategory): self
    {
        if ($this->characteristicItemForCategory->contains($characteristicItemForCategory)) {
            $this->characteristicItemForCategory->removeElement($characteristicItemForCategory);
            // set the owning side to null (unless already changed)
            if ($characteristicItemForCategory->getCharacteristicProduct() === $this) {
                $characteristicItemForCategory->setCharacteristicProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CharacteristicItemForProduct[]
     */
    public function getCharacteristicItemForProduct(): Collection
    {
        return $this->characteristicItemForProduct;
    }

    public function addCharacteristicItemForProduct(CharacteristicItemForProduct $characteristicItemForProduct): self
    {
        if (!$this->characteristicItemForProduct->contains($characteristicItemForProduct)) {
            $this->characteristicItemForProduct[] = $characteristicItemForProduct;
            $characteristicItemForProduct->setProductCharacteristic($this);
        }

        return $this;
    }

    public function removeCharacteristicItemForProduct(CharacteristicItemForProduct $characteristicItemForProduct): self
    {
        if ($this->characteristicItemForProduct->contains($characteristicItemForProduct)) {
            $this->characteristicItemForProduct->removeElement($characteristicItemForProduct);
            // set the owning side to null (unless already changed)
            if ($characteristicItemForProduct->getProductCharacteristic() === $this) {
                $characteristicItemForProduct->setProductCharacteristic(null);
            }
        }

        return $this;
    }

}
