<?php

namespace App\Controller;

use App\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JoueurRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JoueurController extends AbstractController
{
    /**
     * @Route("/api/joueurs", name="index_joueurs", methods={"GET"})
     */
    public function index_joueur(JoueurRepository $joueurRepository): Response {
        $donnees = $joueurRepository->findAll();

        $response = new Response();

        if(count($donnees) == 0){
            return new JsonResponse([
                "code" => 1,
                "message" => "Aucun joueur enregistrĂ©.",
                "resultat" => null
            ], Response::HTTP_NOT_FOUND);
        }
        
        $joueurs = $this->container->get('serializer')->serialize($donnees, 'json');

        $response->setContent($joueurs);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/api/joueur/create", methods={"GET"})
     */
    public function createJoueur(Request $request, ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $response = new Response();
        // $data = $request->request->all();
        $data = $request->query->all();

        $joueur =  new Joueur();
        $joueur->setFullName($data["full_name"]);
        $joueur->setBirthday(new DateTime($data["birthday"]));
        $joueur->setPosition($data["position"]);

        $request_client = (array) json_decode(HttpClient::create()->request('GET', 'https://flagcdn.com/fr/codes.json')->getContent());
        $test = 0;
        foreach ($request_client as $key => $value) {
            if ($value == $data["nationality"]) {
                $joueur->setNationality("https://flagcdn.com/96x72/".$key.".png");
                $test = 1;
            }
        }

        if ($test == 0) {
            return new JsonResponse([
                "code" => 1,
                "message" => "Pays inconnu.",
                "resultat" => null
            ], Response::HTTP_NOT_FOUND);
        }
        
        $em->persist($joueur);
        $em->flush();

        $joueur = $this->container->get('serializer')->serialize($joueur, 'json');
        $response->setContent($joueur);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    
    /**
     * @Route("/api/joueur/edit/{id}", methods={"GET"})
     */
    public function editJoueur(Request $request, int $id, ManagerRegistry $doctrine, JoueurRepository $joueurRepository): Response {
        $response = new Response();
        $em = $doctrine->getManager();
        $joueur = $joueurRepository->find($id);
        // $data = $request->request->all();
        $data = $request->query->all();
        
        if(!$joueur){
            return new JsonResponse([
                "code" => 1,
                "message" => 'Aucun joueur trouvĂ© pour l\'id : '.$id,
                "resultat" => null
            ], Response::HTTP_NOT_FOUND);
        }
        
        $joueur->setFullName($data["full_name"]);
        $joueur->setBirthday(new DateTime($data["birthday"]));
        $joueur->setPosition($data["position"]);
        $joueur->setAppearances($data["appearances"]);
        $joueur->setGoals($data["goals"]);
        $joueur->setAssists($data["assists"]);

        $request_client = (array) json_decode(HttpClient::create()->request('GET', 'https://flagcdn.com/fr/codes.json')->getContent());
        $test = 0;
        foreach ($request_client as $key => $value) {
            if ($value == $data["nationality"]) {
                $joueur->setNationality("https://flagcdn.com/96x72/".$key.".png");
                $test = 1;
            }
        }

        if ($test == 0) {
            return new JsonResponse([
                "code" => 1,
                "message" => "Pays inconnu.",
                "resultat" => null
            ], Response::HTTP_NOT_FOUND);
        }

        $em->persist($joueur);
        $em->flush();

        $joueur = $this->container->get('serializer')->serialize($joueur, 'json');
        $response->setContent($joueur);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
    
    /**
     * @Route("/api/joueur/delete/{id}", methods={"GET"})
     */
    public function deleteJoueur(Request $request, ManagerRegistry $doctrine, JoueurRepository $joueurRepository, int $id) {
        $em = $doctrine->getManager();
        $donnees = $joueurRepository->find($id);
        
        if(!$donnees){
            return new JsonResponse([
                "code" => 1,
                "message" => 'Aucun joueur trouvĂ© pour l\'id : '.$id,
                "resultat" => null
            ], Response::HTTP_NOT_FOUND);
        }
        
        $em->remove($donnees);
        $em->flush();

        $joueur = $this->container->get('serializer')->serialize($donnees, 'json');

        $response = new Response();
        $response->setContent($joueur);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/api/joueur/{id}", name="show_joueur", methods={"GET"})
     */
    public function show_one(JoueurRepository $joueurRepository, int $id): Response {
        $donnees = $joueurRepository->find($id);

        $response = new Response();

        if(!$donnees){
            return new JsonResponse([
                "code" => 1,
                "message" => 'Aucun joueur trouvĂ© pour l\'id : '.$id,
                "resultat" => null
            ], Response::HTTP_NOT_FOUND);
        }

        $joueur = $this->container->get('serializer')->serialize($donnees, 'json');

        $response->setContent($joueur);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
