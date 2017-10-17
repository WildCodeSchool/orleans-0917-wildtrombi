<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 17/10/17
 * Time: 14:49
 */

namespace WildTrombi\Model;


class CategoryManager extends EntityManager
{
    public function findAll()
    {
        $query = "SELECT * FROM category";
        $statement = $this->pdo->query($query);

        return $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Category::class);
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM category WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $categories = $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Category::class);
        return $categories[0];
    }


}