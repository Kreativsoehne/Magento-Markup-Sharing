<?php
/**
 * Contains some methods for external blocks
 *
 * @author Michael Fuchs - Kreativ&Söhne - michael@kreativsoehne.de
 * @extends Mage_Core_Helper_Abstract
 *
 * Changelog
 * =========
 *
 * March 13th, 2013 - Michael Fuchs
 *  - first public version \o\ \o/ /o/
 *
 */
class KuS_MarkupSharing_Helper_Data extends Mage_Core_Helper_Abstract
{

    //--------------------------------------------------------------------------

    /**
     * Returns the whole (html) output from the external source.
     *
     * This method will stupidly return everything file_get_contents() delivered
     * So, keep in mind that you have to implement your own intelligence.
     *
     * @access public
     * @return string
     */
    public function getExternalMarkup($url)
    {
        $html = '';
        // if you're using htaccess authorization, uncomment the following line
        // and edit the login credentials.
        //$context = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode("user:password"))));

        // Got a relative url? Extend it with local protocol and domain name
        if (strtolower(substr($url, 0, 4)) != 'http')
            $url = $this->getSiteUrl() . $url;


        // Uncomment this too, if you're using htaccess
        //return @file_get_contents($url, false, $context);
        try {
            $client = new Zend_Http_Client($url);
            $html = $client->request()->getBody();
        } catch (Zend_Http_Client_Exception $e) {
            Mage::log('could not retrieve content from %s', $url);
        }
        return $html;
    }

    //--------------------------------------------------------------------------

    /**
     * Returns protocol and domain the shop is actually running on.
     *
     * http(s)://www.mygreatmagentoshop.tld/
     *
     * @access public
     * @return void
     */
    public function getSiteURL()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return $protocol.$domainName;
    }

    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------

}
