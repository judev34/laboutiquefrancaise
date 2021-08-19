<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request): Response
    {
        // J'ai commenté l'ancienne façon de filtrer
        // $search = new Search();
        // $form = $this->createForm(SearchType::class, $search);
        // $form->handleRequest($request);

        // on recupère les filtres
        $filters = $request->get("categories");
        

        // On vérifie si on a une requete ajax
        if ($request->get('ajax')) {
            return "OK";
        }
        $products = $this->entityManager->getRepository(Product::class)->findWithSearch($filters);
        // dd($products);    
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
            
            // $products = $this->entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'categories' => $categories,
            'products' => $products
            // 'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug)
    {


        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if (!$product) {
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
