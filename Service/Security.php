<?php

namespace Copromatic\MailgunAdminBundle\Service;

class Security {

    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Verify call from Mailgun with our API key
     *
     * @param $token
     * @param $timestamp
     * @param $signature
     * @return bool
     */
    public function verify($token, $timestamp, $signature)
    {
        //check if the timestamp is fresh
        if (abs(time() - $timestamp) > 15) {
            return false;
        }

        //returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $this->apiKey) === $signature;
    }
}