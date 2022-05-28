<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController
{
    /**
     * @Route ("/")
     */

    public function homepageAction()
    {
        return new Response("Hello!");

    }
}