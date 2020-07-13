<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResidentController extends AbstractController
{
    /**
     * @Route("/resident", name="resident")
     */
    public function index()
    {
        return $this->render('resident/index.html.twig', [
//            'controller_name' => 'ResidentController',
        ]);
    }

    /**
     * @Route("/resident/showOne/{id}", name="resident.showOne")
     */
    public function showResident(User $resident = null)
    {

        if (!$resident) {
            $this->addFlash('error', 'Non existant resident');
        } else {

        }
        return $this->render('resident/showOneResident.html.twig', [
            'resident' => $resident,
        ]);
    }

    /**
     * @param $id
     * @Route("/resident/show" , name="resident.show")
     */
    public function getResident(//Request $request
    )
    {
        $user = $this->getUser();
//        $page = $request->query->get('page') ?? 1;
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        $residents = $repository->findBy(array('houseId' => $me->getHouseId()) //,[],2,( $page - 1)*2
        );
//        $nbEnregistrements = $residents->count(array());
//        $nbPage = ($nbEnregistrements % 2) ? ($nbEnregistrements / 2) + 1 : ($nbEnregistrements / 2);

        return $this->render('resident/index.html.twig', [
            'residents' => $residents,
//            'nbPage' => $nbPage
        ]);
    }

    /**
     * @param User|null $resident
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/resident/delete", name="resident.delete")
     */
    public function removeMe(User $resident = null)
    {
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(User::class);
        $me = $repository->findOneBy(['username' => $user->getUsername()]);
        $manager = $this->getDoctrine()->getManager();
$user->eraseCredentials();
        $manager->remove($me);
        $manager->flush();
        return $this->redirectToRoute('fos_user_security_login');
    }
//    /**
//     * @Route("/", name="personne")
//     */
//    public function index1(Request $request)
//    {
//        $page = $request->query->get('page') ?? 1;
//        $repository = $this->getDoctrine()->getRepository(User::class);
//        $nbEnregistrements = $repository->count(array());
//        $nbPage = ($nbEnregistrements % 2) ? ($nbEnregistrements / 2) + 1 : ($nbEnregistrements / 2);
//        $personnes = $repository->findBy([], array('id' => 'DESC'), 2, ($page - 1) * 2);
//
//        return $this->render('resident/index.html.twig', [
//            'personnes' => $personnes,
//            'nbPage' => $nbPage
//        ]);
//    }

//    /**
//     * @Route("/edit/{id?0}", name="personne.edit")
//     */
//    public function editPersonne(Request $request, Personne $personne = null, EntityManagerInterface $manager)
//    {
//        if (!$personne) {
//            $personne = new Personne();
//        }
//        $form = $this->createForm(PersonneType::class, $personne);
//        $form->remove('socialMedia');
//        $form->remove('path');
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            if ($form['image']) {
//                $image = $form['image']->getData();
//                $imagePath = md5(uniqid()) . $image->getClientOriginalName();
//                $destination = __DIR__ . '/../../public/assets/uploads';
//                try {
//                    $image->move($destination, $imagePath);
//                    $personne->setPath('assets/uploads/' . $imagePath);
//                } catch (FileException $fe) {
//                    echo $fe;
//                }
//            }
//            $manager->persist($personne);
//            $manager->flush();
//            return $this->redirectToRoute('personne');
//        }
//        return $this->render('personne/edit.html.twig', array(
//            'form' => $form->createView()
//        ));
//    }
}
