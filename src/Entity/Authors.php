<?php

namespace App\Entity;

use App\Repository\AuthorsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="authors")
 * @ORM\Entity()
 */
class Authors
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string|null
     *
     * @ORM\Column(name="name",type="string")
     */
    private $name;
    /**
     * @var string|null
     *
     * @ORM\Column(name="email",type="string", length=100)
     */
    private $email;

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }    
    public function getEmail(){
        return $this->email;
    }


    public function setName(){
        $this->title=$name;
    } 
    public function setEmail(){
        $this->title=$email;
    } 
}

