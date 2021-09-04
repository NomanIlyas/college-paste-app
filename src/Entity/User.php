<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $primaryNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $secondaryNumber;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $landmark;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $accessToken;

    /**
     * @var string
     * @ORM\Column(type="bigint", nullable=true, options={"unsigned":true})
     */
    private $expiresAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\College", mappedBy="user", cascade={"remove"})
     */
    private $college;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", mappedBy="user", cascade={"remove"})
     */
    private $student;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function __toString() {
        return $this->username;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return User
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param $expiresAt
     * @return $this
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    /**
     * @return array
     */
    public function getShowRoles()
    {
        return $this->roles;
    }

    /**
     * @return College
     */
    public function getCollege()
    {
        return $this->college;
    }

    /**
     * @param College $college
     * @return User
     */
    public function setCollege(College $college): User
    {
        $this->college = $college;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return unserialize($this->address);
    }

    /**
     * @param string|null $address
     * @return User
     */
    public function setAddress(?string $address): User
    {
        $this->address = serialize($address);
        return $this;
    }

    /**
     * @return string
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param string $area
     * @return User
     */
    public function setArea(string $area): User
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return User
     */
    public function setFirstname(?string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return User
     */
    public function setLastname(?string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrimaryNumber(): ?string
    {
        return $this->primaryNumber;
    }

    /**
     * @param string|null $primaryNumber
     * @return User
     */
    public function setPrimaryNumber(?string $primaryNumber): User
    {
        $this->primaryNumber = $primaryNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryNumber(): ?string
    {
        return $this->secondaryNumber;
    }

    /**
     * @param string $secondaryNumber
     * @return User
     */
    public function setSecondaryNumber(string $secondaryNumber): User
    {
        $this->secondaryNumber = $secondaryNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return User
     */
    public function setRegion(string $region): User
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getLandmark(): ?string
    {
        return $this->landmark;
    }

    /**
     * @param string $landmark
     * @return User
     */
    public function setLandmark(string $landmark): User
    {
        $this->landmark = $landmark;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return User
     */
    public function setState(string $state): User
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     * @return User
     */
    public function setStudent(Student $student): User
    {
        $this->student = $student;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getFullName() : ?string
    {
       return $this->firstname . ' ' . $this->lastname;
    }
}