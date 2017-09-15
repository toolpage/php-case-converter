# PHP Case Converter
The PHP Case Converter collection helps changing the cases of an existing texts.

## Usage

```php
$converter = new CaseConverter();

$input = "The quick brown fox jumps over the lazy dog";

$converter->convertToUpperCase($input);   // THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG
$converter->convertToLowerCase($input);   // the quick brown fox jumps over the lazy dog
$converter->convertToStartCase($input);   // The Quick Brown Fox Jumps Over The Lazy Dog
$converter->convertToCamelCase($input);   // TheQuickBrownFoxJumpsOverTheLazyDog
$converter->invertCase($input);           // tHE QUICK BROWN FOX JUMPS OVER THE LAZY DOG
```

## Resources

Get more information and online tools for this implementation on:
https://en.toolpage.org/cat/text-conversion
