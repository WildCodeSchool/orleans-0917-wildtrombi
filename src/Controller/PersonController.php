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

class PersonController
{
    public function showAllAction()
    {
        $personManager = new PersonManager();
        $persons = $personManager->findAll();

        require '../src/View/Person/showAll.php';

    }

    public function showOneAction($id)
    {
        $personManager = new PersonManager();
        $person = $personManager->find($id);

        require '../src/View/Person/showOne.php';
    }
}