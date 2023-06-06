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

        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            $parameters['timestamp'] = $json['signature']['timestamp'];
            $parameters['token'] = $json['signature']['token'];
            $parameters['signature'] = $json['signature']['signature'];
        }

        if (!isset($parameters['timestamp']) || !isset($parameters['token']) || !isset($parameters['signature'])) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(406, 'Wrong signature');
        }
        if (!$this->get('mailgun_admin.security')->verify($parameters['token'], $parameters['timestamp'], $parameters['signature'])) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(406, 'Wrong signature');
        }
    }
    protected function findMessageOrException(Request $request){
        $parameters = $request->request->all();

        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                foreach ($json['event-data']['user-variables'] ?? [] as $variable => $value) {
                    $parameters[$variable] = $value;
                }
            }
        }

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
        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                $parameters['recipient'] = $json['event-data']['recipient'] ?? null;
                $parameters['domain'] = $request->get('domain', null);
                $parameters['message-headers'] = $json['event-data']['message']['headers'] ?? [];
                if (isset($json['event-data']['campaigns']) && count($json['event-data']['campaigns'])) {
                    $parameters['campaign-id'] = $json['event-data']['campaigns'][0]['id'] ?? null;
                    $parameters['campaign-name'] = $json['event-data']['campaigns'][0]['name'] ?? null;
                }
                if (isset($json['event-data']['delivery-status'])) {
                    $parameters['error'] = $json['event-data']['delivery-status']['message'] ?? null;
                    $parameters['code'] = $json['event-data']['delivery-status']['code'] ?? null;
                    $parameters['notification'] = $json['event-data']['delivery-status']['description'] ?? null;
                }
                $parameters['tag'] = isset($json['event-data']['tags']) ? implode(',', $json['event-data']['tags']) : null;
            }
        }

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
        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                $parameters['recipient'] = $json['event-data']['recipient'] ?? null;
                $parameters['domain'] = $request->get('domain', null);
                $parameters['message-headers'] = $json['event-data']['message']['headers'] ?? [];
            }
        }
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
        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                $parameters['recipient'] = $json['event-data']['recipient'] ?? null;
                $parameters['domain'] = $request->get('domain', null);
                $parameters['message-headers'] = $json['event-data']['message']['headers'] ?? [];
                $parameters['reason'] = $json['event-data']['reason'] ?? null;
                if (isset($json['event-data']['delivery-status'])) {
                    $parameters['code'] = $json['event-data']['delivery-status']['code'] ?? null;
                    $parameters['description'] = $json['event-data']['delivery-status']['message'] ?? null;
                    $parameters['description'] = $parameters['description'] . ($json['event-data']['delivery-status']['message'] ?? '');
                }
            }
        }

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
        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                $parameters['recipient'] = $json['event-data']['recipient'] ?? null;
                $parameters['domain'] = $request->get('domain', null);
                $parameters['message-headers'] = $json['event-data']['message']['headers'] ?? [];
                if (isset($json['event-data']['campaigns']) && count($json['event-data']['campaigns'])) {
                    $parameters['campaign-id'] = $json['event-data']['campaigns'][0]['id'] ?? null;
                    $parameters['campaign-name'] = $json['event-data']['campaigns'][0]['name'] ?? null;
                }
                $parameters['tag'] = isset($json['tags']) ? implode(',', $json['tags']) : null;
            }
        }

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
        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                $parameters['recipient'] = $json['event-data']['recipient'] ?? null;
                $parameters['domain'] = $request->get('domain', null);
                $parameters['ip'] = $json['event-data']['ip'] ?? null;
                $parameters['country'] = $json['event-data']['geolocation']['country'] ?? null;
                $parameters['region'] = $json['event-data']['geolocation']['region'] ?? null;
                $parameters['city'] = $json['event-data']['geolocation']['city'] ?? null;
                if (isset($json['event-data']['campaigns']) && count($json['event-data']['campaigns'])) {
                    $parameters['campaign-id'] = $json['event-data']['campaigns'][0]['id'] ?? null;
                    $parameters['campaign-name'] = $json['event-data']['campaigns'][0]['name'] ?? null;
                }

                $parameters['user-agent'] = $json['event-data']['client-info']['user-agent'] ?? null;
                $parameters['device-type'] = $json['event-data']['client-info']['device-type'] ?? null;
                $parameters['client-type'] = $json['event-data']['client-info']['client-type'] ?? null;
                $parameters['client-name'] = $json['event-data']['client-info']['client-name'] ?? null;
                $parameters['client-os'] = $json['event-data']['client-info']['client-os'] ?? null;
                $parameters['tag'] = isset($json['event-data']['tags']) ? implode(',', $json['event-data']['tags']) : null;
            }
        }

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
        //gestion v3
        if(count($parameters) == 0 && $request->getContent()){
            $json = @json_decode($request->getContent(), true);
            if(isset($json['event-data'])) {
                $parameters['recipient'] = $json['event-data']['recipient'] ?? null;
                $parameters['domain'] = $request->get('domain', null);
                $parameters['ip'] = $json['event-data']['ip'] ?? null;
                $parameters['country'] = $json['event-data']['geolocation']['country'] ?? null;
                $parameters['region'] = $json['event-data']['geolocation']['region'] ?? null;
                $parameters['city'] = $json['event-data']['geolocation']['city'] ?? null;
                if (isset($json['event-data']['campaigns']) && count($json['event-data']['campaigns'])) {
                    $parameters['campaign-id'] = $json['event-data']['campaigns'][0]['id'] ?? null;
                    $parameters['campaign-name'] = $json['event-data']['campaigns'][0]['name'] ?? null;
                }

                $parameters['user-agent'] = $json['event-data']['client-info']['user-agent'] ?? null;
                $parameters['device-type'] = $json['event-data']['client-info']['device-type'] ?? null;
                $parameters['client-type'] = $json['event-data']['client-info']['client-type'] ?? null;
                $parameters['client-name'] = $json['event-data']['client-info']['client-name'] ?? null;
                $parameters['client-os'] = $json['event-data']['client-info']['client-os'] ?? null;
                $parameters['tag'] = isset($json['event-data']['tags']) ? implode(',', $json['event-data']['tags']) : null;
            }
        }
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
