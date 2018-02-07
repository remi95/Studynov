<?php

namespace Sy\TutoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tutorial
 *
 * @ORM\Table(name="tutorial")
 * @ORM\Entity(repositoryClass="Sy\TutoBundle\Repository\TutorialRepository")
 */
class Tutorial
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, unique=true)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="editdate", type="date", nullable=true)
     */
    private $editDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fullvisibility", type="boolean")
     */
    private $fullVisibility;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\User", inversedBy="tutorials")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="Sy\MainBundle\Entity\Category", inversedBy="tutorials")
     */
    private $categories;


    /**
     * Constructor
     */
    public function __construct(){
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime();
        $this->editDate = null;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tutorial
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Tutorial
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Tutorial
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set editDate
     *
     * @param \DateTime $editDate
     *
     * @return Tutorial
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;

        return $this;
    }

    /**
     * Get editDate
     *
     * @return \DateTime
     */
    public function getEditDate()
    {
        return $this->editDate;
    }

    /**
     * Set fullVisibility
     *
     * @param boolean $fullVisibility
     *
     * @return Tutorial
     */
    public function setFullVisibility($fullVisibility)
    {
        $this->fullVisibility = $fullVisibility;

        return $this;
    }

    /**
     * Get fullVisibility
     *
     * @return boolean
     */
    public function getFullVisibility()
    {
        return $this->fullVisibility;
    }

    /**
     * Set author
     *
     * @param \Sy\MainBundle\Entity\User $author
     *
     * @return Tutorial
     */
    public function setAuthor(\Sy\MainBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Sy\MainBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add category
     *
     * @param \Sy\MainBundle\Entity\Category $category
     *
     * @return Tutorial
     */
    public function addCategory(\Sy\MainBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Sy\MainBundle\Entity\Category $category
     */
    public function removeCategory(\Sy\MainBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Tutorial
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
