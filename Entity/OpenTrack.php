<?php

namespace Copromatic\MailgunAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="mailgun_track_opens")
 * @ORM\Entity()
 */
class OpenTrack
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
     * @ORM\Column(name="ip", type="string", length=16)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=8)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=128)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=128)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=256)
     */
    private $userAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="device_type", type="string", length=8)
     */
    private $deviceType;

    /**
     * @var string
     *
     * @ORM\Column(name="client_type", type="string", length=64)
     */
    private $clientType;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=32)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_os", type="string", length=32)
     */
    private $clientOs;

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
     * @return OpenTrack
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
     * @return OpenTrack
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
     * @return OpenTrack
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return OpenTrack
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return OpenTrack
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return OpenTrack
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return OpenTrack
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     * @return OpenTrack
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }

    /**
     * @param string $deviceType
     * @return OpenTrack
     */
    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientType()
    {
        return $this->clientType;
    }

    /**
     * @param string $clientType
     * @return OpenTrack
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     * @return OpenTrack
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientOs()
    {
        return $this->clientOs;
    }

    /**
     * @param string $clientOs
     * @return OpenTrack
     */
    public function setClientOs($clientOs)
    {
        $this->clientOs = $clientOs;
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
     * @return OpenTrack
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
     * @return OpenTrack
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
     * @return OpenTrack
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
     * @return OpenTrack
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
     * @return OpenTrack
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}