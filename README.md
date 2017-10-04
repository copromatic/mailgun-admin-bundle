## Table of contents

## Requirements

This bundle is tested with Symfony 3 and PHP 7.1 with Swiftmailer and [Mailgun Transport](https://github.com/tehplague/swiftmailer-mailgun-bundle)

## Getting started

MailgunAdminBundle simply register ids of emails sent from Mailgun in DB and offers

Just pull the vendor:<br/>
`composer require copromatic/mailgun-admin-bundle`

(Optional) Set up a connection for the bundle, will use "default" if not specified

```yaml
orm:
    default_entity_manager: default
    entity_managers:
        default:
            connection: default
            naming_strategy: doctrine.orm.naming_strategy.underscore
            auto_mapping: true
        mailgun_admin:
            connection: default
            naming_strategy: doctrine.orm.naming_strategy.underscore
            mappings:
                MailgunAdminBundle: ~

...

mailgun_admin:
    api_key: '%mailgun_api_key%'
    entity_manager: 'mailgun_admin'
```



Then update your database:<br/>
`php [bin|app]/console doctrine:schema:update --force [--em=mailgun_admin]`

Or

`php [bin|app]/console doctrine:migration:diff` and `php [bin|app]/console doctrine:migration:migrate` if you roll with migrations


A Swiftmailer listener waits for an email sent, it registers it to the DB if it bears a Message-Id (set up by Mailgun)

## What's included

8 tables:<br>
One for messages (mailgun can set their same id to multiples emails if they are sent at the same time) <br>
7 for trackers: 
bounces, clicks, deliveries, failures, opens, spam reports

## TODO

- ! tests !
- Implement unsubscribe tracking
- Services to access content easily
- Twig extensions to display data

## Creators

<a href="https://www.copromatic.com/">
    <img src="https://files.copromatic.com/logo-copromatic-hd.jpg" height="70px">
</a>
<br>

[github.com/copromatic]()

<br>

**Yannis Touili**
- [github.com/touiliy]()

## Copyright and license
Code and documentation copyright 2012-2017. Code released under the [MIT License](https://github.com/twbs/bootstrap/blob/master/LICENSE).