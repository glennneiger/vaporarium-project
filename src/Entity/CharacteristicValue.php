<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacteristicValueRepository")
 */
class CharacteristicValue
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
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valueForAdmin;

    /**
     * @var ProductCharacteristic
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCharacteristic", inversedBy="characteristicValue", cascade={"persist"})
     * @ORM\JoinColumn(name="characteristic_value_id", onDelete="CASCADE")
     */
    private $characteristic;

    /**
     * @var CharacteristicItemForProduct[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CharacteristicItemForProduct", mappedBy="characteristicValue", cascade={"persist"})
     */
    private $characteristicValueForProduct;

    public function __construct()
    {
        $this->characteristicValueForProduct = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }


    public function getCharacteristic(): ?ProductCharacteristic
    {
        return $this->characteristic;
    }

    public function setCharacteristic(?ProductCharacteristic $characteristic): self
    {
        $this->characteristic = $characteristic;
        $this->setValueForAdmin("");

        return $this;
    }

    /**
     * @return Collection|CharacteristicItemForProduct[]
     */
    public function getCharacteristicValueForProduct(): Collection
    {
        return $this->characteristicValueForProduct;
    }

    public function addCharacteristicValueForProduct(CharacteristicItemForProduct $characteristicValueForProduct): self
    {
        if (!$this->characteristicValueForProduct->contains($characteristicValueForProduct)) {
            $this->characteristicValueForProduct[] = $characteristicValueForProduct;
            $characteristicValueForProduct->setCharacteristicValue($this);
        }

        return $this;
    }

    public function removeCharacteristicValueForProduct(CharacteristicItemForProduct $characteristicValueForProduct): self
    {
        if ($this->characteristicValueForProduct->contains($characteristicValueForProduct)) {
            $this->characteristicValueForProduct->removeElement($characteristicValueForProduct);
            // set the owning side to null (unless already changed)
            if ($characteristicValueForProduct->getCharacteristicValue() === $this) {
                $characteristicValueForProduct->setCharacteristicValue(null);
            }
        }

        return $this;
    }

    public function getValueForAdmin(): ?string
    {
        return $this->valueForAdmin;
    }

    public function setValueForAdmin(string $val): self
    {
        if ($val !== ""){
            $this->valueForAdmin = $val."(".$this->getCharacteristic().")";
        } else {
            $this->valueForAdmin = $this->getValue()."(".$this->getCharacteristic().")";
        }
        return $this;
    }
}
