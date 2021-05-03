****************************************
SYMFONY = kernel + composants
****************************************

C'est un framework PHP (cadriciel), une boîte à outils logicielle.
-> CRUD (Create / Read / Update / Delete)

SYMFONY va servir à accélérer/faciliter le développement d'applications PHP.
C'est une boite à outil très complète qui entrecroise plusieurs compétences. 
Un ensemble de composants (components) dont le coeur s'appelle "Kernel" = noyau.
-> On peut installer uniquement le kernel mais son fonctionnement sera limité, il lui faudra d'autres composants.

* Logiciel libre créée en 2009 par Fabien Potencier,
* Actuellement à la v.5.2

*****************************************
            LES COMPOSANTS
*****************************************

- doctrine : va gérer la base de données, un ORM (object Relation Manager) -> dans l'appli SYMFONY on ne connait que l'ORM.
- twig : va servir à faire des templates (gabarit) HTML.
- monolog : outils pour gérer les journaux de logiciels (historique, journaux d'utilisation).
- API : une API est comme un CRUD mais en lien avec URL. ça sert à créer une architecture pour que le dev front puisse accéder à ses données.

On peut utiliser chacuns de ces composants séparemment.

****************************************     
          COMPOSER installation
****************************************

Ces composants sont installés avec un outils PHP -> composer
-> composer s'utilise dans la console (en installant au préalable composer et une console).
-> Pour installer doctrine : 
/////////composer require doctrine ////////// message dans la console pour installer doctrine
Tout programme qui respecte les conventions psr-4 peut être chargé ave composer.


****************************************     
          SYMFONY installation
****************************************

# pour créer une application web
 composer create-project symfony/website-skeleton my_project_name
# pour créer un microservice, console application ou API
composer create-project symfony/skeleton nom_de_mon_projet

****************************************     
          LES REPERTOIRES
****************************************  

/// dossiers ->
- bin : binary, ce sont des fichiers exécutables, des outils pour simplifier (ex: console, phpunit, etc.).
- config : contient les fichiers de configurations de symfony et de ses composants. 
- migrations : doctrine va versionner l'évolution de la structure de la BDD (fichiers PHP).
- public : contiendra tous les fichiers qu'on met en ligne, c'est le dossier qui faudra rendre accessible par le serveur http. il sécurise car en cas d'attaque pirate, seules les pages dans le dossier public seront accessibles.
- src : c'est le code de notre application. C'est dans ce dossier qu'on vient développer. 
- template : dossier qui contiendra les gabarits HTML.
- tests : contient les tests pour tester l'application.
- translations : contient les fichiers pour la traduction.
- var : dossier de fichiers temporaires de symfony (cache et log->journaux).
- vendor : n'est pas un dossier symfony. Dossier lié à composer qui stocke à cet endroit tous les fichiers. 

/// fichiers ->
- .env : fichier de configuration pour notre environnement (connexion à la BDD).
- composer.json : fichier utile à composer pour paramétrer ce package.

/// Flex !
 - /!\ Aucun rapport avec flex de css /!\
 - Flex dans le sens de symfony flex est un logiciel qui sert à l'installation des composants.
 - Les développeurs écrivent des recettes qui expliquent comment s'installent les composants de symfony.


****************************************
           ARCHITECTURE MVC   
****************************************

Une façon d'écrire (patron de conception ou Pattern) du code en séparant 3 éléments : 
- Modèles (model) : L'ensemble du code qui va intéragir avec la BDD
- Vue (view) : L'ensemble qui concerne le rendu visuel
- Contrôleur (controller) : Il est la colle entre le model et la view. Il fait le lien au moyen d'une route et gère aussi l'authentification.

Intérêts : 
- Permet d'organiser le code à plusieurs (ex, pour les intégrateurs, les spécialistes de BDD et les développeurs)
- Optimise les performences : en séparant le code qui requête la BDD, du code qui fait le rendu visuel.

Qu'est ce qu'une route en php, il en exite 5 :
- Légèrement différente d'une URL, c'est juste un morceau d'URL à laquelle va correspondre une action dans notre application.

//////// Exemples de route \\\\\\\\\
-> /artiles : pour récupérer tous les articles
-> /articles/create : pour créer un article
-> /articles/1 : pour afficher l'article 1
-> /articles/1/edit : pour mofifier l'article 1
-> /articles/1/delete : pour supprimer l'article 1

Pour créer une route, il y a plusieurs façons, nous utiliserons principalement celle des anotations.

Pour utiliser les annotations dans le controller :
1 / installer le paquet annotations 'composer require annotations'
2/ utiliser un commentaire miltiligne pour donner une @Route
3/ debug avec php bin/console debug:router 
4/ voir ArticlesController.php

 ****************************************     
          DEBUG
****************************************

Pour débuger on va utiliser essentiellement deux fonctions :
* dd()      -> dump and die : formater et avec des outils qui tuent la mort
* dump()    ->  s'affiche dans le profiler (petite cible) avec des outils de recherches

Quelques outils :
- la couleur (coloration syntaxique)
- outil de repli des propriétés
- recherche avec `ctrl + f` -> chercher des propriétés puis `echap`
- Ce composant s'installe grâce à `composer req symfony/var-dumper`

****************************************
           ENTITE   
****************************************
Une table sera représentée par une classe dans Symfony.
Les propriétés vont représenter les champs de la table.

3 façons de créer une table :

1/ Version compliquée, on se prend la tête : avec recherche dans la doc /!\  
        * Créer une nouvelle classe dans entity et l'annoter avec @ORM\ENtity
        * Dans cette classe on créera nos intitulés de colonnes que l'on définiera grâce aux annotations
        * On fait un getter pour l'id et un getter et un setter pour les autres intitulés de colonnes 
        * Aller dans la console et taper `php bin/console doctrine:schema:update --force`

2/ Version moins compliquée mais pas propre quand même
        * dans la console on met : ` php bin/console make:entity`
        * la console nous propose de créer les colonnes et de leur donner une valeur (pas besoin de l'index / ajouter automatiquement)
        * on vérifie ce qu'il y a dans notre page qui a été créée 
        * Aller dans la console et taper `php bin/console doctrine:schema:update --force`

3/ Version moins compliquée et propre
        * dans la console on met : ` php bin/console make:entity`
        * la console nous propose de créer les colonnes et de leur donner une valeur (pas besoin de l'index / ajouter automatiquement)
        * on vérifie ce qu'il y a dans notre page qui a été créée 
        * Aller dans la console et taper `php bin/console make:migration`
        * Vérifier la classe créée
        * Lancer dans la console : `php bin/console doctrine:migrations:migrate` ou pour les feignasses : `php bin/console d:m:m`


---> REPOSITORY
À coté de l'entité est créé un repository qui servira à contenir les fonctions de recherche dans la base de données.

---> INJECTION DE DÉPENDANCES (dependanty injection)
Lorsque l'on travaille dans le contrôleur on aura besoin de nombreux outils externes :
- l'outil de la recherche en BDD (repository)
- l'outil d'envoi de mail (mailer)
- l'outil pour hasher les mots de passe, etc.

Dans symfony, on accède facilement à ces instances grâce à l'injection des dépendances.
Il suffit d'écrire le type et un nom de variable dans la méthode. Si Symfony connait ce type, 
il l'instanciera et le fournira.
Quans Symfony met en relation nos fonctions et ses dépendances, on parle de autowiring.

La liste complète des dépendances utilisables : 
- php bin/console debug::autowiring

# CRÉATION D'UNE TABLE Bidule (en Symfony, s'appelle une entité)
1. s'assurer que la base de données est bien configurée
2. lancer `php bin/console make:entity Bidule`
3. répondre aux questions : nom de la propriété, type (appuyer sur ? pour voir les types), taille, nullable
4. Appuyer sur Entrée pour quitter les questions
5. lancer php bin/console make:migration pour fabriquer le fichier de migration
6. lancer `php bin/console doctrine:migrations:migration` pour appliquer la/les migrations

Note : il est possible de compléter une entité en reprenant l'étape 2