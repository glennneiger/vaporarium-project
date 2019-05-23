<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Tree\Traits\NestedSetEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @Vich\Uploadable()
 */
class Category
{
    use NestedSetEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publish;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var CharacteristicItemForCategory[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CharacteristicItemForCategory", mappedBy="characteristicItemForCategory", cascade={"persist"})
     */
    private $characteristicItemForCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fonRGB;

    /**
     * @var Category;
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="parent_id", nullable=true)
     */
    private $parent;

    /**
     * @var Category;
     * @ORM\OrderBy({"left" = "ASC"})
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $subcategories;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
     */
    private $products;

    /**
     * @Vich\UploadableField(mapping="categoryImageFon", fileNameProperty="imageNameCategoryFon")
     *
     * @var File
     */
    private $imageFileCategoryFon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageNameCategoryFon;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtCategoryFon;

    /**
     * @Vich\UploadableField(mapping="categoryImage", fileNameProperty="imageNameCategory")
     *
     * @var File
     */
    private $imageFileCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageNameCategory;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAtCategory;


    public function __construct()
    {
        $this->name="";
        $this->subcategories = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->characteristicItemForCategory = new ArrayCollection();
    }

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

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getSubcategories(): Collection
    {
        return $this->subcategories;
    }

    public function addSubcategory(Category $subcategory): self
    {
        if (!$this->subcategories->contains($subcategory)) {
            $this->subcategories[] = $subcategory;
            $subcategory->setParent($this);
        }

        return $this;
    }

    public function removeSubcategory(Category $subcategory): self
    {
        if ($this->subcategories->contains($subcategory)) {
            $this->subcategories->removeElement($subcategory);
            // set the owning side to null (unless already changed)
            if ($subcategory->getParent() === $this) {
                $subcategory->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageCategoryFon
     */
    public function setImageFileCategoryFon(?File $imageCategoryFon = null): Category
    {
        $this->imageFileCategoryFon = $imageCategoryFon;

        if (null !== $imageCategoryFon) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtCategoryFon = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFileCategoryFon(): ?File
    {
        return $this->imageFileCategoryFon;
    }

    public function setImageNameCategoryFon(?string $imageNameCategoryFon): Category
    {
        $this->imageNameCategoryFon = $imageNameCategoryFon;
        return $this;
    }

    public function getImageNameCategoryFon(): ?string
    {
        return $this->imageNameCategoryFon;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAtCategoryFon(): ?\DateTime
    {
        return $this->updatedAtCategoryFon;
    }

    /**
     * @param \DateTime $updatedAtCategoryFon
     */
    public function setUpdatedAtFon(\DateTime $updatedAtCategoryFon): Category
    {
        $this->updatedAtCategoryFon = $updatedAtCategoryFon;
        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageCategory
     */
    public function setImageFileCategory(?File $imageCategory = null): Category
    {
        $this->imageFileCategory = $imageCategory;

        if (null !== $imageCategory) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAtCategory = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFileCategory(): ?File
    {
        return $this->imageFileCategory;
    }

    public function setImageNameCategory(?string $imageNameCategory): Category
    {
        $this->imageNameCategory = $imageNameCategory;
        return $this;
    }

    public function getImageNameCategory(): ?string
    {
        return $this->imageNameCategory;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAtCategory(): ?\DateTime
    {
        return $this->updatedAtCategory;
    }

    /**
     * @param \DateTime $updatedAtCategory
     */
    public function setUpdatedAtCategory(\DateTime $updatedAtCategory): Category
    {
        $this->updatedAtCategory = $updatedAtCategory;
        return $this;
    }

    public function setUpdatedAtCategoryFon(?\DateTimeInterface $updatedAtCategoryFon): self
    {
        $this->updatedAtCategoryFon = $updatedAtCategoryFon;

        return $this;
    }

    /**
     * @return Collection|CharacteristicItemForCategory[]
     */
    public function getCharacteristicItemForCategory(): Collection
    {
        return $this->characteristicItemForCategory;
    }

    public function addCharacteristicItemForCategory(CharacteristicItemForCategory $characteristicItemForCategory): self
    {
        if (!$this->characteristicItemForCategory->contains($characteristicItemForCategory)) {
            $this->characteristicItemForCategory[] = $characteristicItemForCategory;
            $characteristicItemForCategory->setCharacteristicItemForCategory($this);
        }

        return $this;
    }

    public function removeCharacteristicItemForCategory(CharacteristicItemForCategory $characteristicItemForCategory): self
    {
        if ($this->characteristicItemForCategory->contains($characteristicItemForCategory)) {
            $this->characteristicItemForCategory->removeElement($characteristicItemForCategory);
            // set the owning side to null (unless already changed)
            if ($characteristicItemForCategory->getCharacteristicItemForCategory() === $this) {
                $characteristicItemForCategory->setCharacteristicItemForCategory(null);
            }
        }

        return $this;
    }

}
