<?php

namespace App\Controller\Api;

use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class ApiSkillController extends AbstractController
{
    #[Route('/skills', name: 'api_skills', methods: ['GET'])]
    public function list(SkillRepository $skillRepository): JsonResponse
    {
        $skills = $skillRepository->findAll();

        $data = array_map(fn($skill) => [
            'id'      => $skill->getId(),
            'name'    => $skill->getName(),
            'ability' => $skill->getAbility(),
        ], $skills);

        return $this->json($data);
    }
}
