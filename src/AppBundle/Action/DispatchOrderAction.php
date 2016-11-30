<?php

namespace AppBundle\Action;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Order;
use Symfony\Component\HttpFoundation\JsonResponse;

class DispatchOrderAction
{
    /**
     * @Route(
     *    "/orders/{id}/dispatch",
     *    methods={"POST"},
     *    name="order_dispatch",
     *    defaults={
     *       "_api_resource_class"=Order::class,
     *       "_api_item_operation_name"="dispatch"
     *    }
     * )
     */
    public function __invoke(Order $data)
    {
        $data->dispatched = true;

        return $data;
    }
}
