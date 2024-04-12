# Official OxiMailing PHP Wrapper

![MIT License](https://img.shields.io/badge/license-MIT-007EC7.svg?style=flat-square)
![Current Version](https://img.shields.io/badge/version-1.0.0-green.svg)

## Overview

This repository contains the official PHP wrapper for the OxiMailing API.
To get started, create an account and request your free credits on [this page](https://account.oxemis.com/)

This library is a wrapper for the [OxiMailing API](https://api.oximailing.com) but you don't have to know how to use the API to get started with this library.

## Table of contents

- [Compatibility](#compatibility)
- [Installation](#installation)
- [Authentication](#authentication)
- [Getting information about your account](#getting-information-about-your-account)
- [Sending your first email](#sending-your-first-email)
- [How to send customized messages ?](#how-to-send-customized-messages)
- [Tracking a message](#tracking-a-message)
- [Other features](#other-features) 
- [Contribute](#contribute)

## Compatibility

This library requires **PHP v7.4** or higher.

## Installation

Use the below code to install the wrapper:

`composer require oxemis/oximailing-php`

## Authentication

This library is a wrapper to the [OxiMailing API](https://api.oximailing).
You can request an API KEY in your [OxiMailing Account](https://account.oxemis.com). Free credits are offered.

You should export your API_LOGIN and API_PASSWORD in order to use them in this library :

```bash
export OXIMAILING_API_LOGIN='your API login'
export OXIMAILING_API_PWD='your API password'
```

Initialize your **OxiMailing** Client:

```php
use \Oxemis\OxiMailing;

// getenv will allow us to get the OXIMAILING_API_LOGIN/OXIMAILING_API_PWD variables we created before:

$apilogin = getenv('OXIMAILING_API_LOGIN');
$apipwd = getenv('OXIMAILING_API_PWD');

$oximailing = new ApiClient($apilogin, $apipwd);

// or, without using environment variables:

$apilogin = 'your API login';
$apipwd = 'your API password';

$oximailing = new ApiClient($apilogin, $apipwd);
```

## Getting information about your account
You will find all the information about your OxiMailing account with the "**UserAPI**" object.
Informations returned are documented in the class.

```php
require_once "./vendor/autoload.php";

$client = new Oxemis\OxiMailing\ApiClient(API_LOGIN,API_PWD);
$user = $client->userAPI->getUser();

echo "Name :" . $user->getCompanyName() . "\n" .
     "Remaining credits : " . $user->getCredits() . "\n";
```

## Sending your first email
In order to send a mail, you must instantiate a `Message` object and, send it, via the `$client->sendAPI->Send()` method.

> **PLEASE NOTE**
> 
>Before sending any message you **MUST** register your sender email address on your account (or using the `$client->sendersAPI` object).
>Validated senders can be managed on [this page](https://account.oxemis.com/oximailing). If your address is not validated, sending will be refused.

You can add attachments, recipients, CC, BCC and many other options with the `Message` properties.
Every property of the `Message` object is described with PHPDoc.

Here's a simple sample of how to send a mail :

```php
<?php
require 'vendor/autoload.php';
use Oxemis\OxiMailing\ApiClient;  
use Oxemis\OxiMailing\Objects\Message;

// Create the Client
$apilogin = 'your API login';
$apipwd = 'your API password';
$client = new ApiClient($apilogin, $apipwd);

// Define the message
$mail = new Message();  
$mail
->addRecipientEmail("joe@example.com") 
->addRecipientEmail("jane@example.com") 
->setSender("support@oxemis.com") 
->setSenderName("Oxemis") 
->setSubject("Hello world !")
->setHtmlMessage("Hi there ! This is my first email sent with the awesome oximailing-php library !");

// Send the message
$client->sendAPI->send($mail);
```

>With this sample, OxiMailing will send **2 emails**, one to **joe@example.com** and another one to **jane@example.com**. Joe will not see Jane and vice versa !

## How to send customized messages ?
With this library you can send customized messages based on templating.
Basically, every content between `{{` and `}}` will be replaced by the corresponding **recipient metadata**.

Here is a simple sample :
```php
use Oxemis\OxiMailing\Objects\Recipient;
use Oxemis\OxiMailing\Objects\Message;
use Oxemis\OxiMailing\ApiClient;

// First of all we need recipients with meta data
$myFirstRecipient = new Recipient();
$myFirstRecipient->setEmail("joe@example.com");
$myFirstRecipient->setMetaData(["Name" => "Joe", "ID" => 1]);

$mySecondRecipient = new Recipient();
$mySecondRecipient->setEmail("jane@example.com");
$mySecondRecipient->setMetaData(["Name" => "Jane", "ID" => 2]);

// We create the message with {{custom parts}}
$m = new Message();  
$m->addRecipient($myFirstRecipient) 
->addRecipient($mySecondRecipient) 
->setSender("support@oxemis.com") 
->setSenderName("Oxemis") 
->setSubject("Hello {{Name}} !")
->setHtmlMessage("Hi {{Name}} ! This is your ID : {{ID}}");

// Then we send the two messages in one call !
$client = new ApiClient(API_LOGIN, API_PWD);
$client->sendAPI->send($m);
```

## Tracking a message
With OxiMailing you'll be able to track events recorded on your emails.
To enable tracking you must use the `setTrackEmails = true` option of the message and get events using the `$client->trackingAPI` object.

Here is a simple sample. 
First send a tracked message :

```php
// Define the message
$mail = new Oxemis\Oximailing\Objects\Message();  
$mail
->addRecipientEmail("joe@example.com") 
->addRecipientEmail("jane@example.com") 
->setSender("support@oxemis.com") 
->setSenderName("Oxemis") 
->setSubject("Hello world !")
->setHtmlMessage("Hi there ! This is my first email sent with the <a href='https://github.com/oxemis/oximailing-php'>awesome oximailing-php library !</a>")
->setTrackEmails(true);
```

Then send the message and get the SendingId in return :

```php
// Create the client
$client = new \Oxemis\OxiMailing\ApiClient(API_LOGIN,API_PWD);

// Send the message
$sending = $client->sendAPI->send($mail);

// Store the sending id somewhere
$sid = $sending->getSendingId();
```

After that, you'll be able to get events recorded on this message with the tracking API :

```php
use Oxemis\OxiMailing\Objects\Event;

// Create the client
$client = new \Oxemis\OxiMailing\ApiClient(API_LOGIN,API_PWD);

// Will return an array of events (or null if none)
// You can filter on many things, here we use the Sending Id
$events = $client->trackingAPI->getEvents(Event::EVENT_TYPE_CLICK, null, null, null, $sid);
```

## Other features

You'll find a lot of other features by exploring the `*API` objects in the APIClient.
Here is a non-exhaustive list of these objects (each one is documented with PHPDoc).

- `blacklistsAPI` : get / set your blacklists (lists of unsubscribed recipients)
- `bouncesAPI` : get / set your bounces (list of invalid addresses)
- `complaintsAPI` : get the list of spam complaints received on your account
- `domainsAPI` : manage your domains used in OxiMailing
- `sendAPI` : send now or schedule your messages
- `sendersAPI` : add or remove senders on your account
- `trackingAPI` : everything related about tracking (statistics on your messages)
- `userAPI` : everything about your account

Each object is documented with PHPDoc. Other features will be added in the future.
You can also make direct call to the API (and even contribute to this project !).
Please take a look at the [API Reference](https://api.oximailing.com) 😀

## Contribute

Feel free to ask anything, and contribute to this project.
Need help ? 👉 support@oxemis.com

