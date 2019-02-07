<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class QuoteController extends AbstractController {
        /**
         * @Route("/api/motd", name="app_motd")
         */

         # The controller is the motd method
         public function motd(){
            # Get the contents of the json file
             $quotesJson = file_get_contents('../public/quotes.json');
            # Convert the json to a php array
            $arr = json_decode($quotesJson, true);
            # Randomly pick and element from the array
            $elem = $arr[mt_rand(0, count($arr) - 1)];
            # Rturn the random element in json
             return new JsonResponse($elem);
         }
    }