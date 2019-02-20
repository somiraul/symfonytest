<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Roles;


use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UserController extends AbstractController
{
    public function userFormview(){
        $role = $this->getDoctrine()
                     ->getRepository(Roles::class)
                     ->findAll();

        return $this->render('view/userForm.html.twig', array('role' => $role));
    }

    public function submitUser(Request $request){
            $test = $request->request->all();
            var_dump($test);
            die();
        if ($request->getMethod() == 'POST'){
            $data  = $request->request->all();

            $normalizer = [
                new ObjectNormalizer(),
            ];

            $encoders = [
                new JsonEncoder(),
            ];

            $serializer = new Serializer($normalizer, $encoders);

            $serializedData = $serializer->serialize($data, 'json');

            var_dump($serializedData);
            die();
            return $this->json($data);
        }
    }
}
