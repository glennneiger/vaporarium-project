<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 * @Vich\Uploadable()
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var $imageArray[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Test", mappedBy="imageFileOne", cascade={"persist"})
     */
    private $imageArray;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="testImage", fileNameProperty="ImageOne")
     *
     * @var File
     */
    private $imageFileOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageOne;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="testImage", fileNameProperty="ImageTwo")
     *
     * @var File
     */
    private $imageFileTwo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageTwo;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="testImage", fileNameProperty="ImageThree")
     *
     * @var File
     */
    private $imageFileThree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageThree;

    public function __construct()
    {
        $this->imageArray = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFileOne(?File $image = null): Test
    {
        $this->imageFileOne = $image;

    return $this;
    }

    public function getImageFileOne(): ?File
    {
        return $this->imageFileOne;
    }

    public function setImageOne(?string $ImageOne): Test
    {
        $this->imageOne = $ImageOne;
        return $this;
    }

    public function getImageOne(): ?string
    {
        return $this->imageOne;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFileTwo(?File $image = null): Test
    {
        $this->imageFileTwo = $image;

        return $this;
    }

    public function getImageFileTwo(): ?File
    {
        return $this->imageFileTwo;
    }

    public function setImageTwo(?string $ImageTwo): Test
    {
        $this->imageTwo = $ImageTwo;
        return $this;
    }

    public function getImageTwo(): ?string
    {
        return $this->imageTwo;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFileThree(?File $image = null): Test
    {
        $this->imageFileThree = $image;

        return $this;
    }

    public function getImageFileThree(): ?File
    {
        return $this->imageFileThree;
    }

    public function setImageThree(?string $ImageThree): Test
    {
        $this->imageTwo = $ImageThree;
        return $this;
    }

    public function getImageThree(): ?string
    {
        return $this->imageThree;
    }

    /**
     * @return Collection|Test[]
     */
    public function getImageArray(): Collection
    {
        return $this->imageArray;
    }

    public function addImageArray(Test $imageArray): self
    {
        if (!$this->imageArray->contains($imageArray)) {
            $this->imageArray[] = $imageArray;
            $imageArray->setImageFileOne($this);
        }

        return $this;
    }

    public function removeImageArray(Test $imageArray): self
    {
        if ($this->imageArray->contains($imageArray)) {
            $this->imageArray->removeElement($imageArray);
            // set the owning side to null (unless already changed)
            if ($imageArray->getImageFileOne() === $this) {
                $imageArray->setImageFileOne(null);
            }
        }

        return $this;
    }

}
