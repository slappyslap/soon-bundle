<?php

namespace SoonBundle\EventSubscriber;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class RequestSubscriber implements EventSubscriberInterface
{

    private ParameterBagInterface $parameterBag;

    private Environment $twig;

    public function __construct(ParameterBagInterface $parameterBag, Environment $twig)
    {
        $this->parameterBag = $parameterBag;
        $this->twig = $twig;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMainRequest()) {
            return;
        }

        if ($this->isExcludedRoute($event->getRequest()) || $this->isExcludedIp($event->getRequest())) {
            return;
        }

        $event->setResponse(new Response($this->twig->render('@Soon/soon.html.twig',
            [
                'logo' => $this->parameterBag->get('soon.config.logo'),
                'background' => $this->parameterBag->get('soon.config.background'),
                'color' => $this->parameterBag->get('soon.config.color'),
                'title' => $this->parameterBag->get('soon.config.title'),
                'description' => $this->parameterBag->get('soon.config.description'),
                'release_date' => $this->parameterBag->get('soon.config.release_date'),
                'socials' => $this->parameterBag->get('soon.config.socials')
            ]
        )));
    }

    protected function isExcludedRoute(Request $request): bool
    {
        $route = $request->getRequestUri();
        $excludesRoutes = $this->parameterBag->get('soon.config.exclude_routes');

        foreach ($excludesRoutes as $excludeRoute) {
            if (preg_match('{' . $excludeRoute . '}', $route)) {
                return true;
            }
        }

        return false;
    }

    protected function isExcludedIp(Request $request): bool
    {
        $userIp = $request->getClientIp();
        $excludeIps = $this->parameterBag->get('soon.config.exclude_ips');

        foreach ($excludeIps as $excludesIp) {
            if (IpUtils::checkIp($userIp, $excludesIp)) {
                return true;
            }
        }

        return false;
    }
}