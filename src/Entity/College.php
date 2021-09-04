<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class College
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\CollegeRepository")
 * @Vich\Uploadable
 */
class College extends CollegeInfo
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $schoolName;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $schoolLogo;

    /**
     * @Vich\UploadableField(mapping="school_logos", fileNameProperty="schoolLogo")
     * @var File
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $schoolImageUrl;

    /**
     * @Vich\UploadableField(mapping="school_images", fileNameProperty="schoolImageUrl")
     * @var File
     */
    private $schoolImageThumbnail;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $schoolNumber;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $schoolType;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    private $totalEnrollment;

    /**
     * @ORM\Column(type="bigint", nullable=true, options={"collation":"utf8mb4_unicode_ci", "unsigned":true})
     */
    private $totalExpenses;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $acceptanceRate;

    /**
     * @ORM\Column(type="array", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $awardsOffered;

    /**
     * @ORM\Column(type="array", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $programsMajors;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $studentToFacultyRatio;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $SATEvidenceBasedReadingAndWriting;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $SATMath;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $ACTComposite;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $ACTEnglish;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $ACTMath;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $financialAid;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $campusSetting;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $modeOfTransportation;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $religiousAssociation;

    /**
     * @ORM\Column(type="text", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $undergraduateDistanceEducation;

    /**
     * @ORM\Column(type="array", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $sport;

    /**
     * @ORM\Column(type="array", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $clubActivities;

    /**
     * @ORM\Column(type="array", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $collegeCategory;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $region;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $website;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $request;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $apply;

    /**
     * @ORM\Column(type="string", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $visit;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="college")
    */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $state;

    /**
     * @return string
     */
    public function getSchoolName(): ?string
    {
        return $this->schoolName;
    }

    /**
     * @param string|null $schoolName
     * @return College
     */
    public function setSchoolName(?string $schoolName): College
    {
        $this->schoolName = $schoolName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSchoolLogo(): ?string
    {
        return $this->schoolLogo;
    }

    /**
     * @param string|null $schoolLogo
     * @return College
     */
    public function setSchoolLogo(?string $schoolLogo): College
    {
        $this->schoolLogo = $schoolLogo;
        return $this;
    }

    /**
     * @return File
     */
    public function getThumbnail(): ?File
    {
        return $this->thumbnail;
    }

    /**
     * @param File $thumbnail
     * @return College
     */
    public function setThumbnail(File $thumbnail): College
    {
        $this->thumbnail = $thumbnail;

        if ($thumbnail) {
            $this->updated = new \DateTime();
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSchoolImageUrl(): ?string
    {
        return $this->schoolImageUrl;
    }

    /**
     * @param string|null $schoolImageUrl
     * @return College
     */
    public function setSchoolImageUrl(?string $schoolImageUrl): College
    {
        $this->schoolImageUrl = $schoolImageUrl;
        return $this;
    }

    /**
     * @return File
     */
    public function getSchoolImageThumbnail(): ?File
    {
        return $this->schoolImageThumbnail;
    }

    /**
     * @param File $schoolImageThumbnail
     * @return College
     */
    public function setSchoolImageThumbnail(File $schoolImageThumbnail): College
    {
        $this->schoolImageThumbnail = $schoolImageThumbnail;

        if ($schoolImageThumbnail) {
            $this->updated = new \DateTime();
        }

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
     * @param string $address
     * @return College
     */
    public function setAddress(string $address): College
    {
        $this->address = serialize($address);
        return $this;
    }

    /**
     * @return string
     */
    public function getSchoolNumber(): ?string
    {
        return $this->schoolNumber;
    }

    /**
     * @param string $schoolNumber
     * @return College
     */
    public function setSchoolNumber(string $schoolNumber): College
    {
        $this->schoolNumber = $schoolNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getSchoolType(): ?string
    {
        return $this->schoolType;
    }

    /**
     * @param string $schoolType
     * @return College
     */
    public function setSchoolType(string $schoolType): College
    {
        $this->schoolType = $schoolType;
        return $this;
    }

    /**
     * @return integer
     */
    public function getTotalEnrollment(): ?int
    {
        return $this->totalEnrollment;
    }

    /**
     * @param integer $totalEnrollment
     * @return College
     */
    public function setTotalEnrollment(int $totalEnrollment): College
    {
        $this->totalEnrollment = $totalEnrollment;
        return $this;
    }

    /**
     * @return integer
     */
    public function getTotalExpenses(): ?int
    {
        return $this->totalExpenses;
    }

    /**
     * @param string $totalExpenses
     * @return College
     */
    public function setTotalExpenses(?string $totalExpenses): College
    {
        $this->totalExpenses = $totalExpenses;
        return $this;
    }

    /**
     * @return string
     */
    public function getAcceptanceRate(): ?string
    {
        return $this->acceptanceRate;
    }

    /**
     * @param string $acceptanceRate
     * @return College
     */
    public function setAcceptanceRate(?string $acceptanceRate): College
    {
        $this->acceptanceRate = $acceptanceRate;
        return $this;
    }

    /**
     * @return array
     */
    public function getAwardsOffered(): ?array
    {
        return $this->awardsOffered;
    }

    /**
     * @param array $awardsOffered
     * @return College
     */
    public function setAwardsOffered(array $awardsOffered): College
    {
        $this->awardsOffered = $awardsOffered;
        return $this;
    }

    /**
     * @return array
     */
    public function getProgramsMajors(): ?array
    {
        return $this->programsMajors;
    }

    /**
     * @param array $programsMajors
     * @return College
     */
    public function setProgramsMajors(array $programsMajors): College
    {
        $this->programsMajors = $programsMajors;
        return $this;
    }

    /**
     * @return string
     */
    public function getStudentToFacultyRatio(): ?string
    {
        return $this->studentToFacultyRatio;
    }

    /**
     * @param string $studentToFacultyRatio
     * @return College
     */
    public function setStudentToFacultyRatio(?string $studentToFacultyRatio): College
    {
        $this->studentToFacultyRatio = $studentToFacultyRatio;
        return $this;
    }

    /**
     * @return string
     */
    public function getSATEvidenceBasedReadingAndWriting(): ?string
    {
        return $this->SATEvidenceBasedReadingAndWriting;
    }

    /**
     * @param string $SATEvidenceBasedReadingAndWriting
     * @return College
     */
    public function setSATEvidenceBasedReadingAndWriting(?string $SATEvidenceBasedReadingAndWriting): College
    {
        $this->SATEvidenceBasedReadingAndWriting = $SATEvidenceBasedReadingAndWriting;
        return $this;
    }

    /**
     * @return string
     */
    public function getSATMath(): ?string
    {
        return $this->SATMath;
    }

    /**
     * @param string $SATMath
     * @return College
     */
    public function setSATMath(?string $SATMath): College
    {
        $this->SATMath = $SATMath;
        return $this;
    }

    /**
     * @return string
     */
    public function getACTComposite(): ?string
    {
        return $this->ACTComposite;
    }

    /**
     * @param string $ACTComposite
     * @return College
     */
    public function setACTComposite(?string $ACTComposite): College
    {
        $this->ACTComposite = $ACTComposite;
        return $this;
    }

    /**
     * @return string
     */
    public function getACTEnglish(): ?string
    {
        return $this->ACTEnglish;
    }

    /**
     * @param string $ACTEnglish
     * @return College
     */
    public function setACTEnglish(?string $ACTEnglish): College
    {
        $this->ACTEnglish = $ACTEnglish;
        return $this;
    }

    /**
     * @return string
     */
    public function getACTMath(): ?string
    {
        return $this->ACTMath;
    }

    /**
     * @param string $ACTMath
     * @return College
     */
    public function setACTMath(?string $ACTMath): College
    {
        $this->ACTMath = $ACTMath;
        return $this;
    }

    /**
     * @return string
     */
    public function getFinancialAid(): ?string
    {
        return $this->financialAid;
    }

    /**
     * @param string $financialAid
     * @return College
     */
    public function setFinancialAid(?string $financialAid): College
    {
        $this->financialAid = $financialAid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCampusSetting(): ?string
    {
        return $this->campusSetting;
    }

    /**
     * @param string $campusSetting
     * @return College
     */
    public function setCampusSetting(?string $campusSetting): College
    {
        $this->campusSetting = $campusSetting;
        return $this;
    }

    /**
     * @return string
     */
    public function getModeOfTransportation(): ?string
    {
        return unserialize($this->modeOfTransportation);
    }

    /**
     * @param string $modeOfTransportation
     * @return College
     */
    public function setModeOfTransportation(?string $modeOfTransportation): College
    {
        $this->modeOfTransportation = serialize($modeOfTransportation);
        return $this;
    }

    /**
     * @return string
     */
    public function getReligiousAssociation(): ?string
    {
        return $this->religiousAssociation;
    }

    /**
     * @param string $religiousAssociation
     * @return College
     */
    public function setReligiousAssociation(?string $religiousAssociation): College
    {
        $this->religiousAssociation = $religiousAssociation;
        return $this;
    }

    /**
     * @return string
     */
    public function getUndergraduateDistanceEducation(): ?string
    {
        return unserialize($this->undergraduateDistanceEducation);
    }

    /**
     * @param string $undergraduateDistanceEducation
     * @return College
     */
    public function setUndergraduateDistanceEducation(?string $undergraduateDistanceEducation): College
    {
        $this->undergraduateDistanceEducation = serialize($undergraduateDistanceEducation);
        return $this;
    }

    /**
     * @return array
     */
    public function getSport(): ?array
    {
        return $this->sport;
    }

    /**
     * @param array $sport
     * @return College
     */
    public function setSport(array $sport): College
    {
        $this->sport = $sport;
        return $this;
    }

    /**
     * @return array
     */
    public function getClubActivities(): ?array
    {
        return $this->clubActivities;
    }

    /**
     * @param array $clubActivities
     * @return College
     */
    public function setClubActivities(array $clubActivities): College
    {
        $this->clubActivities = $clubActivities;
        return $this;
    }

    /**
     * @return array
     */
    public function getCollegeCategory(): ?array
    {
        return $this->collegeCategory;
    }

    /**
     * @param array $collegeCategory
     * @return College
     */
    public function setCollegeCategory(array $collegeCategory): College
    {
        $this->collegeCategory = $collegeCategory;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * @return College
     */
    public function setWebsite(?string $website): College
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequest(): ?string
    {
        return $this->request;
    }

    /**
     * @param string $request
     * @return College
     */
    public function setRequest(?string $request): College
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return string
     */
    public function getApply(): ?string
    {
        return $this->apply;
    }

    /**
     * @param string $apply
     * @return College
     */
    public function setApply(?string $apply): College
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * @return string
     */
    public function getVisit(): ?string
    {
        return $this->visit;
    }

    /**
     * @param string $visit
     * @return College
     */
    public function setVisit(?string $visit): College
    {
        $this->visit = $visit;
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
     * @return College
     */
    public function setUser(User $user): College
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return College
     */
    public function setEmail(?string $email): College
    {
        $this->email = $email;
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
     * @return College
     */
    public function setRegion(?string $region): College
    {
        $this->region = $region;
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
     * @return College
     */
    public function setState(?string $state): College
    {
        $this->state = $state;
        return $this;
    }
}