<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/10/17
 * Time: 16:38
 */

namespace WildTrombi\Model;


class PersonManager extends EntityManager
{

    public function findAll()
    {
        $query = "SELECT * FROM person";
        $statement = $this->pdo->query($query);

        return $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Person::class);
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM person WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $persons = $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Person::class);
        return $persons[0];
    }

    public function insert(Person $person)
    {
        $query = "INSERT INTO person 
                  (firstname, lastname, birthdate, category_id) 
                  VALUES (:firstname, :lastname, :birthdate, :category)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('firstname', $person->getFirstname(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $person->getLastname(), \PDO::PARAM_STR);
        $statement->bindValue('birthdate', $person->getBirthdate(), \PDO::PARAM_STR);
        $statement->bindValue('category', $person->getCategory(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function update()
    {
        // TODO
    }

    public function delete()
    {
        // TODO
    }


}