<?php

namespace App\Controller;

use App\Entity\Party;
use App\Form\PartyFormType;
use App\Repository\CharacterRepository;
use App\Repository\PartyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/party')]
final class PartyController extends AbstractController
{
    // Liste des groupes
    #[Route('', name: 'app_party_index', methods: ['GET'])]
    public function index(PartyRepository $repo, Request $request): Response
    {
        $filter = $request->query->get('filter');
        $parties = $repo->findAll();

        if ($filter === 'full') {
            $parties = array_filter($parties, fn($p) => count($p->getCharacters()) >= $p->getMaxSize());
        } elseif ($filter === 'available') {
            $parties = array_filter($parties, fn($p) => count($p->getCharacters()) < $p->getMaxSize());
        }

        return $this->render('party/index.html.twig', [
            'parties' => array_values($parties),
            'filter'  => $filter,
        ]);
    }

    // Créer un groupe
    #[Route('/new', name: 'app_party_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $party = new Party();
        $form = $this->createForm(PartyFormType::class, $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($party);
            $em->flush();
            $this->addFlash('success', 'Groupe créé avec succès !');
            return $this->redirectToRoute('app_party_index');
        }

        return $this->render('party/new.html.twig', [
            'form' => $form,
        ]);
    }

    // Voir un groupe
    #[Route('/{id}', name: 'app_party_show', methods: ['GET'])]
    public function show(int $id, PartyRepository $repo, CharacterRepository $charRepo): Response
    {
        $party = $repo->find($id);
        if (!$party) {
            throw $this->createNotFoundException('Groupe introuvable');
        }

        // Personnages de l'utilisateur connecté
        $myCharacters = array_filter(
            $charRepo->findAll(),
            fn($c) => $c->getIdUser() === $this->getUser()
        );

        return $this->render('party/show.html.twig', [
            'party'        => $party,
            'myCharacters' => array_values($myCharacters),
        ]);
    }

    // Rejoindre un groupe avec un personnage
    #[Route('/{id}/join/{characterId}', name: 'app_party_join', methods: ['POST'])]
    public function join(int $id, int $characterId, PartyRepository $repo, CharacterRepository $charRepo, EntityManagerInterface $em): Response
    {
        $party     = $repo->find($id);
        $character = $charRepo->find($characterId);

        if (!$party || !$character) {
            throw $this->createNotFoundException();
        }

        // Vérifier que le personnage appartient à l'utilisateur connecté
        if ($character->getIdUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        // Vérifier qu'il y a de la place
        if (count($party->getCharacters()) >= $party->getMaxSize()) {
            $this->addFlash('error', 'Ce groupe est complet !');
            return $this->redirectToRoute('app_party_show', ['id' => $id]);
        }

        $party->addCharacter($character);
        $em->flush();

        $this->addFlash('success', $character->getName() . ' a rejoint le groupe !');
        return $this->redirectToRoute('app_party_show', ['id' => $id]);
    }

    // Quitter un groupe
    #[Route('/{id}/leave/{characterId}', name: 'app_party_leave', methods: ['POST'])]
    public function leave(int $id, int $characterId, PartyRepository $repo, CharacterRepository $charRepo, EntityManagerInterface $em): Response
    {
        $party     = $repo->find($id);
        $character = $charRepo->find($characterId);

        if (!$party || !$character) {
            throw $this->createNotFoundException();
        }

        if ($character->getIdUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $party->removeCharacter($character);
        $em->flush();

        $this->addFlash('success', $character->getName() . ' a quitté le groupe.');
        return $this->redirectToRoute('app_party_show', ['id' => $id]);
    }

    // Supprimer un groupe
    #[Route('/{id}/delete', name: 'app_party_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, PartyRepository $repo, EntityManagerInterface $em): Response
    {
        $party = $repo->find($id);
        if (!$party) {
            throw $this->createNotFoundException();
        }

        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $em->remove($party);
            $em->flush();
            $this->addFlash('success', 'Groupe supprimé.');
        }

        return $this->redirectToRoute('app_party_index');
    }
}
