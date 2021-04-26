<?php 

// App est le nom pour le chemin vers le dossier SRC (ne varie pas), suivi du nom du dossier
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; // ligne qui est apparut en indiquant le return new Response dans la fonction

class ChanceController {
    
    public function getNumber() {
        $number = rand(0, 100);
        // new Response -> crée une instance de la réponse
        return new Response("<html><body><p>Le numéro de la chance est :  $number </p></body></hmtl>"); 
    }
}