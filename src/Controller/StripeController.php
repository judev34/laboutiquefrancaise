<?php

namespace App\Controller;

use App\Classe\Cart;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    /**
     * @Route("/create-session", name="stripe_create_session")
     */
    public function index(Cart $cart)
    {
        $product_for_stripe = [];
        $MY_DOMAIN = 'http://127.0.0.1.8000';

        foreach ($cart->getFull() as $product) {
            $product_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product['product']->getName(),
                        'images' => [$MY_DOMAIN."/uploads/".$product['product']->getIllustration()],
                    ],
                    'unit_amount' => $product['product']->getPrice(),
                ],
                'quantity' => $product['quantity'],
            ];
        }

        Stripe::setApiKey('sk_test_51IgUy1FEFeuyOANnAxDWTJSZlg3FahNlcj51tHOjM9Ip4RHA4H48TJJ0vXPZQeV5ZpfJ6dDZWbkoQg1XmcfGF9H200NBvmtzAq');

        $MY_DOMAIN = 'http://127.0.0.1.8000';

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $product_for_stripe
            ],
            'mode' => 'payment',
            'success_url' => $MY_DOMAIN .'/success.html',
            'cancel_url' => $MY_DOMAIN .'/cancel.html',
        ]);
        
        $response = new JsonResponse(['id' => $checkout_session->id ]);
        return $response;

    }
}
