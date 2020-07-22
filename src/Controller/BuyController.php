<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Payment;
use App\Entity\Buy;


class BuyController extends GenericController
{
    /**
     * @Route("/buy", name="buy")
     */
    public function index()
    {
        return $this->render('buy/index.html.twig', [
            'controller_name' => 'BuyController',
        ]);
    }


    /**
     * @Route("/compras/iniciar", name="startBuy")
     */
    public function registerNewBuy()
    {
        ///>>>>>>>>>> nose puede iniciar una compra si no se finalizo la anterior <<<<<<
         

        $payment = $this->paymentService->findId(1);
                    //"compra1","descripcion","modpagoId"
        $buy = new Buy("compra1","descripcion de compra",$payment);

        $this->buyService->save($buy);
        //register Buy in session
        $this->session->set('currentBuy', $buy );

        return $this->render('buy/index.html.twig', [ 'controller_name' => 'BuyController',   ]);
    }

    /**
     * @Route("/compras/finalizar", name="closeBuy")
     */
    public function finalizeNewBuy()
    {   //eliminar la session de la compra
        $this->session->remove("currentBuy");
        //redireccionar
        return $this->render('buy/index.html.twig', [ 'controller_name' => 'BuyController', ]);
    }

    //>>>>>>>>>>>>>><< agregar funcion de perdidas <<<<<<<<<<<

}
