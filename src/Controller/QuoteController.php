<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use App\Entity\Quote;

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
            # Randomly pick an element from the associative array
            $elem = $arr[mt_rand(0, count($arr) - 1)];

             $id = ($elem["id"]);
             $text = ($elem["text"]);
             $author = ($elem["author"]);

            // print_r("The id is " . " $id ");
            // print_r("The text is " . " $text ");
            // print_r("The author is " . " $author ");
            
             $entityManager = $this->getDoctrine()->getManager();
             $quote = new Quote();
             # Set the id, text and author in the db from the arr
             $quote->setQId($id);
             $quote->setText($text);
             $quote->setAuthor($author);
             # Save the Quote 
            $entityManager->persist($quote);
            # Execute the queries INSERT
            $entityManager->flush();
            # Return the random element in JSON Response
            # return new JsonResponse($elem);
            return $this->json($elem);
         }
                
    }