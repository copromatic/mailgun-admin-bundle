<?php

namespace Copromatic\MailgunAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="mailgun_track_spam_complaints")
 * @ORM\Entity()
 */
class SpamComplaintTrack
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
     * @var string
     *
     * @ORM\Column(name="campaign_id", type="string", length=64)
     */
    private $campaignId;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_name", type="string", length=512)
     */
    private $campaignName;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=64)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="mailing_list", type="string", length=128)
     */
    private $mailingList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
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
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
     */
    public function setMessageHeaders($messageHeaders)
    {
        $this->messageHeaders = $messageHeaders;
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
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
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
     * @return SpamComplaintTrack
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}