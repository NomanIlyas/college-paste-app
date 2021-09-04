<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Question
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question extends AbstractEntity
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $questionText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $questionCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $questionType;

    /**
     * @ORM\Column(type="array", nullable=true, options={"collation":"utf8mb4_unicode_ci"})
     */
    private $answers;

    /**
     * @return string
     */
    public function getQuestionText(): ?string
    {
        return $this->questionText;
    }

    /**
     * @param string $questionText
     * @return Question
     */
    public function setQuestionText(string $questionText): self
    {
        $this->questionText = $questionText;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuestionCategory(): ?string
    {
        return $this->questionCategory;
    }

    /**
     * @param string $questionCategory
     * @return Question
     */
    public function setQuestionCategory(string $questionCategory): self
    {
        $this->questionCategory = $questionCategory;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuestionType(): ?string
    {
        return $this->questionType;
    }

    /**
     * @param string $questionType
     * @return Question
     */
    public function setQuestionType(string $questionType): self
    {
        $this->questionType = $questionType;

        return $this;
    }

    /**
     * @return array
     */
    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    /**
     * @param array $answers
     * @return Question
     */
    public function setAnswers(array $answers): self
    {
        $this->answers = $answers;

        return $this;
    }
}