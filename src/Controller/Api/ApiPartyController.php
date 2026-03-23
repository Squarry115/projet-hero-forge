<?php

namespace App\Controller\Api;

use App\Repository\PartyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class ApiPartyController extends AbstractController
{
    #[Route('/parties', name: 'api_parties', methods: ['GET'])]
    public function list(Request $request, PartyRepository $partyRepository): JsonResponse
    {
        $filter = $request->query->get('filter');
        $parties = $partyRepository->findAll();

        if ($filter === 'full') {
            $parties = array_filter($parties, fn($p) => count($p->getCharacters()) >= $p->getMaxSize());
        } elseif ($filter === 'available') {
            $parties = array_filter($parties, fn($p) => count($p->getCharacters()) < $p->getMaxSize());
        }

        $data = array_map(fn($party) => [
            'id'          => $party->getId(),
            'name'        => $party->getName(),
            'description' => $party->getDescription(),
            'maxSize'     => $party->getMaxSize(),
            'members'     => count($party->getCharacters()),
        ], array_values($parties));

        return $this->json($data);
    }

    #[Route('/parties/{id}', name: 'api_party_show', methods: ['GET'])]
    public function show(int $id, PartyRepository $partyRepository): JsonResponse
    {
        $party = $partyRepository->find($id);

        if (!$party) {
            return $this->json(['error' => 'Party not found'], 404);
        }

        $members = array_map(fn($character) => [
            'id'    => $character->getId(),
            'name'  => $character->getName(),
            'level' => $character->getLevel(),
            'race'  => $character->getIdRace()?->getName(),
            'class' => $character->getClassId()?->getName(),
        ], $party->getCharacters()->toArray());

        return $this->json([
            'id'          => $party->getId(),
            'name'        => $party->getName(),
            'description' => $party->getDescription(),
            'maxSize'     => $party->getMaxSize(),
            'members'     => $members,
        ]);
    }
}
