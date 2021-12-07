<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        if (!empty($this->getUser())) {
            echo '<h1>Votre username:' . $this->getUser()->getUsername() .'</h1>';
            
        }

        return $this->render('@User/Default/index.html.twig');
    }
}
