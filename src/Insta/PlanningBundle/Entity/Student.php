<?php

namespace Insta\PlanningBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Entity
 *
 */
class Student extends User
{


    /**
     * @var boolean
     *
     * @ORM\Column(name="hasComputer", type="boolean")
     */
    protected $hasComputer;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="Promotion")
     * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id")
     */
    protected $promotion;

    /**
     * Set hasComputer
     *
     * @param boolean $hasComputer
     * @return Student
     */
    public function setHasComputer($hasComputer)
    {
        $this->hasComputer = $hasComputer;

        return $this;
    }

    /**
     * Get hasComputer
     *
     * @return boolean 
     */
    public function getHasComputer()
    {
        return $this->hasComputer;
    }
}
