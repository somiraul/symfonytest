<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Roles;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    public function userFormview(){
        $role = $this->getDoctrine()
                     ->getRepository(Roles::class)
                     ->findAll();

        return $this->render('view/userForm.html.twig', array('role' => $role));
    }

    public function submitUser(Request $request){
        if ($request->getMethod() == 'POST'){
            $data  = $request->request->all();
            $entityManager = $this->getDoctrine()->getManager();

            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRole($data['role'][0]);
            $user->setSecretQuestion($data['secretQuestion']);
            $user->setSecretAnswer($data['secretAnswer']);

            $entityManager->persist($user);
            $entityManager->flush();

            return new Response("Successfully Added to database");
        }
    }

    public function userLoginForm(){
        return $this->render('user/userLoginForm.html.twig');
    }

    public function userLogin(Request $request){
        $data = $request->request->all();
        var_dump($data);
        die();
    }
}
