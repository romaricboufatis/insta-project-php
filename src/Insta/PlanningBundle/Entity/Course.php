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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionLink", type="string", length=255)
     */
    private $descriptionLink;

    /**
     * @var array
     *
     * @ORM\Column(name="variousLinks", type="array")
     */
    private $variousLinks;

    /**
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Teacher", mappedBy="courses")
     **/
    protected  $teachers;

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
}
