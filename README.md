# deepl-api
Simple implementation of a web translator realised using php + html + deepl-php + DeepL API

## Pre-requisites
- DeepL API subscription (Free tier gives you 500000 character of translation) https://www.deepl.com/pro-api?cta=header-pro-api
- deepl-php (Official PHP client library for the DeepL API): https://github.com/DeepLcom/deepl-php

## Configuration
- In the `index.php` file remember to replace the API `$authKey` value with your own key obtained from DeepL web site.

  ```
  <?php
    session_start();
    require __DIR__.'/../vendor/autoload.php';
    $authKey = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx:xx"; // Replace with your key
    $translator = new \DeepL\Translator($authKey);
    $usage = $translator->getUsage();
  ...
  ```

- You ca add languages in the `$langs` values of the `index.php`:

  ```
  $langs = [
    [
      "name" => "Italian",
      "value" => "IT",
      "flag" => "&#x1F1EE&#x1F1F9"
    ],
    [
      "name" => "English",
      "value" => "EN-GB",
      "flag" => "&#x1F1EC&#x1F1E7"
    ],
  ...
  ```
