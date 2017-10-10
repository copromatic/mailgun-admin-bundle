<?php

namespace Copromatic\MailgunAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="mailgun_track_bounces")
 * @ORM\Entity()
 */
class BounceTrack
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

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
     * @ORM\Column(name="recipient", type="string", length=512, nullable=true)
     */
    private $recipient;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=128, nullable=true)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="message_headers", type="json_array", length=16, nullable=true)
     */
    private $messageHeaders;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=64, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="text", nullable=true)
     */
    private $error;

    /**
     * @var string
     *
     * @ORM\Column(name="notification", type="text", nullable=true)
     */
    private $notification;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_id", type="string", length=64, nullable=true)
     */
    private $campaignId;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_name", type="string", length=512, nullable=true)
     */
    private $campaignName;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=64, nullable=true)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="mailing_list", type="string", length=128, nullable=true)
     */
    private $mailingList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->created =  new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     * @return BounceTrack
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
     * @return BounceTrack
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
     * @return BounceTrack
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
     * @return BounceTrack
     */
    public function setMessageHeaders($messageHeaders)
    {
        $this->messageHeaders = $messageHeaders;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return BounceTrack
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return BounceTrack
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param string $notification
     * @return BounceTrack
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * @return string
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @param string $campaignId
     * @return BounceTrack
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCampaignName()
    {
        return $this->campaignName;
    }

    /**
     * @param string $campaignName
     * @return BounceTrack
     */
    public function setCampaignName($campaignName)
    {
        $this->campaignName = $campaignName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return BounceTrack
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return string
     */
    public function getMailingList()
    {
        return $this->mailingList;
    }

    /**
     * @param string $mailingList
     * @return BounceTrack
     */
    public function setMailingList($mailingList)
    {
        $this->mailingList = $mailingList;
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
     * @return BounceTrack
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}