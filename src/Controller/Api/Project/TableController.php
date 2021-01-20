<?php


namespace App\Controller\Api\Project;


use App\Model\Project\UseCase\Table\CreateBulk;
use App\Service\Request\JsonBodyParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    /**
     * @Route("/project/{projectId}/tables", methods={"POST"})
     * @param Request $request
     * @param string $projectId
     * @param CreateBulk\Handler $handler
     */
    public function createBulk(Request $request, string $projectId, CreateBulk\Handler $handler)
    {
        $params = JsonBodyParser::parse($request);

        $response = [];
        try {
            $command = new CreateBulk\Command($projectId ,$params['tables']);
            $handler->handle($command);
        } catch (\Exception $e) {
            $response['error'] = $e->getMessage();
        }
        $this->json($response);
    }
}