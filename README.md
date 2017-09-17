# PHP Case Converter
The PHP Case Converter collection helps changing the cases of existing texts.

## Usage

```php
<?php
require_once("CaseConverter.php");
$converter = new CaseConverter();

$input = "The quick brown fox jumps over the lazy dog";

$converter->convertToUpperCase($input);   // THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG
$converter->convertToLowerCase($input);   // the quick brown fox jumps over the lazy dog
$converter->convertToStartCase($input);   // The Quick Brown Fox Jumps Over The Lazy Dog
$converter->convertToCamelCase($input);   // TheQuickBrownFoxJumpsOverTheLazyDog
$converter->convertToSnakeCase($input);   // The_Quick_Brown_Fox_Jumps_Over_The_Lazy_Dog
$converter->convertToKebabCase($input);   // the-quick-brown-fox-jumps-over-the-lazy-dog
$converter->convertToStudlyCaps($input);  // THe QUiCk BRoWn FoX JUMps oVeR thE LazY dOG
$converter->invertCase($input);           // tHE QUICK BROWN FOX JUMPS OVER THE LAZY DOG
```

## Online Resources

Get more information and online tools for this implementation on 
https://en.toolpage.org/cat/case-converter

* [Upper case converter](https://en.toolpage.org/tool/uppercase)
* [Lower case converter](https://en.toolpage.org/tool/lowercase)
* [Camel case converter](https://en.toolpage.org/tool/camelcase)
* [Start case converter](https://en.toolpage.org/tool/startcase)
* [Snake case converter](https://en.toolpage.org/tool/snakecase)
* [Kebab case converter](https://en.toolpage.org/tool/kebabcase)
* [Alternating case converter](https://en.toolpage.org/tool/alternatingcase)
* [Studly caps converter](https://en.toolpage.org/tool/studlycaps)
* [Case inverter](https://en.toolpage.org/tool/case-inverter)
