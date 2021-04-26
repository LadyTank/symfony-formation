<?php 
 
 namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ArticlesController {
     public function index() {
         return new Response("<html><body>
         <h1>Liste des articles</h1>
         </body></html>");
     }
 }