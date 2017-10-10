<?php

namespace Copromatic\MailgunAdminBundle\Controller;

use Copromatic\MailgunAdminBundle\Entity\BounceTrack;
use Copromatic\MailgunAdminBundle\Entity\ClickTrack;
use Copromatic\MailgunAdminBundle\Entity\DeliveryTrack;
use Copromatic\MailgunAdminBundle\Entity\FailureTrack;
use Copromatic\MailgunAdminBundle\Entity\OpenTrack;
use Copromatic\MailgunAdminBundle\Entity\SpamComplaintTrack;
use Copromatic\MailgunAdminBundle\Listener\Send;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller {

    protected function checkAccessOrException(Request $request){
        $parameters = $request->request->all();

        if (!isset($parameters['timestamp']) || !isset($parameters['token']) || !isset($parameters['signature'])) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(406, 'Wrong signature');
        }
        if (!$this->get('mailgun_admin.security')->verify($parameters['token'], $parameters['timestamp'], $parameters['signature'])) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(406, 'Wrong signature');
        }
    }
    protected function findMessageOrException(Request $request){
        $parameters = $request->request->all();

        $message = null;
        if(isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])){
            $message = $this->get('mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
        }elseif(isset($parameters[Send::MAILGUN_MESSAGE_ID_HEADER])){
            $message = $this->get('mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->findOneByMessageHash($parameters[Send::MAILGUN_MESSAGE_ID_HEADER])
            ;
        }

        if (!$message) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(406, 'Message Id not found');
        }

        return $message;
    }

    protected function flushAndResponse($entity){
        $this->get('mailgun_admin.entity_manager')->persist($entity);
        $this->get('mailgun_admin.entity_manager')->flush();

        return new Response();
    }

    public function bounceAction(Request $request) {
        $this->checkAccessOrException($request);

        $message = $this->findMessageOrException($request);

        $parameters = $request->request->all();
        $bounceTrack = (new BounceTrack())
            ->setMessage($message)
            ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
            ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
            ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
            ->setCode(isset($parameters['code']) ? $parameters['code'] : null)
            ->setError(isset($parameters['error']) ? $parameters['error'] : null)
            ->setNotification(isset($parameters['notification']) ? $parameters['notification'] : null)
            ->setCampaignId(isset($parameters['campaign-id']) ? $parameters['campaign-id'] : null)
            ->setCampaignName(isset($parameters['campaign-name']) ? $parameters['campaign-name'] : null)
            ->setTag(isset($parameters['tag']) ? $parameters['tag'] : null)
            ->setMailingList(isset($parameters['mailing-list']) ? $parameters['mailing-list'] : null)
        ;

        return $this->flushAndResponse($bounceTrack);
    }

    public function deliverAction(Request $request) {
        $this->checkAccessOrException($request);

        $message = $this->findMessageOrException($request);

        $parameters = $request->request->all();
        $deliveryTrack = (new DeliveryTrack())
            ->setMessage($message)
            ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
            ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
            ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
        ;

        return $this->flushAndResponse($deliveryTrack);
    }

    public function dropAction(Request $request) {
        $this->checkAccessOrException($request);

        $message = $this->findMessageOrException($request);

        $parameters = $request->request->all();
        $failureTrack = (new FailureTrack())
            ->setMessage($message)
            ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
            ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
            ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
            ->setReason(isset($parameters['reason']) ? $parameters['reason'] : null)
            ->setCode(isset($parameters['code']) ? $parameters['code'] : null)
            ->setDescription(isset($parameters['description']) ? $parameters['description'] : null)
        ;

        return $this->flushAndResponse($failureTrack);
    }

    public function spamAction(Request $request) {
        $this->checkAccessOrException($request);

        $message = $this->findMessageOrException($request);

        $parameters = $request->request->all();
        $spamComplaintTrack = (new SpamComplaintTrack())
            ->setMessage($message)
            ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
            ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
            ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
            ->setCampaignId(isset($parameters['campaign-id']) ? $parameters['campaign-id'] : null)
            ->setCampaignName(isset($parameters['campaign-name']) ? $parameters['campaign-name'] : null)
            ->setTag(isset($parameters['tag']) ? $parameters['tag'] : null)
            ->setMailingList(isset($parameters['mailing-list']) ? $parameters['mailing-list'] : null)
        ;

        return $this->flushAndResponse($spamComplaintTrack);
    }

    public function clickAction(Request $request) {
        $this->checkAccessOrException($request);

        $message = $this->findMessageOrException($request);

        $parameters = $request->request->all();
        $clickTrack = (new ClickTrack())
            ->setMessage($message)
            ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
            ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
            ->setIp(isset($parameters['ip']) ? $parameters['ip'] : null)
            ->setCountry(isset($parameters['country']) ? $parameters['country'] : null)
            ->setRegion(isset($parameters['region']) ? $parameters['region'] : null)
            ->setCity(isset($parameters['city']) ? $parameters['city'] : null)
            ->setUserAgent(isset($parameters['user-agent']) ? $parameters['user-agent'] : null)
            ->setDeviceType(isset($parameters['device-type']) ? $parameters['device-type'] : null)
            ->setClientType(isset($parameters['client-type']) ? $parameters['client-type'] : null)
            ->setClientName(isset($parameters['client-name']) ? $parameters['client-name'] : null)
            ->setClientOs(isset($parameters['client-os']) ? $parameters['client-os'] : null)
            ->setCampaignId(isset($parameters['campaign-id']) ? $parameters['campaign-id'] : null)
            ->setCampaignName(isset($parameters['campaign-name']) ? $parameters['campaign-name'] : null)
            ->setTag(isset($parameters['tag']) ? $parameters['tag'] : null)
            ->setMailingList(isset($parameters['mailing-list']) ? $parameters['mailing-list'] : null)
        ;

        return $this->flushAndResponse($clickTrack);
    }

    public function openAction(Request $request) {
        $this->checkAccessOrException($request);

        $message = $this->findMessageOrException($request);

        $parameters = $request->request->all();
        $openTrack = (new OpenTrack())
            ->setMessage($message)
            ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
            ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
            ->setIp(isset($parameters['ip']) ? $parameters['ip'] : null)
            ->setCountry(isset($parameters['country']) ? $parameters['country'] : null)
            ->setRegion(isset($parameters['region']) ? $parameters['region'] : null)
            ->setCity(isset($parameters['city']) ? $parameters['city'] : null)
            ->setUserAgent(isset($parameters['user-agent']) ? $parameters['user-agent'] : null)
            ->setDeviceType(isset($parameters['device-type']) ? $parameters['device-type'] : null)
            ->setClientType(isset($parameters['client-type']) ? $parameters['client-type'] : null)
            ->setClientName(isset($parameters['client-name']) ? $parameters['client-name'] : null)
            ->setClientOs(isset($parameters['client-os']) ? $parameters['client-os'] : null)
            ->setCampaignId(isset($parameters['campaign-id']) ? $parameters['campaign-id'] : null)
            ->setCampaignName(isset($parameters['campaign-name']) ? $parameters['campaign-name'] : null)
            ->setTag(isset($parameters['tag']) ? $parameters['tag'] : null)
            ->setMailingList(isset($parameters['mailing-list']) ? $parameters['mailing-list'] : null)
        ;

        return $this->flushAndResponse($openTrack);
    }
}
