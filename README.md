## Table of contents

## Requirements

This bundle is tested with Symfony 3 and PHP 7.1

## Getting started

MailgunAdminBundle simply register ids of emails sent from Mailgun in DB and offers

Just pull the vendor:<br/>
`composer require copromatic/mailgun-admin-bundle`

Then update your database:<br/>
`php [bin|app]/console doctrine:schema:update --force`

Or

`php [bin|app]/console doctrine:migration:diff` and `php [bin|app]/console doctrine:migration:migrate` if you roll with migrations


A listener waits for an email sent, it registers it to the DB if it bears a Message-Id (set up by Mailgun)

## What's included


## Creators

<a href="https://www.copromatic.com/">
    <img src="https://files.copromatic.com/logo-copromatic-hd.jpg" height="70px">
</a>

<br>

**Yannis Touili**
- <github.com/touiliy>

## Copyright and license
Code and documentation copyright 2012-2017. Code released under the [MIT License](https://github.com/twbs/bootstrap/blob/master/LICENSE).