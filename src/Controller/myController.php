<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class myController extends AbstractController
{
    public function index()
    {
    	return $this->render('view/index.html.twig');
    }
}