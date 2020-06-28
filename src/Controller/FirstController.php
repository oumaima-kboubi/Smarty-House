<?php

namespace App\Controller;

use App\Entity\User;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/first", name="first")
     */
    public function index()
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin", name="first.admin")
     */
    public function admin()
    {
        return $this->render('admin.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/home", name="first.home")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/test", name="first.test")
     */
    public function test()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
         return $this->render('admin.html.twig');
        elseif ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        return $this->render('home.html.twig');
        else return $this->redirectToRoute( 'fos_user_security_login' );

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/testy", name="first.testy")
     */
    public function testy()
    {
        return $this->render('privacyPolicyOut.html.twig');
    }

    /**
     * @param Request $request
     * @Route("/confirm/{id?0}", name="first.confirm")
     */
    public function confirmOwner(\Symfony\Component\HttpFoundation\Request $request)
    {
        $id = $request->get('id');
        $userManager = $this->getDoctrine()->getManager();
        $userRepository = $userManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['id' => $id]);
        if (!$user->hasRole("ROLE_OWNER")) {
            $user->addRole("ROLE_OWNER");
            $userManager->persist($user);
            $userManager->flush();
        }
        return $this->redirectToRoute('first.home');
    }
}
