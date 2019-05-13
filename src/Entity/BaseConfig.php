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
     * @ORM\Column(type="text", nullable=true)
     */
    private $googleMapIframeSrc;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

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
     * @var BaseImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\BaseImage", mappedBy="baseConfig", cascade={"persist"})
     */
    private $imageBaseSlider;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publish;

    /**
     * @Vich\UploadableField(mapping="baseConfigImageFon", fileNameProperty="imageNameFon")
     *
     * @var File
     */
    private $imageFileFon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageNameFon;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtFon;

    /**
     * @Vich\UploadableField(mapping="baseConfigImageLogo", fileNameProperty="imageNameLogo")
     *
     * @var File
     */
    private $imageFileLogo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageNameLogo;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtLogo;

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

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFon
     */
    public function setImageFileFon(?File $imageFon = null): BaseConfig
    {
        $this->imageFileFon = $imageFon;

        if (null !== $imageFon) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtFon = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFileFon(): ?File
    {
        return $this->imageFileFon;
    }

    public function setImageNameFon(?string $imageNameFon): BaseConfig
    {
        $this->imageNameFon = $imageNameFon;
        return $this;
    }

    public function getImageNameFon(): ?string
    {
        return $this->imageNameFon;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAtFon(): ?\DateTime
    {
        return $this->updatedAtFon;
    }

    /**
     * @param \DateTime $updatedAtFon
     */
    public function setUpdatedAtFon(\DateTime $updatedAtFon): BaseConfig
    {
        $this->updatedAtFon = $updatedAtFon;
        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageLogo
     */
    public function setImageFileLogo(?File $imageLogo = null): BaseConfig
    {
        $this->imageFileLogo = $imageLogo;

        if (null !== $imageLogo) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtLogo = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFileLogo(): ?File
    {
        return $this->imageFileLogo;
    }

    public function setImageNameLogo(?string $imageNameLogo): BaseConfig
    {
        $this->imageNameLogo = $imageNameLogo;
        return $this;
    }

    public function getImageNameLogo(): ?string
    {
        return $this->imageNameLogo;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAtLogo(): ?\DateTime
    {
        return $this->updatedAtLogo;
    }

    /**
     * @param \DateTime $updatedAtLogo
     */
    public function setUpdatedAtLogo(\DateTime $updatedAtLogo): BaseConfig
    {
        $this->updatedAtLogo = $updatedAtLogo;
        return $this;
    }


}
