<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CollegeInfo
 * @package App\Entity
 */
class CollegeInfo extends AbstractEntity
{
    #Student Demographics
    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $americanIndianOrAlaskanNative;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $asian;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $blackOrAfricanAmerica;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $hispanicOrLatino;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $nativeHawaiianOrOtherPacificIslander;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $white;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $twoOrMoreRaces;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $unknownRace;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $nonResidentAlien;


    #Graduation time lines
    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $fourYear;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $fiveYear;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $sixYear;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $eightYear;

    #Undergraduate Distance Education
    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $onlyDistanceEducation;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $someDistanceEducation;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    protected $notEnrolledDistanceEducation;

    /**
     * @return integer
     */
    public function getAmericanIndianOrAlaskanNative(): ?int
    {
        return $this->americanIndianOrAlaskanNative;
    }

    /**
     * @param integer $americanIndianOrAlaskanNative
     * @return CollegeInfo
     */
    public function setAmericanIndianOrAlaskanNative(?int $americanIndianOrAlaskanNative): self
    {
        $this->americanIndianOrAlaskanNative = $americanIndianOrAlaskanNative;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAsian(): ?int
    {
        return $this->asian;
    }

    /**
     * @param integer $asian
     * @return CollegeInfo
     */
    public function setAsian(?int $asian): self
    {
        $this->asian = $asian;
        return $this;
    }

    /**
     * @return integer
     */
    public function getBlackOrAfricanAmerica(): ?int
    {
        return $this->blackOrAfricanAmerica;
    }

    /**
     * @param integer $blackOrAfricanAmerica
     * @return CollegeInfo
     */
    public function setBlackOrAfricanAmerica(?int $blackOrAfricanAmerica): self
    {
        $this->blackOrAfricanAmerica = $blackOrAfricanAmerica;
        return $this;
    }

    /**
     * @return integer
     */
    public function getHispanicOrLatino(): ?int
    {
        return $this->hispanicOrLatino;
    }

    /**
     * @param integer $hispanicOrLatino
     * @return CollegeInfo
     */
    public function setHispanicOrLatino(?int $hispanicOrLatino): self
    {
        $this->hispanicOrLatino = $hispanicOrLatino;
        return $this;
    }

    /**
     * @return integer
     */
    public function getNativeHawaiianOrOtherPacificIslander(): ?int
    {
        return $this->nativeHawaiianOrOtherPacificIslander;
    }

    /**
     * @param integer $nativeHawaiianOrOtherPacificIslander
     * @return CollegeInfo
     */
    public function setNativeHawaiianOrOtherPacificIslander(?int $nativeHawaiianOrOtherPacificIslander): self
    {
        $this->nativeHawaiianOrOtherPacificIslander = $nativeHawaiianOrOtherPacificIslander;
        return $this;
    }

    /**
     * @return integer
     */
    public function getWhite(): ?int
    {
        return $this->white;
    }

    /**
     * @param integer $white
     * @return CollegeInfo
     */
    public function setWhite(?int $white): self
    {
        $this->white = $white;
        return $this;
    }

    /**
     * @return integer
     */
    public function getTwoOrMoreRaces(): ?int
    {
        return $this->twoOrMoreRaces;
    }

    /**
     * @param integer $twoOrMoreRaces
     * @return CollegeInfo
     */
    public function setTwoOrMoreRaces(?int $twoOrMoreRaces): self
    {
        $this->twoOrMoreRaces = $twoOrMoreRaces;
        return $this;
    }

    /**
     * @return integer
     */
    public function getUnknownRace(): ?int
    {
        return $this->unknownRace;
    }

    /**
     * @param integer $unknownRace
     * @return CollegeInfo
     */
    public function setUnknownRace(?int $unknownRace): self
    {
        $this->unknownRace = $unknownRace;
        return $this;
    }

    /**
     * @return integer
     */
    public function getNonResidentAlien(): ?int
    {
        return $this->nonResidentAlien;
    }

    /**
     * @param integer $nonResidentAlien
     * @return CollegeInfo
     */
    public function setNonResidentAlien(?int $nonResidentAlien): self
    {
        $this->nonResidentAlien = $nonResidentAlien;
        return $this;
    }

    /**
     * @return integer
     */
    public function getFourYear(): ?int
    {
        return $this->fourYear;
    }

    /**
     * @param integer $fourYear
     * @return CollegeInfo
     */
    public function setFourYear(?int $fourYear): self
    {
        $this->fourYear = $fourYear;
        return $this;
    }

    /**
     * @return integer
     */
    public function getFiveYear(): ?int
    {
        return $this->fiveYear;
    }

    /**
     * @param integer $fiveYear
     * @return CollegeInfo
     */
    public function setFiveYear(?int $fiveYear): self
    {
        $this->fiveYear = $fiveYear;
        return $this;
    }

    /**
     * @return integer
     */
    public function getSixYear(): ?int
    {
        return $this->sixYear;
    }

    /**
     * @param integer $sixYear
     * @return CollegeInfo
     */
    public function setSixYear(?int $sixYear): self
    {
        $this->sixYear = $sixYear;
        return $this;
    }

    /**
     * @return integer
     */
    public function getEightYear(): ?int
    {
        return $this->eightYear;
    }

    /**
     * @param integer $eightYear
     * @return CollegeInfo
     */
    public function setEightYear(?int $eightYear): self
    {
        $this->eightYear = $eightYear;
        return $this;
    }

    /**
     * @return integer
     */
    public function getOnlyDistanceEducation(): ?int
    {
        return $this->onlyDistanceEducation;
    }

    /**
     * @param integer $onlyDistanceEducation
     * @return CollegeInfo
     */
    public function setOnlyDistanceEducation(?int $onlyDistanceEducation): self
    {
        $this->onlyDistanceEducation = $onlyDistanceEducation;
        return $this;
    }

    /**
     * @return integer
     */
    public function getSomeDistanceEducation(): ?int
    {
        return $this->someDistanceEducation;
    }

    /**
     * @param integer $someDistanceEducation
     * @return CollegeInfo
     */
    public function setSomeDistanceEducation(?int $someDistanceEducation): self
    {
        $this->someDistanceEducation = $someDistanceEducation;
        return $this;
    }

    /**
     * @return integer
     */
    public function getNotEnrolledDistanceEducation(): ?int
    {
        return $this->notEnrolledDistanceEducation;
    }

    /**
     * @param integer $notEnrolledDistanceEducation
     * @return CollegeInfo
     */
    public function setNotEnrolledDistanceEducation(?int $notEnrolledDistanceEducation): self
    {
        $this->notEnrolledDistanceEducation = $notEnrolledDistanceEducation;
        return $this;
    }
}