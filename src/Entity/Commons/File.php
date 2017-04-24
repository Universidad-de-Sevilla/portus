<?php

namespace US\Portus\Entity\Commons;
use US\Portus\Entity\Person\Person;

/**
 * @Entity
 */
class File
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="US\Portus\Entity\Person\Person")
     * @var Person
     */
    protected $author;

    /**
     */
    protected $container;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $description;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $path;

    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $downloads;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $size;

}