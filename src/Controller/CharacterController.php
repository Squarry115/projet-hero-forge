<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterFormType;
use App\Repository\CharacterRepository;
use App\Repository\CharacterCLassRepository;
use App\Repository\RaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_USER')]
#[Route('/character')]
final class CharacterController extends AbstractController
{
    // Liste des personnages de l'utilisateur connecté
    #[Route('', name: 'app_character_index', methods: ['GET'])]
    public function index(CharacterRepository $repo, Request $request): Response
    {
        $name  = $request->query->get('name');
        $race  = $request->query->get('race');
        $class = $request->query->get('class');

        $characters = $repo->findByFilters($name, $race, $class);

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
            'name'       => $name,
            'race'       => $race,
            'class'      => $class,
        ]);
    }

    // Créer un personnage
    #[Route('/new', name: 'app_character_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        CharacterCLassRepository $classRepo,
        RaceRepository $raceRepo
    ): Response {
        $character = new Character();
        $form = $this->createForm(CharacterFormType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Upload image
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getParameter('characters_images_directory'), $newFilename);
                $character->setImage($newFilename);
            }

            // Calcul des points de vie
            $con = $character->getCON();
            $conModifier = (int) floor(($con - 10) / 2);
            $hitDice = $character->getClassId()->getHitDice();
            $character->setHitPoints($hitDice + $conModifier);

            // Associer à l'utilisateur connecté
            $character->setIdUser($this->getUser());
            $character->setLevel(1);

            $em->persist($character);
            $em->flush();

            $this->addFlash('success', 'Personnage créé avec succès !');
            return $this->redirectToRoute('app_character_index');
        }

        return $this->render('character/new.html.twig', [
            'form' => $form,
        ]);
    }

    // Voir un personnage
    #[Route('/{id}', name: 'app_character_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();

        $character = $conn->executeQuery('
            SELECT c.*, r.name as race_name, cl.name as class_name, cl.hit_dice
            FROM character c
            LEFT JOIN race r ON c.id_race_id = r.id
            LEFT JOIN character_class cl ON c.class_id_id = cl.id
            WHERE c.id = :id
        ', ['id' => $id])->fetchAssociative();

        if (!$character) {
            throw $this->createNotFoundException('Personnage introuvable');
        }

        $parties = $conn->executeQuery('
            SELECT p.id, p.name
            FROM party p
            INNER JOIN party_character pc ON pc.party_id = p.id
            WHERE pc.character_id = :id
        ', ['id' => $id])->fetchAllAssociative();

        return $this->render('character/show.html.twig', [
            'character' => $character,
            'parties'   => $parties,
        ]);
    }

    // Modifier un personnage
    #[Route('/{id}/edit', name: 'app_character_edit', methods: ['GET', 'POST'])]
    public function edit(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        CharacterRepository $repo
    ): Response {
        $character = $repo->find($id);

        if (!$character || $character->getIdUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        $form = $this->createForm(CharacterFormType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getParameter('characters_images_directory'), $newFilename);
                $character->setImage($newFilename);
            }

            // Recalcul des points de vie
            $con = $character->getCON();
            $conModifier = (int) floor(($con - 10) / 2);
            $hitDice = $character->getClassId()->getHitDice();
            $character->setHitPoints($hitDice + $conModifier);

            $em->flush();

            $this->addFlash('success', 'Personnage modifié avec succès !');
            return $this->redirectToRoute('app_character_index');
        }

        return $this->render('character/edit.html.twig', [
            'form'      => $form,
            'character' => $character,
        ]);
    }

    // Supprimer un personnage
    #[Route('/{id}/delete', name: 'app_character_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em, CharacterRepository $repo): Response
    {
        $character = $repo->find($id);

        if (!$character || $character->getIdUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $em->remove($character);
            $em->flush();
            $this->addFlash('success', 'Personnage supprimé.');
        }

        return $this->redirectToRoute('app_character_index');
    }
}
