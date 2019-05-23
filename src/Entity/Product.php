<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Vich\Uploadable()
 */
class Product
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youTube;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $characteristics;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $residue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $views;

    /**
     * @var ProductImage[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ProductImage", mappedBy="product", cascade={"persist"})
     */
    private $productImage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupProduct", inversedBy="products")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $group;

    /**
     * @Vich\UploadableField(mapping="products", fileNameProperty="imageName")
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
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var OrderItem[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="product")
     */
    private $orderItems;

    /**
     * @var CharacteristicItemForProduct[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CharacteristicItemForProduct", mappedBy="product", cascade={"persist"})
     */
    private $characteristicItemForProduct;

    public function __construct()
    {
        $this->name = "";
        $this->productImage = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
        $this->characteristicItemForProduct = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getYouTube(): ?string
    {
        return $this->youTube;
    }

    public function setYouTube(?string $youTube): self
    {
        $this->youTube = $youTube;

        return $this;
    }

    public function getCharacteristics(): ?string
    {
        return $this->characteristics;
    }

    public function setCharacteristics(?string $characteristics): self
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getResidue(): ?string
    {
        return $this->residue;
    }

    public function setResidue(?string $residue): self
    {
        $this->residue = $residue;

        return $this;
    }

    public function getViews(): ?string
    {
        return $this->views;
    }

    public function setViews(?string $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getGroup(): ?GroupProduct
    {
        return $this->group;
    }

    public function setGroup(?GroupProduct $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(?File $image = null): Product
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

    public function setImageName(?string $imageName): Product
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
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
    public function setUpdatedAt(\DateTime $updatedAt): Product
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection|ProductImage[]
     */
    public function getProductImage(): Collection
    {
        return $this->productImage;
    }

    public function addProductImage(ProductImage $productImage): self
    {
        if (!$this->productImage->contains($productImage)) {
            $this->productImage[] = $productImage;
            $productImage->setProduct($this);
        }

        return $this;
    }

    public function removeProductImage(ProductImage $productImage): self
    {
        if ($this->productImage->contains($productImage)) {
            $this->productImage->removeElement($productImage);
            // set the owning side to null (unless already changed)
            if ($productImage->getProduct() === $this) {
                $productImage->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->contains($orderItem)) {
            $this->orderItems->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CharacteristicItemForProduct[]
     */
    public function getCharacteristicItemForProduct(): Collection
    {
        return $this->characteristicItemForProduct;
    }

    public function addCharacteristicItemForProduct(CharacteristicItemForProduct $characteristicItemForProduct): self
    {
        if (!$this->characteristicItemForProduct->contains($characteristicItemForProduct)) {
            $this->characteristicItemForProduct[] = $characteristicItemForProduct;
            $characteristicItemForProduct->setProduct($this);
        }

        return $this;
    }

    public function removeCharacteristicItemForProduct(CharacteristicItemForProduct $characteristicItemForProduct): self
    {
        if ($this->characteristicItemForProduct->contains($characteristicItemForProduct)) {
            $this->characteristicItemForProduct->removeElement($characteristicItemForProduct);
            // set the owning side to null (unless already changed)
            if ($characteristicItemForProduct->getProduct() === $this) {
                $characteristicItemForProduct->setProduct(null);
            }
        }

        return $this;
    }

}
