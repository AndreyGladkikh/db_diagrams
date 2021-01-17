<?php


namespace App\Controller\User;


use App\ReadModel\User\UserFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @param UserFetcher $userFetcher
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/users")
     */
    public function getAll(UserFetcher $userFetcher)
    {
        return $this->json($userFetcher->getList());
    }
}