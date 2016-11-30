<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get"={"method"="GET"},
 *         "dispatch"={"route_name"="order_dispatch"},
 *     },
 *     attributes={
 *         "normalization_context"={"groups"={"order_read"}},
 *         "filters"={"order.search"}
 *     }
 * )
 *
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Serializer\Groups({"order_read"})
     *
     * @var int
     */
    public $id;

    /**
     * @ORM\Column
     *
     * @Serializer\Groups({"order_read"})
     *
     * @var string
     */
    public $address;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="orders")
     * @ORM\JoinColumn(name="customer_uuid", referencedColumnName="uuid")
     *
     * @Serializer\Groups({"order_read"})
     *
     * @var Customer
     */
    public $customer;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Serializer\Groups({"order_read"})
     *
     * @var bool
     */
    public $dispatched = false;

    /**
     * @ORM\Column
     *
     * @Serializer\Groups({"admin_only"})
     *
     * @Assert\NotBlank
     *
     * @var string
     */
    public $username;
}
