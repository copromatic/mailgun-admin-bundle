<?php

namespace Copromatic\MailgunAdminBundle\Controller;

class WebhookController extends Controller {

    public function bounceAction(Request $request) {
        dump($request);
    }

    public function deliverAction(Request $request) {
        dump($request);
    }

    public function dropAction(Request $request) {
        dump($request);
    }

    public function spamAction(Request $request) {
        dump($request);
    }

    public function clickAction(Request $request) {
        dump($request);
    }

    public function openAction(Request $request) {
        dump($request);
    }
}