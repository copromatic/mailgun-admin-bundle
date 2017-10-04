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
     * @ORM\Column(name="message_hash", type="string", length=256, nullable=false)
     */
    private $messageHash;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
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
    public function getMessageHash()
    {
        return $this->messageHash;
    }

    /**
     * @param string $messageHash
     * @return Message
     */
    public function setMessageHash($messageHash)
    {
        $this->messageHash = $messageHash;
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