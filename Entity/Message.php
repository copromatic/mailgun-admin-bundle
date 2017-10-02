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
     * @var string
     *
     * @ORM\Column(name="mailgun_id", type="string", length=256, nullable=false)
     */
    private $mailgunId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bounce", type="datetime", nullable=true)
     */
    private $bounce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliver", type="datetime", nullable=true)
     */
    private $deliver;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="drop", type="datetime", nullable=true)
     */
    private $drop;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="spam", type="datetime", nullable=true)
     */
    private $spam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="click", type="datetime", nullable=true)
     */
    private $click;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="open", type="datetime", nullable=true)
     */
    private $open;

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
    public function getBounce()
    {
        return $this->bounce;
    }

    /**
     * @param \DateTime $bounce
     * @return Message
     */
    public function setBounce($bounce)
    {
        $this->bounce = $bounce;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliver()
    {
        return $this->deliver;
    }

    /**
     * @param \DateTime $deliver
     * @return Message
     */
    public function setDeliver($deliver)
    {
        $this->deliver = $deliver;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDrop()
    {
        return $this->drop;
    }

    /**
     * @param \DateTime $drop
     * @return Message
     */
    public function setDrop($drop)
    {
        $this->drop = $drop;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSpam()
    {
        return $this->spam;
    }

    /**
     * @param \DateTime $spam
     * @return Message
     */
    public function setSpam($spam)
    {
        $this->spam = $spam;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getClick()
    {
        return $this->click;
    }

    /**
     * @param \DateTime $click
     * @return Message
     */
    public function setClick($click)
    {
        $this->click = $click;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * @param \DateTime $open
     * @return Message
     */
    public function setOpen($open)
    {
        $this->open = $open;
        return $this;
    }
}