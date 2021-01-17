<?php


namespace App\Controller\Page;


use App\Model\User\UseCase\SignUp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request, SignUp\ByEmail\Request\Handler $handler)
    {
        $command = new SignUp\ByEmail\Request\Command($request->get('email'), $request->get('password'));

        $response = [];
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            $response['error'] = $e->getMessage();
        }

        return $this->json($response);
    }
}