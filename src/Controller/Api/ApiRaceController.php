<?php

namespace App\Controller\Api;

use App\Repository\RaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class ApiRaceController extends AbstractController
{
    #[Route('/races', name: 'api_races', methods: ['GET'])]
    public function list(RaceRepository $raceRepository): JsonResponse
    {
        $races = $raceRepository->findAll();

        $data = array_map(fn($race) => [
            'id'          => $race->getId(),
            'name'        => $race->getName(),
            'description' => $race->getDescription(),
        ], $races);

        return $this->json($data);
    }

    #[Route('/races/{id}', name: 'api_race_show', methods: ['GET'])]
    public function show(int $id, RaceRepository $raceRepository): JsonResponse
    {
        $race = $raceRepository->find($id);

        if (!$race) {
            return $this->json(['error' => 'Race not found'], 404);
        }

        return $this->json([
            'id'          => $race->getId(),
            'name'        => $race->getName(),
            'description' => $race->getDescription(),
        ]);
    }
}
