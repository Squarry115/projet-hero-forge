<?php

namespace App\Controller;

use App\Entity\CharacterCLass;
use App\Entity\Race;
use App\Entity\Skill;
use App\Form\CharacterClassFormType;
use App\Form\RaceFormType;
use App\Form\SkillFormType;
use App\Repository\CharacterCLassRepository;
use App\Repository\RaceRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
final class AdminController extends AbstractController
{
    // Dashboard admin
    #[Route('', name: 'app_admin')]
    public function index(UserRepository $userRepo): Response
    {
        return $this->render('admin/index.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }

    // ===================== RACES =====================

    #[Route('/races', name: 'admin_race_index')]
    public function races(RaceRepository $repo): Response
    {
        return $this->render('admin/race/index.html.twig', [
            'races' => $repo->findAll(),
        ]);
    }

    #[Route('/races/new', name: 'admin_race_new', methods: ['GET', 'POST'])]
    public function newRace(Request $request, EntityManagerInterface $em): Response
    {
        $race = new Race();
        $form = $this->createForm(RaceFormType::class, $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($race);
            $em->flush();
            $this->addFlash('success', 'Race créée !');
            return $this->redirectToRoute('admin_race_index');
        }

        return $this->render('admin/race/form.html.twig', ['form' => $form, 'title' => 'Nouvelle race']);
    }

    #[Route('/races/{id}/edit', name: 'admin_race_edit', methods: ['GET', 'POST'])]
    public function editRace(int $id, Request $request, RaceRepository $repo, EntityManagerInterface $em): Response
    {
        $race = $repo->find($id) ?? throw $this->createNotFoundException();
        $form = $this->createForm(RaceFormType::class, $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Race modifiée !');
            return $this->redirectToRoute('admin_race_index');
        }

        return $this->render('admin/race/form.html.twig', ['form' => $form, 'title' => 'Modifier la race']);
    }

    #[Route('/races/{id}/delete', name: 'admin_race_delete', methods: ['POST'])]
    public function deleteRace(int $id, Request $request, RaceRepository $repo, EntityManagerInterface $em): Response
    {
        $race = $repo->find($id) ?? throw $this->createNotFoundException();
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $em->remove($race);
            $em->flush();
            $this->addFlash('success', 'Race supprimée !');
        }
        return $this->redirectToRoute('admin_race_index');
    }

    // ===================== CLASSES =====================

    #[Route('/classes', name: 'admin_class_index')]
    public function classes(CharacterCLassRepository $repo): Response
    {
        return $this->render('admin/class/index.html.twig', [
            'classes' => $repo->findAll(),
        ]);
    }

    #[Route('/classes/new', name: 'admin_class_new', methods: ['GET', 'POST'])]
    public function newClass(Request $request, EntityManagerInterface $em): Response
    {
        $class = new CharacterCLass();
        $form = $this->createForm(CharacterClassFormType::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($class);
            $em->flush();
            $this->addFlash('success', 'Classe créée !');
            return $this->redirectToRoute('admin_class_index');
        }

        return $this->render('admin/class/form.html.twig', ['form' => $form, 'title' => 'Nouvelle classe']);
    }

    #[Route('/classes/{id}/edit', name: 'admin_class_edit', methods: ['GET', 'POST'])]
    public function editClass(int $id, Request $request, CharacterCLassRepository $repo, EntityManagerInterface $em): Response
    {
        $class = $repo->find($id) ?? throw $this->createNotFoundException();
        $form = $this->createForm(CharacterClassFormType::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Classe modifiée !');
            return $this->redirectToRoute('admin_class_index');
        }

        return $this->render('admin/class/form.html.twig', ['form' => $form, 'title' => 'Modifier la classe']);
    }

    #[Route('/classes/{id}/delete', name: 'admin_class_delete', methods: ['POST'])]
    public function deleteClass(int $id, Request $request, CharacterCLassRepository $repo, EntityManagerInterface $em): Response
    {
        $class = $repo->find($id) ?? throw $this->createNotFoundException();
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $em->remove($class);
            $em->flush();
            $this->addFlash('success', 'Classe supprimée !');
        }
        return $this->redirectToRoute('admin_class_index');
    }

    // ===================== COMPÉTENCES =====================

    #[Route('/skills', name: 'admin_skill_index')]
    public function skills(SkillRepository $repo): Response
    {
        return $this->render('admin/skill/index.html.twig', [
            'skills' => $repo->findAll(),
        ]);
    }

    #[Route('/skills/new', name: 'admin_skill_new', methods: ['GET', 'POST'])]
    public function newSkill(Request $request, EntityManagerInterface $em): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillFormType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($skill);
            $em->flush();
            $this->addFlash('success', 'Compétence créée !');
            return $this->redirectToRoute('admin_skill_index');
        }

        return $this->render('admin/skill/form.html.twig', ['form' => $form, 'title' => 'Nouvelle compétence']);
    }

    #[Route('/skills/{id}/edit', name: 'admin_skill_edit', methods: ['GET', 'POST'])]
    public function editSkill(int $id, Request $request, SkillRepository $repo, EntityManagerInterface $em): Response
    {
        $skill = $repo->find($id) ?? throw $this->createNotFoundException();
        $form = $this->createForm(SkillFormType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Compétence modifiée !');
            return $this->redirectToRoute('admin_skill_index');
        }

        return $this->render('admin/skill/form.html.twig', ['form' => $form, 'title' => 'Modifier la compétence']);
    }

    #[Route('/skills/{id}/delete', name: 'admin_skill_delete', methods: ['POST'])]
    public function deleteSkill(int $id, Request $request, SkillRepository $repo, EntityManagerInterface $em): Response
    {
        $skill = $repo->find($id) ?? throw $this->createNotFoundException();
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $em->remove($skill);
            $em->flush();
            $this->addFlash('success', 'Compétence supprimée !');
        }
        return $this->redirectToRoute('admin_skill_index');
    }
}
