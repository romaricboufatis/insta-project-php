<?php

namespace Insta\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lesson
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Lesson extends Schedule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // ...
    /**
     * @ORM\ManyToOne(targetEntity="Promotion", inversedBy="lessons")
     * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id")
     **/

    protected $promotion;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
