<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\DBAL\Types\IdentityTypeType;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

/**
 * Action
 *
 * @ORM\Table(name="action")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActionRepository")
 */
class Action
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var IdentityTypeType
     *
     * @ORM\Column(name="identity_type", type="IdentityTypeType", nullable=false)
     * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\IdentityTypeType")
     */
    private $identityType;

    /**
     * @var string
     *
     * @ORM\Column(name="person_id", type="text", nullable=false)
     */
    private $personId;

    /**
     * @ORM\JoinColumn(nullable=false)
     * @ORM\ManyToOne(targetEntity="ActionCategory", inversedBy="actions", cascade={"persist"})
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer", nullable=true)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="text", nullable=false)
     */
    private $sender;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var bool
     *
     * @ORM\Column(name="cancelled", type="boolean", nullable=false)
     */
    private $cancelled = false;

    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identityType
     *
     * @param IdentityTypeType $identityType
     *
     * @return Action
     */
    public function setIdentityType($identityType)
    {
        $this->identityType = $identityType;

        return $this;
    }

    /**
     * Get identityType
     *
     * @return IdentityTypeType
     */
    public function getIdentityType()
    {
        return $this->identityType;
    }

    /**
     * Set personId
     *
     * @param string $personId
     *
     * @return Action
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return string
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return Action
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Action
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return Action
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Action
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set cancelled
     *
     * @param boolean $cancelled
     *
     * @return Action
     */
    public function setCancelled($cancelled)
    {
        $this->cancelled = $cancelled;

        return $this;
    }

    /**
     * Get cancelled
     *
     * @return boolean
     */
    public function getCancelled()
    {
        return $this->cancelled;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\ActionCategory $category
     *
     * @return Action
     */
    public function setCategory(\AppBundle\Entity\ActionCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\ActionCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
