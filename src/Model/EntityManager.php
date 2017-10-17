<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 17/10/17
 * Time: 14:50
 */

namespace WildTrombi\Model;


class EntityManager
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USERNAME, PASSWORD);
    }

}