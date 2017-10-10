# Install de composer
composer init
composer install

# Mise en place de l'autoload 
## manuellement via spl_autoload_register
spl_autoload_register(function($class) {
    $class = str_replace('WildTrombi', 'src', $class);
    $class = str_replace('\\', '/', $class);
    require '../' . $class.'.php';
});

## via l'autoload PSR4 de composer (recommandé)
    "autoload" : {
        "psr-4": {
            "WildTrombi\\" : "src/"
        }
    },
    
suivi d'un dump-autoload
et d'un require "../vendor/autoload.php";   


# Model

Instancier PDO et requete select* from Person
fetchAll() dans array

puis creation de
Person.php 
- construct / properties
- getters/setters

et fetchAll(\PDO::FETCH_CLASS, Person::class);
=> récupération du résultat de la requete PDO dans un objet Person

Création d'un PersonManager, permet de gérer les requetes sur Person
    - findAll
    - findOne
    - insert / update / delete


# Controller 
PersonController.php
- method showAction()
    - création d'un objet Model\Person
    - return $persons
    
dans index.php, instanciation de PersonController
- appel de showAction()
- affichage des personnes;

mise en forme HTML (listes ou thumbnails) dans le controlleur pour l'instant
    
=> on ajoute du HTML, donc on n'a plus de séparation php/html => il faut donc une vue

# View

On met le code HTML créé dans le controlleur dans un fichier View/Person/show.php
et on fait un require du fichier de la vue dans le controlleur

    require '../src/View/Person/show.html;

# Router
    On saisi une URL qui va appeler une méthode d'un controlleur
    On passe un paramètre $_GET['route'] et d'autre param optionnel dans la query string de l'URL
    Tout passe par l'index.php, entrée UNIQUE du site
    ex : http://localhost:8000/index.php?route=persons
    La route persons instancie PersonController et appelle la méthode showAll

####### 

# À venir 

    - insert / select / delete 
    - extend le PersonManager par une EntityManager
    - faire tout le CRUD
## Renderer 
    foreach ($params as $key=>$value) {
            $$key = $value;
        }

    ob_start();
    require '../src/View/Person/show.html;
    $content = ob_get_clean();
    return $content;
    
## Twig
    Mise en place
    
## Router 
    - créer une classe
    - utilisation de fastRoute ?
## Request / Response
    - Class Request
    - PSR-7

