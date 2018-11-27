<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BaseConfigRepository")
 * @Vich\Uploadable()
 */
class BaseConfig
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionTwo;

    /**
     * @var BaseEmail[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BaseEmail", mappedBy="baseEmail", cascade={"persist"})
     */
    private $emails;

    /**
     * @var BasePhones[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BasePhones", mappedBy="basePhone", cascade={"persist"})
     */
    private $phones;

    /**
     * @var BaseSocial[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BaseSocial", mappedBy="baseSocial", cascade={"persist"})
     */
    private $social;

    /**
     * @var BasePartners[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BasePartners", mappedBy="basePartner", cascade={"persist"})
     */
    private $partner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $googleMapIframeSrc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fromEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $toEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $names;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fonRGB;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="baseConfigImageFon", fileNameProperty="imageName", size="imageSize" , mimeType="imageType")
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

    /**
     * @var BaseImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BaseImage", mappedBy="baseConfig", cascade={"persist"})
     */
    private $imageBaseSlider;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publish;

    public function __construct()
    {
        $this->imageBaseSlider = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->social = new ArrayCollection();
        $this->partner = new ArrayCollection();
    }


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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionTwo(): ?string
    {
        return $this->descriptionTwo;
    }

    public function setDescriptionTwo(?string $descriptionTwo): self
    {
        $this->descriptionTwo = $descriptionTwo;

        return $this;
    }

    public function getGoogleMapIframeSrc(): ?string
    {
        return $this->googleMapIframeSrc;
    }

    public function setGoogleMapIframeSrc(?string $googleMapIframeSrc): self
    {
        $this->googleMapIframeSrc = $googleMapIframeSrc;

        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(?string $fromEmail): self
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    public function setToEmail(?string $toEmail): self
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    public function getNames(): ?string
    {
        return $this->names;
    }

    public function setNames(?string $names): self
    {
        $this->names = $names;

        return $this;
    }

    public function getFonRGB(): ?string
    {
        return $this->fonRGB;
    }

    public function setFonRGB(?string $fonRGB): self
    {
        $this->fonRGB = $fonRGB;

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
    public function setImageFile(?File $image = null): BaseConfig
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

    public function setImageName(?string $imageName): BaseConfig
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): BaseConfig
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
    public function setImageType(?string $imageType): BaseConfig
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
    public function setUpdatedAt(\DateTime $updatedAt): BaseConfig
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection|BaseImage[]
     */
    public function getImageBaseSlider(): Collection
    {
        return $this->imageBaseSlider;
    }

    public function addImageBaseSlider(BaseImage $imageBaseSlider): self
    {
        if (!$this->imageBaseSlider->contains($imageBaseSlider)) {
            $this->imageBaseSlider[] = $imageBaseSlider;
            $imageBaseSlider->setBaseConfig($this);
        }

        return $this;
    }

    public function removeImageBaseSlider(BaseImage $imageBaseSlider): self
    {
        if ($this->imageBaseSlider->contains($imageBaseSlider)) {
            $this->imageBaseSlider->removeElement($imageBaseSlider);
            // set the owning side to null (unless already changed)
            if ($imageBaseSlider->getBaseConfig() === $this) {
                $imageBaseSlider->setBaseConfig(null);
            }
        }

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(?bool $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * @return Collection|BaseEmail[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(BaseEmail $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setBaseEmail($this);
        }

        return $this;
    }

    public function removeEmail(BaseEmail $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
            // set the owning side to null (unless already changed)
            if ($email->getBaseEmail() === $this) {
                $email->setBaseEmail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BasePhones[]
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(BasePhones $phone): self
    {
        if (!$this->phones->contains($phone)) {
            $this->phones[] = $phone;
            $phone->setBasePhone($this);
        }

        return $this;
    }

    public function removePhone(BasePhones $phone): self
    {
        if ($this->phones->contains($phone)) {
            $this->phones->removeElement($phone);
            // set the owning side to null (unless already changed)
            if ($phone->getBasePhone() === $this) {
                $phone->setBasePhone(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BaseSocial[]
     */
    public function getSocial(): Collection
    {
        return $this->social;
    }

    public function addSocial(BaseSocial $social): self
    {
        if (!$this->social->contains($social)) {
            $this->social[] = $social;
            $social->setBaseSocial($this);
        }

        return $this;
    }

    public function removeSocial(BaseSocial $social): self
    {
        if ($this->social->contains($social)) {
            $this->social->removeElement($social);
            // set the owning side to null (unless already changed)
            if ($social->getBaseSocial() === $this) {
                $social->setBaseSocial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BasePartners[]
     */
    public function getPartner(): Collection
    {
        return $this->partner;
    }

    public function addPartner(BasePartners $partner): self
    {
        if (!$this->partner->contains($partner)) {
            $this->partner[] = $partner;
            $partner->setBasePartner($this);
        }

        return $this;
    }

    public function removePartner(BasePartners $partner): self
    {
        if ($this->partner->contains($partner)) {
            $this->partner->removeElement($partner);
            // set the owning side to null (unless already changed)
            if ($partner->getBasePartner() === $this) {
                $partner->setBasePartner(null);
            }
        }

        return $this;
    }


}
