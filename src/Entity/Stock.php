<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 * @Vich\Uploadable()
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
     * @Vich\UploadableField(mapping="stock", fileNameProperty="imageNameForLaptop")
     *
     * @var File
     */
    private $imageFileForLaptop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageNameForLaptop;

    /**
     * @Vich\UploadableField(mapping="stock", fileNameProperty="imageNameForMobile")
     *
     * @var File
     */
    private $imageFileForMobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageNameForMobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFileForLaptop(?File $image = null): Stock
    {
        $this->imageFileForLaptop = $image;

    return $this;
    }

    public function getImageFileForLaptop(): ?File
    {
        return $this->imageFileForLaptop;
    }

    public function setImageNameForLaptop(?string $imageName): Stock
    {
        $this->imageNameForLaptop = $imageName;
        return $this;
    }

    public function getImageNameForLaptop(): ?string
    {
        return $this->imageNameForLaptop;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFileForMobile(?File $image = null): Stock
    {
        $this->imageFileForMobile = $image;

        return $this;
    }

    public function getImageFileForMobile(): ?File
    {
        return $this->imageFileForMobile;
    }

    public function setImageNameForMobile(?string $imageName): Stock
    {
        $this->imageNameForMobile = $imageName;
        return $this;
    }

    public function getImageNameForMobile(): ?string
    {
        return $this->imageNameForMobile;
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

}
