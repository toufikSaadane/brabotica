<?php

namespace App\Entity;

use App\Repository\DiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscountRepository::class)
 */
class Discount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $corting_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $corting_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discount_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $discount_code;

    /**
     * @ORM\Column(type="float")
     */
    private $discount_value;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="discount")
     */
    private $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCortingType(): ?string
    {
        return $this->corting_type;
    }

    public function setCortingType(string $corting_type): self
    {
        $this->corting_type = $corting_type;

        return $this;
    }

    public function getCortingCode(): ?int
    {
        return $this->corting_code;
    }

    public function setCortingCode(int $corting_code): self
    {
        $this->corting_code = $corting_code;

        return $this;
    }

    public function getDiscountType(): ?string
    {
        return $this->discount_type;
    }

    public function setDiscountType(string $discount_type): self
    {
        $this->discount_type = $discount_type;

        return $this;
    }

    public function getDiscountCode(): ?int
    {
        return $this->discount_code;
    }

    public function setDiscountCode(int $discount_code): self
    {
        $this->discount_code = $discount_code;

        return $this;
    }

    public function getDiscountValue(): ?float
    {
        return $this->discount_value;
    }

    public function setDiscountValue(float $discount_value): self
    {
        $this->discount_value = $discount_value;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setDiscount($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getDiscount() === $this) {
                $product->setDiscount(null);
            }
        }

        return $this;
    }
}
