<?php

namespace Copromatic\MailgunAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WebhookController extends Controller {

    public function bounceAction(Request $request) {
        dump($request);die;
    }

    public function deliverAction(Request $request) {
        dump($request);die;
    }

    public function dropAction(Request $request) {
        dump($request);die;
    }

    public function spamAction(Request $request) {
        dump($request);die;
    }

    public function clickAction(Request $request) {
        dump($request);die;
    }

    public function openAction(Request $request) {
        dump($request);die;
    }
}