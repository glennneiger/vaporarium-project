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
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtImageNameForLaptop;

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
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtImageNameForMobile;

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

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtImageNameForLaptop = new \DateTimeImmutable();
        }

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
     * @return \DateTime
     */
    public function getUpdatedAtImageNameForLaptop(): ?\DateTime
    {
        return $this->updatedAtImageNameForLaptop;
    }

    /**
     * @param \DateTime $updatedAtImageNameForLaptop
     */
    public function setUpdatedAtImageNameForLaptop(\DateTime $updatedAt): Stock
    {
        $this->updatedAtImageNameForLaptop = $updatedAt;

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFileForMobile(?File $image = null): Stock
    {
        $this->imageFileForMobile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtImageNameForMobile = new \DateTimeImmutable();
        }

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

    /**
     * @return \DateTime
     */
    public function getUpdatedAtImageNameForMobile(): ?\DateTime
    {
        return $this->updatedAtImageNameForMobile;
    }

    /**
     * @param \DateTime $updatedAtImageNameForMobile
     */
    public function setUpdatedAtImageNameForMobile(\DateTime $updatedAt): Stock
    {
        $this->updatedAtImageNameForMobile = $updatedAt;

        return $this;
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
