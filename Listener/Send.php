<?php

namespace Copromatic\MailgunAdminBundle\Listener;

use Copromatic\MailgunAdminBundle\Entity\Message;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

class Send implements \Swift_Events_SendListener
{
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
        $this->logger->addAlert('from beforeSend');
        dump($event);
    }

    public function sendPerformed(\Swift_Events_SendEvent $event)
    {
        $message = (new Message())
            ->setMailgunId($event->getMessage()->getHeaders()->get('Message-ID')->getFieldBody())
            ->setOpened(false)
            ->setDelivered(false)
        ;
        $this->em->persist($message);
        $this->em->flush();
    }
}