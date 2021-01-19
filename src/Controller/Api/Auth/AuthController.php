<?php


namespace App\Controller\Api\Auth;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\User\UseCase\SignUp;

class AuthController extends AbstractController
{
    /**
     * @Route("/signup", methods={"POST"})
     * @param Request $request
     * @param SignUp\ByEmail\Request\Handler $handler
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function signup(Request $request, SignUp\ByEmail\Request\Handler $handler)
    {
        $command = new SignUp\ByEmail\Request\Command($request->get('email'), $request->get('password'));

        $response = ['success'];
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            $response['error'] = $e->getMessage();
        }

        return $this->json($response);
    }
}