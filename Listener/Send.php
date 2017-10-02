<?php

namespace Copromatic\MailgunAdminBundle\Listener;

use Monolog\Logger;

class Send implements \Swift_Events_SendListener
{
    /** @var Logger */
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function beforeSendPerformed(\Swift_Events_SendEvent $event)
    {
        $this->logger->addAlert('from beforeSend');
        dump($event);
    }

    public function sendPerformed(\Swift_Events_SendEvent $event)
    {
        $this->logger->addAlert('from sendPerformed');
        dump($event);
    }
}