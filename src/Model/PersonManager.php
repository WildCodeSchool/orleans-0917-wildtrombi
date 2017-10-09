<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/10/17
 * Time: 16:38
 */

namespace WildTrombi\Model;


class PersonManager
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USERNAME, PASSWORD);
    }

    public function findAll()
    {
        $req = "SELECT * FROM person";
        $statement = $this->pdo->query($req);

        return $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Person::class);
    }

    public function find(int $id)
    {
        $req = "SELECT * FROM person WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $persons = $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Person::class);
        return $persons[0];
    }

    public function insert()
    {
        // TODO
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