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
    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * @var integer
     */
    private $duration;

    /**
     * @var \Insta\PlanningBundle\Entity\Room
     */
    private $room;

    /**
     * @var \Insta\PlanningBundle\Entity\Course
     */
    private $course;


    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Lesson
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Lesson
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set promotion
     *
     * @param \Insta\PlanningBundle\Entity\Promotion $promotion
     * @return Lesson
     */
    public function setPromotion(\Insta\PlanningBundle\Entity\Promotion $promotion = null)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return \Insta\PlanningBundle\Entity\Promotion 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set room
     *
     * @param \Insta\PlanningBundle\Entity\Room $room
     * @return Lesson
     */
    public function setRoom(\Insta\PlanningBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Insta\PlanningBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set course
     *
     * @param \Insta\PlanningBundle\Entity\Course $course
     * @return Lesson
     */
    public function setCourse(\Insta\PlanningBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Insta\PlanningBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }
}
