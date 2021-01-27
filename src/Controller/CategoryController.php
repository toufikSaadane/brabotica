<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category", name="category")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        dd($categoryRepository->findAll());
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/add/items")
     */

    public function creat(EntityManagerInterface $em)
    {

        for ($i = 0; $i < 10; $i++) {
            $cat = new Category();
            $cat->setName("cat");
                for ($j = 0; $j < 5; $j++) {
                    $product = new Product();
                    $product->setName("toufik");
                    $product->setDescription("description");
                    $product->setDetails("details");
                    $product->setPrice(876);
                    $cat->addProduct($product);
                    $em->persist($product);
                }
            $em->persist($cat);
        }
        $em->flush();
        dd("ok");
    }
}
