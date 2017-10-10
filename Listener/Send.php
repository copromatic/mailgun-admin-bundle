<?php

namespace Copromatic\MailgunAdminBundle\Listener;

use Copromatic\MailgunAdminBundle\Entity\Message;
use Doctrine\ORM\EntityManager;

class Send implements \Swift_Events_SendListener
{
    const MAILGUN_ADMIN_MESSAGE_ID_HEADER = 'mailgun-admin-message-id';
    const MAILGUN_MESSAGE_ID_HEADER = 'Message-Id';

    /** @var EntityManager */
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function beforeSendPerformed(\Swift_Events_SendEvent $event)
    {
        if ($event->getMessage()->getHeaders()->has('Message-ID')) {
            $message = (new Message())
                ->setMessageHash($event->getMessage()->getHeaders()->get('Message-ID')->getFieldBody())
                ->setCreated(new \DateTime())
            ;
            $this->em->persist($message);
            $this->em->flush();

            $event->getMessage()
                ->getHeaders()
                ->addTextHeader(
                    'X-Mailgun-Variables',
                    json_encode([
                        self::MAILGUN_ADMIN_MESSAGE_ID_HEADER => $message->getId()
                    ])
                )
            ;
        }
    }

    public function sendPerformed(\Swift_Events_SendEvent $event){}
}