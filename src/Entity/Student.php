<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Student
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @Vich\Uploadable
 */
class Student extends AbstractEntity
{
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
    private $mobileNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $address;

    /**
     * @ORM\Column(type="date", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $unitNumber;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $schoolStartTime;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $educationLevelCompleted;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $raceEthnicity;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $firstGeneration;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $activeMilitary;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="student")
     */
    private $user;

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return Student
     */
    public function setFirstname(?string $firstname): Student
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
     * @return Student
     */
    public function setLastname(?string $lastname): Student
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    /**
     * @param string|null $mobileNumber
     * @return Student
     */
    public function setMobileNumber(?string $mobileNumber): Student
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Student
     */
    public function setEmail(?string $email): Student
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return unserialize($this->address);
    }

    /**
     * @param string|null $address
     * @return Student
     */
    public function setAddress(?string $address): Student
    {
        $this->address = serialize($address);
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateOfBirth(): ?\DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime|null $dateOfBirth
     * @return Student
     */
    public function setDateOfBirth(?\DateTime $dateOfBirth): Student
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getUnitNumber(): ?int
    {
        return $this->unitNumber;
    }

    /**
     * @param int|null $unitNumber
     * @return Student
     */
    public function setUnitNumber(?int $unitNumber): Student
    {
        $this->unitNumber = $unitNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSchoolStartTime(): ?string
    {
        return $this->schoolStartTime;
    }

    /**
     * @param string|null $schoolStartTime
     * @return Student
     */
    public function setSchoolStartTime(?string $schoolStartTime): Student
    {
        $this->schoolStartTime = $schoolStartTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEducationLevelCompleted(): ?string
    {
        return $this->educationLevelCompleted;
    }

    /**
     * @param string|null $educationLevelCompleted
     * @return Student
     */
    public function setEducationLevelCompleted(?string $educationLevelCompleted): Student
    {
        $this->educationLevelCompleted = $educationLevelCompleted;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRaceEthnicity(): ?string
    {
        return $this->raceEthnicity;
    }

    /**
     * @param string|null $raceEthnicity
     * @return Student
     */
    public function setRaceEthnicity(?string $raceEthnicity): Student
    {
        $this->raceEthnicity = $raceEthnicity;
        return $this;
    }

    /**
     * @return boolean|null
     */
    public function getFirstGeneration(): ?bool
    {
        return $this->firstGeneration;
    }

    /**
     * @param boolean|null $firstGeneration
     * @return Student
     */
    public function setFirstGeneration(?bool $firstGeneration): Student
    {
        $this->firstGeneration = $firstGeneration;
        return $this;
    }

    /**
     * @return boolean|null
     */
    public function getActiveMilitary(): ?bool
    {
        return $this->activeMilitary;
    }

    /**
     * @param boolean|null $activeMilitary
     * @return Student
     */
    public function setActiveMilitary(?bool $activeMilitary): Student
    {
        $this->activeMilitary = $activeMilitary;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Student
     */
    public function setUser(User $user): ?Student
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getFullName(): ?string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}