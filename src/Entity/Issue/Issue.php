<?php

namespace US\Portus\Entity\Issue;
use US\Portus\Entity\Person\Person;

/**
 * @Entity
 * @Table (name="Issue")
 **/
class Issue
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="\US\Humanos\Entity\Person\Person", inversedBy="issues")
     * @var Person
     */
    private $author;

    /**
     * @var string
     */
    private $description;

    /**
     * @Column(type="datetime", nullable=TRUE)
     * @var \DateTime
     */
    private $endDate;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    private $startDate;

    /**
     * @Column(type="string")
     * @var string
     */
    private $subject;

    /**
     * Issue constructor.
     * @param Person $author
     * @param string $description
     * @param \DateTime $startDate
     */
    public function __construct(Person $author, $description, \DateTime $startDate)
    {
        $this->author = $author;
        $this->description = $description;
        $this->startDate = $startDate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Person
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Person $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

}