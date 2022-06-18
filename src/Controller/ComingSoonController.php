<?php

namespace SoonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ComingSoonController extends AbstractController
{
    public function index(): Response
    {
        return new Response("Comming soon");
    }
}