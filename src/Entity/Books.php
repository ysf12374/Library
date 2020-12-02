<?php

namespace App\Entity;

use App\Repository\AuthorsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="books")
 * @ORM\Entity()
 */
class Books
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
     * @ORM\Column(name="title",type="string")
     */
    private $title;
    /**
     *
     * @ORM\Column(name="authors",type="array")
     */
    private $authors;

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }    
    public function getAuthors(){
        return $this->authors;
    }


    public function setTitle($title){
        $this->title=$title;
    }    
    public function setAuthors($aths){
        if ($aths){
            $this->authors = new ArrayCollection($aths);
        }
        else{
            $this->authors = new ArrayCollection();
        }
        
    }
}

