<?php

namespace Insta\PlanningBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Entity(repositoryClass="ScheduleRepository")
 * @ORM\Table(name="schedules")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"lesson" = "Lesson", "oral" = "Oral"})
 */
class Schedule
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getEndDatetime() {

        $endDate = clone $this->datetime;
        $endDate->modify('+' . $this->duration . ' minutes');
        return $endDate;

    }

}
