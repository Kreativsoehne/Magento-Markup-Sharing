<?php
/**
 * This block is able to retreive markup from an external source and inject it
 * to magento's markup via XML layouts and magento's CMS functionality.
 *
 * See README.md for details.
 *
 * @author Michael Fuchs - Kreativ&Söhne - michael@kreativsoehne.de
 * @extends Mage_Core_Block_Abstract
 *
 *
 * Changelog
 * =========
 *
 * March 13th, 2013 - Michael Fuchs
 *  - first public version \o\ \o/ /o/
 *
 */
class KuS_MarkupSharing_Block_External extends Mage_Core_Block_Abstract
{

    //--------------------------------------------------------------------------

    /**
     * default cache lifetime (default: 3600 seconds)
     *
     * @var int
     * @access private
     */
    protected $defaultCacheLifetime = 3600;

    //--------------------------------------------------------------------------

    /**
     * returns the block's cache key:
     *
     * kus_markupsharing_external_<storeId>_<md5(externalUrl)>
     *
     * @access public
     * @return void
     */
    public function getCacheKeyInfo()
    {
        return array(
                   'kus_markupsharing_external_',
                   Mage::app()->getStore()->getStoreId(),
                   '_',
                   md5($this->getExternalUrl())
               );
    }

    //--------------------------------------------------------------------------

    /**
     * Returns the block's cache lifetime.
     *
     * It will use this::$defaultCacheLifetime when there is no cache_lifetime
     * parameter set.
     *
     * @access public
     * @return void
     */
    public function getCacheLifetime()
    {
        if (!$this->hasData('cache_lifetime'))
            return $this->defaultCacheLifetime;
        else
            return (int)$this->getData('cache_lifetime');
    }

    //--------------------------------------------------------------------------

    /**
     * Returns the processed markup.
     *
     * Retrieves markup from the external_url parameter and returns it.
     * The optional regex parameter will let you process the retrieved markup a
     * bit. So you are able to use just a special part of the retrieved makup.
     * (The Regex feature is experimental and may not work in this version)
     *
     * @access protected
     * @return string
     */
    protected function _toHtml()
    {
        $helper = Mage::helper('markupsharing/data');

        $result = '';
        $match  = array();
        $url    = $this->getExternalUrl();
        $regex  = $this->getRegex();

        if (is_string($url)) {

            // Retrieve markup
            $html = $helper->getExternalMarkup($url);

            if (is_string($html) && !empty($html)) {

                // is there a regex to be executed?
                if (is_string($regex)) {
                    preg_match($regex, $html, $match);
                    if (isset($match[0]))
                        $result = $match[0];
                } else {
                    $result = $html;
                }
            }
        }

        return $result;
    }

    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------

}