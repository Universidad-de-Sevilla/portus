<?php
/**
 * Portus Project
 * Entity/Person.php
 */

namespace US\Portus\Entity;

/**
 * Class Person
 * Gestiona las personas que actuan como sujetos u objetos de la aplicación
 * 
 * @Entity 
 **/
class Person
{
    /**
     * @Column(type="datetime", nullable=TRUE)
     * @var \DateTime
     */
    protected $birthDate;
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    private $id;
    /**
     * @Column(type="string")
     * @var string
     */
    private $firstName;
    /**
     * @Column(type="string")
     * @var string
     */
    private $lastName;
    /**
     * @Column(type="string")
     * @var EmailAddress
     */
    private $email;
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    private $gender;
    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    private $startDate;
    /**
     * @Column(type="datetime", nullable=TRUE)
     * @var \DateTime
     */
    private $endDate;


    /**
     * @param array $datos
     */
    function __construct($datos)
    {
        $this->firstName = $datos['firstName'];
        $this->lastName = $datos['lastName'];
        $this->email = $datos['email'];
        $this->startDate = $datos['startDate'];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = new EmailAddress($email);
    }

}

