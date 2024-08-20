<?php

namespace PhpDomPlus;

use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use PhpDomPlus\Service\HttpClient;
use PhpDomPlus\Traits\HasElements;

class Document extends \DOMDocument
{
    use HasElements;

    protected ?string $loadedPage = null;

    protected ?Exception $exception = null;

    public function __construct() {
        parent::__construct();

        $this->registerNodeClass('DOMDocument', 'PhpDomPlus\Document');
        $this->registerNodeClass('DOMElement', 'PhpDomPlus\Element');

    }

    /**
     * Load html by link
     *
     * @param string $url
     * @param bool $loadPurifiedHtmlWhileException <p>
     *     If true, purifies HTML using HTMLPurifier when an exception occurs.
     * </p>
     * @param bool $ignoreLoadHtmlErrorsWhileException *Not recommended.** <p>
     *     If true, suppresses errors and warnings during loadHTML.
     * </p>
     *
     * @return void
     * @throws Exception if both $loadPurifiedHtmlWhileException and $ignoreLoadHtmlErrorsWhileException are set to false.
     */
    public function loadHTMLByUrl(string $url,
                                  bool $loadPurifiedHtmlWhileException = true,
                                  bool $ignoreLoadHtmlErrorsWhileException = false): void
    {
        $client = new HttpClient();
        $page = $client->getPage($url);

        if(!isset($page)){
            $this->loadedPage = null;
            $this->exception = $client->getException();
            return;
        }

        $this->loadedPage = $page;

        try {
            $this->loadHTML($page);
            $this->exception = null;
        } catch (Exception $e){

            $this->exception = $e;

            if($loadPurifiedHtmlWhileException){
                $config = HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($config);
                $cleanHtml = $purifier->purify($page);
                $this->loadHTML($cleanHtml);
                return;
            }
            if($ignoreLoadHtmlErrorsWhileException){
                $page = mb_convert_encoding($page, 'HTML-ENTITIES', 'UTF-8');
                @$this->loadHTML($page, LIBXML_NOERROR | LIBXML_NOWARNING);
                return;
            }

            throw $e;
        }
    }

    public function getLoadedPage(): ?string
    {
        return $this->loadedPage;
    }

    public function getException(): ?Exception
    {
        return $this->exception;
    }
}