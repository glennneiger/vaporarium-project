<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BaseEmailRepository")
 */
class BaseEmail
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
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BaseConfig", inversedBy="emails")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $baseEmail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBaseEmail(): ?BaseConfig
    {
        return $this->baseEmail;
    }

    public function setBaseEmail(?BaseConfig $baseEmail): self
    {
        $this->baseEmail = $baseEmail;

        return $this;
    }
}
