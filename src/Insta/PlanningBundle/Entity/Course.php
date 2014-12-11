<?php

namespace Insta\PlanningBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Course
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionLink", type="string", length=255, nullable=true)
     */
    protected $descriptionLink;

    /**
     * @var array
     *
     * @ORM\Column(name="variousLinks", type="array")
     */
    protected $variousLinks;

    /**
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Teacher", mappedBy="courses")
     **/
    protected  $teachers;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="course")
     */
    protected $lessons;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Oral", mappedBy="course")
     */
    protected $orals;



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
     * Set name
     *
     * @param string $name
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Course
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set descriptionLink
     *
     * @param string $descriptionLink
     * @return Course
     */
    public function setDescriptionLink($descriptionLink)
    {
        $this->descriptionLink = $descriptionLink;

        return $this;
    }

    /**
     * Get descriptionLink
     *
     * @return string 
     */
    public function getDescriptionLink()
    {
        return $this->descriptionLink;
    }

    /**
     * Set variousLinks
     *
     * @param array $variousLinks
     * @return Course
     */
    public function setVariousLinks($variousLinks)
    {
        $this->variousLinks = $variousLinks;

        return $this;
    }

    /**
     * Get variousLinks
     *
     * @return array 
     */
    public function getVariousLinks()
    {
        return $this->variousLinks;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->variousLinks = array();
    }

    /**
     * Add teachers
     *
     * @param Teacher $teachers
     * @return Course
     */
    public function addTeacher(Teacher $teachers)
    {
        $this->teachers[] = $teachers;

        return $this;
    }

    /**
     * Remove teachers
     * @param Teacher $teachers
     */
    public function removeTeacher(Teacher $teachers)
    {
        $this->teachers->removeElement($teachers);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    public function  getTeacherNames()
    {
        $teachernames=array();
        foreach($this->teachers as $teacher)
        {
            $teachernames[]=$teacher->getFullname();
        }
        return $teachernames;
    }

    /**
     * Add lessons
     *
     * @param \Insta\PlanningBundle\Entity\Lesson $lessons
     * @return Course
     */
    public function addLesson(\Insta\PlanningBundle\Entity\Lesson $lessons)
    {
        $this->lessons[] = $lessons;

        return $this;
    }

    /**
     * Remove lessons
     *
     * @param \Insta\PlanningBundle\Entity\Lesson $lessons
     */
    public function removeLesson(\Insta\PlanningBundle\Entity\Lesson $lessons)
    {
        $this->lessons->removeElement($lessons);
    }

    /**
     * Get lessons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLessons()
    {
        return $this->lessons;
    }

    /**
     * Add orals
     *
     * @param \Insta\PlanningBundle\Entity\Oral $orals
     * @return Course
     */
    public function addOral(\Insta\PlanningBundle\Entity\Oral $orals)
    {
        $this->orals[] = $orals;

        return $this;
    }

    /**
     * Remove orals
     *
     * @param \Insta\PlanningBundle\Entity\Oral $orals
     */
    public function removeOral(\Insta\PlanningBundle\Entity\Oral $orals)
    {
        $this->orals->removeElement($orals);
    }

    /**
     * Get orals
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrals()
    {
        return $this->orals;
    }
}
