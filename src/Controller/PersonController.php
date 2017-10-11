<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/10/17
 * Time: 16:17
 */

namespace WildTrombi\Controller;


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
}