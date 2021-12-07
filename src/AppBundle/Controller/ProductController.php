<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/add", name="product_add")
     */
    public function addAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            echo 'SUCCESS';
            // return $this->redirectToRoute('product_add');
        }

        return $this->render('@App/Product/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
