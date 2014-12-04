<?php

namespace Insta\PlanningBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Oral
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Oral extends Schedule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Student", mappedBy="orals")
     **/
    protected $students;

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
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Oral
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
     * @return Oral
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
     * Add students
     *
     * @param \Insta\PlanningBundle\Entity\Student $students
     * @return Oral
     */
    public function addStudent(\Insta\PlanningBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \Insta\PlanningBundle\Entity\Student $students
     */
    public function removeStudent(\Insta\PlanningBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set room
     *
     * @param \Insta\PlanningBundle\Entity\Room $room
     * @return Oral
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
     * @return Oral
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
