<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="order_id")
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_postalcode;

    /**
     * @ORM\Column(type="float")
     */
    private $billing_total;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipped;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_method;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_gateway;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

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
            $product->setOrderId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getOrderId() === $this) {
                $product->setOrderId(null);
            }
        }

        return $this;
    }

    public function getBillingEmail(): ?string
    {
        return $this->billing_email;
    }

    public function setBillingEmail(string $billing_email): self
    {
        $this->billing_email = $billing_email;

        return $this;
    }

    public function getBillingName(): ?string
    {
        return $this->billing_name;
    }

    public function setBillingName(string $billing_name): self
    {
        $this->billing_name = $billing_name;

        return $this;
    }

    public function getBillingAdress(): ?string
    {
        return $this->billing_adress;
    }

    public function setBillingAdress(string $billing_adress): self
    {
        $this->billing_adress = $billing_adress;

        return $this;
    }

    public function getBillingPostalcode(): ?string
    {
        return $this->billing_postalcode;
    }

    public function setBillingPostalcode(string $billing_postalcode): self
    {
        $this->billing_postalcode = $billing_postalcode;

        return $this;
    }

    public function getBillingTotal(): ?float
    {
        return $this->billing_total;
    }

    public function setBillingTotal(float $billing_total): self
    {
        $this->billing_total = $billing_total;

        return $this;
    }

    public function getShipped(): ?bool
    {
        return $this->shipped;
    }

    public function setShipped(bool $shipped): self
    {
        $this->shipped = $shipped;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    public function getPaymentGateway(): ?string
    {
        return $this->payment_gateway;
    }

    public function setPaymentGateway(string $payment_gateway): self
    {
        $this->payment_gateway = $payment_gateway;

        return $this;
    }
}
