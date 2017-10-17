<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/10/17
 * Time: 16:17
 */

namespace WildTrombi\Controller;


use WildTrombi\Model\CategoryManager;
use WildTrombi\Model\Person;
use WildTrombi\Model\PersonManager;

class PersonController extends Controller
{

    public function showAllAction()
    {
        $personManager = new PersonManager();
        $persons = $personManager->findAll();

        $categoryManager = new CategoryManager();

        foreach($persons as $person) {
            $category = $categoryManager->find($person->getCategory());
            $personCategories[] = ['person'=>$person, 'category'=>$category];
        }

        return $this->twig->render('Person/showAll.html.twig', [
            'personCategories' => $personCategories,

        ]);
    }

    public function showOneAction($id)
    {
        $personManager = new PersonManager();
        $person = $personManager->find($id);

        return $this->twig->render('Person/showOne.html.twig', [
            'person' => $person,
        ]);
    }

    public function addAction()
    {
        // récupérer $_POST et traiter
        $errors = [];
        // creation d'un objet person vide
        $person = new Person();

        if (!empty($_POST)) {
            // traitement des erreurs éventuelles
            $person->setFirstname($_POST['firstname']);
            $person->setLastname($_POST['lastname']);
            $person->setBirthdate($_POST['birthdate']);
            $person->setCategory($_POST['category']);


            if (empty($_POST['firstname'])) {
                $errors[] = 'Firstname is required';
            } elseif (strlen($_POST['firstname']) < 3) {
                $errors[] = 'Firstname should be at least 3 characters';
            }

            if (empty($_POST['lastname'])) {
                $errors[] = 'Lastname is required';
            }

            if (empty($_POST['category'])) {
                $errors[] = 'Category is required';
            }

            // si pas d'erreur, insert en bdd
            if (empty($errors)) {

                $personManager = new PersonManager();
                $personManager->insert($person);

                header('Location: index.php?route=showAll');
            }

        }

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return $this->twig->render('Person/add.html.twig', [
            'errors' => $errors,
            'categories' => $categories,
            'person' => $person,
        ]);

    }
}