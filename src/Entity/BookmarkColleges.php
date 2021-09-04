<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BookmarkColleges
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\BookmarkCollegesRepository")
 */
class BookmarkColleges extends AbstractEntity
{
    /**
     * @ORM\Column(name="college_id", type="bigint", options={"unsigned":true})
     */
    private $collegeId;

    /**
     * @ORM\Column(name="user_id", type="bigint", options={"unsigned":true})
     */
    private $userId;

    /**
     * @return integer
     */
    public function getCollegeId(): int
    {
        return $this->collegeId;
    }

    /**
     * @param integer $collegeId
     */
    public function setCollegeId(int $collegeId): void
    {
        $this->collegeId = $collegeId;
    }

    /**
     * @return integer
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}