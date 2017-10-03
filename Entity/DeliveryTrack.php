<?php

namespace Copromatic\MailgunAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="mailgun_track_deliveries")
 * @ORM\Entity()
 */
class DeliveryTrack
{
    /**
     * @var Message
     *
     * @ORM\ManyToOne(targetEntity="Copromatic\MailgunAdminBundle\Entity\Message")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="recipient", type="string", length=512)
     */
    private $recipient;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=128)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="message_headers", type="json_array", length=16)
     */
    private $messageHeaders;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recipient", type="datetime")
     */
    private $created;

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     * @return DeliveryTrack
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return DeliveryTrack
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return DeliveryTrack
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageHeaders()
    {
        return $this->messageHeaders;
    }

    /**
     * @param string $messageHeaders
     * @return DeliveryTrack
     */
    public function setMessageHeaders($messageHeaders)
    {
        $this->messageHeaders = $messageHeaders;
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
     * @return DeliveryTrack
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}