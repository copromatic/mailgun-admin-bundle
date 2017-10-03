<?php

namespace Copromatic\MailgunAdminBundle\Listener;

use Copromatic\MailgunAdminBundle\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

class Send implements \Swift_Events_SendListener
{
    const MAILGUN_ADMIN_MESSAGE_ID_HEADER = 'mailgun-admin-message-id';

    /** @var EntityManager */
    private $em;

    /** @var Logger */
    private $logger;

    public function __construct($em, $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function beforeSendPerformed(\Swift_Events_SendEvent $event)
    {
        if ($event->getMessage()->getHeaders()->has('Message-ID')) {
            $message = (new Message())
                ->setMailgunId(substr($event->getMessage()->getHeaders()->get('Message-ID')->getFieldBody(), 1, -1))
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