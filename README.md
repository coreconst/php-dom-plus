# php-dom-plus

`php-dom-plus` is a PHP library that extends the native `DOMDocument` and `DOMElement` classes, bringing familiar JavaScript-like methods to PHP. It provides additional functionality for working with HTML documents.

## Features

- **JavaScript-like Methods**: Provides methods that mimic JavaScript's DOM API, including `querySelector`, `querySelectorAll`, `getElementsByClassName`.
- **Enhanced Element Handling**: Adds functionality for handling class names with methods like `classList.add`, `classList.remove`, and `classList.toggle`.
- **HTML Content Access**: Includes properties `innerHTML` and `outerHTML` for easily retrieving HTML content inside and around elements.

## Usage

```php
use PhpDomPlus\Document;

$document = new Document();
$document->loadHTMLByUrl('http://example.com');

$element = $document->querySelector('.example-class');
echo $element->innerHTML;

$element->classList->add('new-class');
echo $element->outerHTML;

```