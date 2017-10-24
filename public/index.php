<?php
require '../connect.php';
require '../vendor/autoload.php';

// Routeur basique, necessite une url index.php?route=xxx
$route = $_GET['route'];
// On appelle une methode d'un controlleur en fonction de la route saisie en URL
if ($route == 'showAll') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->showAllAction();
} elseif ($route == 'showOne') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->showOneAction($_GET['id']);
} elseif ($route == 'addPerson') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->addAction();
} elseif ($route == 'deletePerson') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->deleteAction();
} elseif ($route == 'updatePerson') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->updateAction();

}

else {
    echo 'La page n\'existe pas';
}









