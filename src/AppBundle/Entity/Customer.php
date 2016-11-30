<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get": {
 *             "method": "GET",
 *             "normalization_context"={"groups"={"customer_read"}}
 *         }
 *     },
 *     attributes={
 *         "denormalization_context"={"groups"={"customer_write"}},
 *         "filters"={"customer.search"}
 *     },
 * )
 *
 * @ORM\Entity
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column
     *
     * @Serializer\Groups({"order_read"})
     *
     * @var string
     */
    private $uuid;

    /**
     * @ORM\Column(type="string")
     *
     * @Serializer\Groups({"order_read", "customer_write", "customer_read"})
     *
     * @Assert\NotBlank
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(nullable=true)
     *
     * @Serializer\Groups({"customer_write", "customer_read"})
     *
     * @var string
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="customer")
     *
     * @var Order[]
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * @return Order[]
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Order[] $orders
     */
    public function setOrders(array $orders)
    {
        $this->orders = $orders;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }
}
