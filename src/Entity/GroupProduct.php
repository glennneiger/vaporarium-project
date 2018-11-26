<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupProductRepository")
 */
class GroupProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publishInCategory;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publishIsTop;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publishInStock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishInCategory(): ?bool
    {
        return $this->publishInCategory;
    }

    public function setPublishInCategory(?bool $publishInCategory): self
    {
        $this->publishInCategory = $publishInCategory;

        return $this;
    }

    public function getPublishIsTop(): ?bool
    {
        return $this->publishIsTop;
    }

    public function setPublishIsTop(?bool $publishIsTop): self
    {
        $this->publishIsTop = $publishIsTop;

        return $this;
    }

    public function getPublishInStock(): ?bool
    {
        return $this->publishInStock;
    }

    public function setPublishInStock(?bool $publishInStock): self
    {
        $this->publishInStock = $publishInStock;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }
}
