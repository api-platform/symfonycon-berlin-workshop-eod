<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FilterOrdersForCurrentUser implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['addFilter', EventPriorities::PRE_READ]
            ],
        ];
    }

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function addFilter(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($request->getPathInfo() !== '/orders' || !$request->isMethod('GET')) {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();
        $request->query->set('username', $user->getUsername());
    }
}
