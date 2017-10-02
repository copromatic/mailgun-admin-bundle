<?php

namespace Copromatic\MailgunAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="mailgun_message")
 * @ORM\Entity()
 */
class Message {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="mailgun_id", type="string", length="256", nullable=false)
     */
    private $mailgunId;

    /**
     * @var bool
     *
     * @ORM\Column(name="delivered", type="boolean", nullable=false)
     */
    private $delivered;

    /**
     * @var bool
     *
     * @ORM\Column(name="opened", type="boolean", nullable=false)
     */
    private $opened;

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
    public function getMailgunId()
    {
        return $this->mailgunId;
    }

    /**
     * @param int $mailgunId
     * @return Message
     */
    public function setMailgunId($mailgunId)
    {
        $this->mailgunId = $mailgunId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDelivered()
    {
        return $this->delivered;
    }

    /**
     * @param bool $delivered
     * @return Message
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOpened()
    {
        return $this->opened;
    }

    /**
     * @param bool $opened
     * @return Message
     */
    public function setOpened($opened)
    {
        $this->opened = $opened;
        return $this;
    }
}