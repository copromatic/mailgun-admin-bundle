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

    public function bounceAction(Request $request) {
        $parameters = $request->request->all();
        if (isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])) {
            $message = $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
            if ($message) {
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
                    ->setCreated(new \DateTime())
                ;

                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->persist($bounceTrack);
                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->flush();
                return new Response();
            }
        }
        return new Response('', 406);
    }

    public function deliverAction(Request $request) {
        $parameters = $request->request->all();
        if (isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])) {
            $message = $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
            if ($message) {
                $deliveryTrack = (new DeliveryTrack())
                    ->setMessage($message)
                    ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
                    ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
                    ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
                    ->setCreated(new \DateTime())
                ;

                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->persist($deliveryTrack);
                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->flush();
                return new Response();
            }
        }
        return new Response('', 406);
    }

    public function dropAction(Request $request) {
        $parameters = $request->request->all();
        if (isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])) {
            $message = $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
            if ($message) {
                $failureTrack = (new FailureTrack())
                    ->setMessage($message)
                    ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
                    ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
                    ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
                    ->setReason(isset($parameters['reason']) ? $parameters['reason'] : null)
                    ->setCode(isset($parameters['code']) ? $parameters['code'] : null)
                    ->setDescription(isset($parameters['description']) ? $parameters['description'] : null)
                    ->setCreated(new \DateTime())
                ;

                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->persist($failureTrack);
                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->flush();
                return new Response();
            }
        }
        return new Response('', 406);
    }

    public function spamAction(Request $request) {
        $parameters = $request->request->all();
        if (isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])) {
            $message = $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
            if ($message) {
                $spamComplaintTrack = (new SpamComplaintTrack())
                    ->setMessage($message)
                    ->setRecipient(isset($parameters['recipient']) ? $parameters['recipient'] : null)
                    ->setDomain(isset($parameters['domain']) ? $parameters['domain'] : null)
                    ->setMessageHeaders(isset($parameters['message-headers']) ? $parameters['message-headers'] : null)
                    ->setCampaignId(isset($parameters['campaign-id']) ? $parameters['campaign-id'] : null)
                    ->setCampaignName(isset($parameters['campaign-name']) ? $parameters['campaign-name'] : null)
                    ->setTag(isset($parameters['tag']) ? $parameters['tag'] : null)
                    ->setMailingList(isset($parameters['mailing-list']) ? $parameters['mailing-list'] : null)
                    ->setCreated(new \DateTime())
                ;

                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->persist($spamComplaintTrack);
                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->flush();
                return new Response();
            }
        }
        return new Response('', 406);
    }

    public function clickAction(Request $request) {
        $parameters = $request->request->all();
        if (isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])) {
            $message = $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
            if ($message) {
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
                    ->setCreated(new \DateTime())
                ;

                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->persist($clickTrack);
                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->flush();
                return new Response();
            }
        }
        return new Response('', 406);
    }

    public function openAction(Request $request) {
        $parameters = $request->request->all();
        if (isset($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])) {
            $message = $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')
                ->getRepository('MailgunAdminBundle:Message')
                ->find($parameters[Send::MAILGUN_ADMIN_MESSAGE_ID_HEADER])
            ;
            if ($message) {
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
                    ->setCreated(new \DateTime())
                ;

                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->persist($openTrack);
                $this->getDoctrine()->getManager('copromatic_mailgun_admin.entity_manager')->flush();
                return new Response();
            }
        }
        return new Response('', 406);
    }

    private function verify($apiKey, $token, $timestamp, $signature)
    {
        //check if the timestamp is fresh
        if (abs(time() - $timestamp) > 15) {
            return false;
        }

        //returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
    }
}
