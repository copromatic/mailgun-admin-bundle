<?php

namespace Copromatic\MailgunAdminBundle\Service;

use Copromatic\MailgunAdminBundle\Entity\BounceTrack;
use Copromatic\MailgunAdminBundle\Entity\ClickTrack;
use Copromatic\MailgunAdminBundle\Entity\DeliveryTrack;
use Copromatic\MailgunAdminBundle\Entity\FailureTrack;
use Copromatic\MailgunAdminBundle\Entity\Message;
use Copromatic\MailgunAdminBundle\Entity\OpenTrack;
use Copromatic\MailgunAdminBundle\Entity\UnsubscribeTrack;
use Doctrine\ORM\EntityManager;

class Manager {

    /** @var EntityManager */
    private $em;

    /**
     * Manager constructor.
     * @param EntityManager $em
     */
    public function __construct($em) {
        $this->em = $em;
    }

    /**
     * @param string $hash
     * @return Message
     */
    public function getMessageByHash($hash) {
        return $this->em->getRepository('MailgunAdminBundle:Message')
            ->findBy([
                'messageHash'   => $hash
            ])
        ;
    }

    /**
     * @param Message $message
     * @param $recipient
     * @return BounceTrack[]
     */
    public function getBouncesByMessage(Message $message, $recipient = null) {
        $filters = [
            'message'   => $message
        ];
        if ($recipient) {
            $filters['recipient'] = $recipient;
        }
        return $this->em->getRepository('MailgunAdminBundle:BounceTrack')
            ->findBy($recipient)
        ;
    }

    /**
     * @param Message $message
     * @param $recipient
     * @return ClickTrack[]
     */
    public function getClicksByMessage(Message $message, $recipient = null) {
        $filters = [
            'message'   => $message
        ];
        if ($recipient) {
            $filters['recipient'] = $recipient;
        }
        return $this->em->getRepository('MailgunAdminBundle:ClickTrack')
            ->findBy($recipient)
        ;
    }

    /**
     * @param Message $message
     * @param $recipient
     * @return DeliveryTrack[]
     */
    public function getDeliveriesByMessage(Message $message, $recipient = null) {
        $filters = [
            'message'   => $message
        ];
        if ($recipient) {
            $filters['recipient'] = $recipient;
        }
        return $this->em->getRepository('MailgunAdminBundle:DeliveryTrack')
            ->findBy($recipient)
        ;
    }

    /**
     * @param Message $message
     * @param $recipient
     * @return FailureTrack[]
     */
    public function getFailuresByMessage(Message $message, $recipient = null) {
        $filters = [
            'message'   => $message
        ];
        if ($recipient) {
            $filters['recipient'] = $recipient;
        }
        return $this->em->getRepository('MailgunAdminBundle:FailureTrack')
            ->findBy($recipient)
        ;
    }

    /**
     * @param Message $message
     * @param $recipient
     * @return OpenTrack[]
     */
    public function getOpensByMessage(Message $message, $recipient = null) {
        $filters = [
            'message'   => $message
        ];
        if ($recipient) {
            $filters['recipient'] = $recipient;
        }
        return $this->em->getRepository('MailgunAdminBundle:OpenTrack')
            ->findBy($recipient)
        ;
    }

    /**
     * @param Message $message
     * @param $recipient
     * @return UnsubscribeTrack[]
     */
    public function getUnsubscribesByMessage(Message $message, $recipient = null) {
        $filters = [
            'message'   => $message
        ];
        if ($recipient) {
            $filters['recipient'] = $recipient;
        }
        return $this->em->getRepository('MailgunAdminBundle:UnsubscribeTrack')
            ->findBy($recipient)
        ;
    }
}