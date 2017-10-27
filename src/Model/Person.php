<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/10/17
 * Time: 16:07
 */

namespace WildTrombi\Model;


class Person
{
    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $category_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Person
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     * @return Person
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        if ($this->category_id) {
            $categoryManager = new CategoryManager();
            $category = $categoryManager->find($this->category_id);

            return $category;
        }
    }

    /**
     * @param mixed $category
     * @return Person
     */
    public function setCategory($category)
    {
        $this->category_id = $category;

        return $this;
    }

    public function getName()
    {
        return ucfirst($this->getFirstname()) . ' ' . strtoupper($this->getLastname());
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}
