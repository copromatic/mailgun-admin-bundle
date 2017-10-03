<?php

namespace Copromatic\MailgunAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="mailgun_messages")
 * @ORM\Entity()
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mailgun_id", type="string", length=256, nullable=false)
     */
    private $mailgunId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recipient", type="datetime")
     */
    private $created;

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
    public function getMailgunId()
    {
        return $this->mailgunId;
    }

    /**
     * @param string $mailgunId
     * @return Message
     */
    public function setMailgunId($mailgunId)
    {
        $this->mailgunId = $mailgunId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return Message
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}