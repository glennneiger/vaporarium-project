<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Mobile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobile(): ?bool
    {
        return $this->Mobile;
    }

    public function setMobile(?bool $Mobile): self
    {
        $this->Mobile = $Mobile;

        return $this;
    }
}
