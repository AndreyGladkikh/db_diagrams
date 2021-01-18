<?php


namespace App\Controller\Web\Page;


use App\Model\User\UseCase\SignUp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }
}