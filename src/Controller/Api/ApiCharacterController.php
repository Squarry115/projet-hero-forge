<?php

namespace App\Controller\Api;

use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class ApiCharacterController extends AbstractController
{
    #[Route('/characters', name: 'api_characters', methods: ['GET'])]
    public function list(Request $request, CharacterRepository $characterRepository): JsonResponse
    {
        $name  = $request->query->get('name');
        $race  = $request->query->get('race');
        $class = $request->query->get('class');

        $characters = $characterRepository->findByFilters($name, $race, $class);

        $data = array_map(fn($c) => [
            'id'           => $c['id'],
            'name'         => $c['name'],
            'level'        => $c['level'],
            'race'         => $c['race_name'] ?? null,
            'class'        => $c['class_name'] ?? null,
            'healthPoints' => $c['hit_points'],
        ], $characters);

        return $this->json($data);
    }

    #[Route('/characters/{id}', name: 'api_character_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): JsonResponse
    {
        $conn = $em->getConnection();

        $character = $conn->executeQuery('
            SELECT c.id, c.name, c.level, c.str, c.dex, c.con, c.int, c.wis, c.cha,
                   c.hit_points, c.image,
                   r.name as race_name, r.id as race_id,
                   cl.name as class_name, cl.id as class_id, cl.hit_dice
            FROM character c
            LEFT JOIN race r ON c.id_race_id = r.id
            LEFT JOIN character_class cl ON c.class_id_id = cl.id
            WHERE c.id = :id
        ', ['id' => $id])->fetchAssociative();

        if (!$character) {
            return $this->json(['error' => 'Character not found'], 404);
        }

        $parties = $conn->executeQuery('
            SELECT p.id, p.name
            FROM party p
            INNER JOIN party_character pc ON pc.party_id = p.id
            WHERE pc.character_id = :id
        ', ['id' => $id])->fetchAllAssociative();

        return $this->json([
            'id'           => $character['id'],
            'name'         => $character['name'],
            'level'        => $character['level'],
            'healthPoints' => $character['hit_points'],
            'stats'        => [
                'strength'     => $character['str'],
                'dexterity'    => $character['dex'],
                'constitution' => $character['con'],
                'intelligence' => $character['int'],
                'wisdom'       => $character['wis'],
                'charisma'     => $character['cha'],
            ],
            'race'    => [
                'id'   => $character['race_id'],
                'name' => $character['race_name'],
            ],
            'class'   => [
                'id'         => $character['class_id'],
                'name'       => $character['class_name'],
                'healthDice' => $character['hit_dice'],
            ],
            'parties' => $parties,
            'image'   => $character['image'],
        ]);
    }
}
