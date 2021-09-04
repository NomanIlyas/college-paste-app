<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 * @package AppBundle\Entity
 */
abstract class AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updated;

    /**
     * @ORM\Column( name = "status", type="boolean", options={"default"=true, "comment":"0 => InActive, 1 => Active"})
     */
    protected $status = true;

    public function __construct()
    {
        $this->created= new \DateTime();
        $this->updated= new \DateTime();
    }

    /**
     * @return string
     */
    public function toString()
    {
        if (method_exists($this, '__toString')) {
            return $this->__toString();
        }
        return get_class($this);
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return AbstractEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
