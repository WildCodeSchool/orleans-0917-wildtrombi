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


        return $this->twig->render('Person/showAll.html.twig', [
            'persons' => $persons,

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

        // creation d'un objet person vide
        $person = new Person();
        $errors = [];

        if (!empty($_POST)) {
            $person = $this->addOrUpdateAction($person);
            $errors = $this->checkError();

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
            'errors'     => $errors,
            'categories' => $categories,
            'person'     => $person,
        ]);

    }

    private function addOrUpdateAction(Person $person)
    {
        // traitement des erreurs éventuelles
        $person->setFirstname($_POST['firstname']);
        $person->setLastname($_POST['lastname']);
        $person->setBirthdate($_POST['birthdate']);
        $person->setCategory($_POST['category']);

        return $person;

    }

    private function checkError()
    {
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

        return $errors;
    }


    public function deleteAction()
    {
        if (!empty($_POST['id'])) {
            $personManager = new PersonManager();
            $person = $personManager->find($_POST['id']);
            $personManager->delete($person);
            header('Location: index.php?route=showAll');
        }
    }

    public function updateAction()
    {
        $errors = [];
        $personManager = new PersonManager();

        if (!empty($_POST)) {
            $person = $personManager->find($_POST['id']);
            $person = $this->addOrUpdateAction($person);

            $errors = $this->checkError();

            // si pas d'erreur, insert en bdd
            if (empty($errors)) {

                $personManager = new PersonManager();
                $personManager->update($person);

                header('Location: index.php?route=showAll');
            }
        } else {
            $person = $personManager->find($_GET['id']);
        }


        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return $this->twig->render('Person/add.html.twig', [
            'errors'     => $errors,
            'categories' => $categories,
            'person'     => $person,
        ]);

    }
}