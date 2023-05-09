<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PlaceholderService;
use Symfony\Component\HttpFoundation\Request;

class PlaceholderController extends AbstractController
{


    public function __construct(
        private PlaceholderService $placeholderService
    )
    {
        
    }

    #[Route('/', methods:['GET'])]
    public function redirectToImageGenerator()
    {
       return $this->redirect('/image');
    }

    #[Route('/image', name: 'app_placeholder')]
    public function create(Request $request)
    {
        try{
            $width = $request->query->get('width') ? $request->query->get('width') : 100;
            $height = $request->query->get('height') ? $request->query->get('height') : 100;

            return new Response($this->placeholderService->create($width, $height), Response::HTTP_OK, ['Content-type' => 'image/png']);
        }catch(\Throwable $exception){
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
