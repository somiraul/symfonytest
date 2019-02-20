<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProductController extends AbstractController
{

    public function index(){
    	$product = $this->getDoctrine()
				        ->getRepository(Product::class)
				        ->findAll();

		return $this->render('view/products.html.twig', array('data' => $product)); 
    }

    public function add(Request $data){
        if ($data->getMethod() == 'POST') {         
            $datas = $data->request->all();
            $entityManager = $this->getDoctrine()->getManager();
           
            $product = new Product();
            $product->setName($datas["prod_name"]);
            $product->setQuantity($datas["qty"]);
            $product->setPrice($datas["price"]);
           
            $entityManager->persist($product);
            $entityManager->flush();

            return new Response("Success even it did fail LOL");

        } else {
            return new Response("The method used to add data is invalid");
        }

    }

    public function show($id){
    	$product = $this->getDoctrine()
				        ->getRepository(Product::class)
				        ->find($id);

		 return new Response('This Product has a name of '.$product->getName().' and has and ID of '.$product->getId());

    }

    public function addview(){
        return $this->render('view/addproducts.html.twig');
    }

   public function testform(Request $request){
        $product = new Product();

        $form = $this->createFormBuilder($product)
                     ->add('name', TextType::class)
                     ->add('quantity', NumberType::class)
                     ->add('price', NumberType::class, ['attr' => array( 'class' => 'form-control'), 'label' => 'WithCLass' ])
                     ->add('submit', SubmitType::class, ['label' => 'SaveBtn'])
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product');
        }

        return $this->render('view/testform.html.twig', ['form' => $form->createView()]);
   }

   public function getTest(){
        return new Response("Get Ajax Succeed");
   }
}
