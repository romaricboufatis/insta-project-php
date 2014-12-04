<?php

namespace Insta\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\MappedSuperclass
 */
class Schedule
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    protected $datetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    protected $duration;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    protected $room;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="Course")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */
    protected $course;

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Schedule
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
     * @return Schedule
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
     * Set room
     *
     * @param Room $room
     * @return Schedule
     */
    public function setRoom(Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set course
     *
     * @param Course $course
     * @return Schedule
     */
    public function setCourse(Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }
}
