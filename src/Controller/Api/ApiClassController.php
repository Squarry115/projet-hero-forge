<?php

namespace App\Controller\Api;

use App\Repository\CharacterCLassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class ApiClassController extends AbstractController
{
    #[Route('/classes', name: 'api_classes', methods: ['GET'])]
    public function list(CharacterCLassRepository $classRepository): JsonResponse
    {
        $classes = $classRepository->findAll();

        $data = array_map(fn($class) => [
            'id'          => $class->getId(),
            'name'        => $class->getName(),
            'description' => $class->getDescription(),
            'healthDice'  => $class->getHitDice(),
        ], $classes);

        return $this->json($data);
    }

    #[Route('/classes/{id}', name: 'api_class_show', methods: ['GET'])]
    public function show(int $id, CharacterCLassRepository $classRepository): JsonResponse
    {
        $class = $classRepository->find($id);

        if (!$class) {
            return $this->json(['error' => 'Class not found'], 404);
        }

        $skills = array_map(fn($skill) => [
            'id'      => $skill->getId(),
            'name'    => $skill->getName(),
            'ability' => $skill->getAbility(),
        ], $class->getSkills()->toArray());

        return $this->json([
            'id'          => $class->getId(),
            'name'        => $class->getName(),
            'description' => $class->getDescription(),
            'healthDice'  => $class->getHitDice(),
            'skills'      => $skills,
        ]);
    }
}
