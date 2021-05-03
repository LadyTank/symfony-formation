<?php

// App est le nom pour le chemin vers le dossier SRC (ne varie pas), suivi du nom du dossier
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response; // ligne qui est apparut en indiquant le return new Response dans la fonction

class ChanceController
{
    // la route vers ce controler est défini dans config/routes.yaml
    public function getNumber()
    {
        $number = rand(0, 100);
        // new Response -> crée une instance de la réponse
        return new Response("<html><body><p>Le numéro de la chance est :  $number </p></body></hmtl>");
    }

    /**
     * @Route(path="/chance/analyse", name="chance_analyse")
     */
    public function analyseRequete(Request $requete)
    {

        dump($requete);
        // s'installe grâce à 'composer req symfony/var-dumper'
        return new Response("<html><body>
        <p>Contenu de la requête dans le dump (barre d'outil)</p>
            <form method=\"POST\" action=\"/requete_post\">
                <input type=\"text\" value=\"Audrey\" name=\"prenom\">
                <input type=\"submit\">
            </form>
        </body></hmtl>");
    }
}
