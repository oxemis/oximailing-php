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

### Compatibility

This library requires **PHP v7.4** or higher.

### Installation

Use the below code to install the wrapper:

`composer require oxemis/oximailing-php`

### Authentication

This library is a wrapper to the [OxiMailing API](https://api.oximailing).
You can request an API KEY in your [OxiMailing Account](https://account.oxemis.com). Free credits are offered.

You should export your API_LOGIN and API_PASSWORD in order to use it in this library :

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

### Sending your first email

Here's a simple sample of how to send a mail :

```php
<?php
require 'vendor/autoload.php';
use Oxemis\OxiMailing\ApiClient;  
use Oxemis\OxiMailing\Objects\Message;

// Create the Client
$apilogin = 'your API login';
$apipwd = 'your API password';
$oximailing = new ApiClient($apilogin, $apipwd);

// Define the message
$mail = new Message();  
$mail
->addRecipientEmail("joe@example.com") 
->addRecipientEmail("jane@example.com") 
->setSender("support@oxemis.com") 
->setSenderName("Oxemis") 
->setSubject("Hello world !");

// Send the message
$client->sendAPI->send($mail);

```



## Contribute

Feel free to ask anything, and contribute to this project.
Need help ? 👉 support@oxemis.com

