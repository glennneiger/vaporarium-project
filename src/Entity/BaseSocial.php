<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BaseSocialRepository")
 * @Vich\Uploadable()
 */
class BaseSocial
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BaseConfig", inversedBy="social")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $baseSocial;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="baseSocialImage", fileNameProperty="imageName", size="imageSize" , mimeType="imageType")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $imageSize;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string;
     */
    private $imageType;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(?File $image = null): BaseSocial
{
    $this->imageFile = $image;

    if (null !== $image) {
        // It is required that at least one field changes if you are using doctrine
        // otherwise the event listeners won't be called and the file is lost
        $this->updatedAt = new \DateTimeImmutable();
    }
return $this;
}

public function getImageFile(): ?File
{
    return $this->imageFile;
}

public function setImageName(?string $imageName): BaseSocial
{
    $this->imageName = $imageName;
    return $this;
}

public function getImageName(): ?string
{
    return $this->imageName;
}

public function setImageSize(?int $imageSize): BaseSocial
{
    $this->imageSize = $imageSize;
    return $this;
}

public function getImageSize(): ?int
{
    return $this->imageSize;
}

/**
 * @return string
 */
public function getImageType(): string
{
    return $this->imageType;
}

/**
 * @param string $imageType
 */
public function setImageType(?string $imageType): BaseSocial
{
    $this->imageType = $imageType;
    return $this;
}

/**
 * @return \DateTime
 */
public function getUpdatedAt(): ?\DateTime
{
    return $this->updatedAt;
}

/**
 * @param \DateTime $updatedAt
 */
public function setUpdatedAt(\DateTime $updatedAt): BaseSocial
{
    $this->updatedAt = $updatedAt;
    return $this;
}

public function getBaseSocial(): ?BaseConfig
{
    return $this->baseSocial;
}

public function setBaseSocial(?BaseConfig $baseSocial): self
{
    $this->baseSocial = $baseSocial;

    return $this;
}
}
