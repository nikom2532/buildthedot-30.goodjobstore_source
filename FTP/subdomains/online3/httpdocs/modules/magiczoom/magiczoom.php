<?php

if(!isset($GLOBALS['magictoolbox'])) {
    $GLOBALS['magictoolbox'] = array();
}

if(!isset($GLOBALS['magictoolbox']['magiczoom'])) {
    $GLOBALS['magictoolbox']['magiczoom'] = array();
}

if(!isset($GLOBALS['magictoolbox']['magiczoom']['headers'])) {
    $GLOBALS['magictoolbox']['magiczoom']['headers'] = false;
}

if(!isset($GLOBALS['magictoolbox']['filters'])) {
    $GLOBALS['magictoolbox']['filters'] = array();
}

class MagicZoom extends Module {

    public function __construct() {
        $this->name = 'magiczoom';
        $this->tab = 'Tools';
        $this->version = '5.1.9';
        $this->author = 'Magic Toolbox';

        $this->module_key = '75112ed501254e4d263967f408833b67';











        parent::__construct();

        $this->displayName = 'Magic Zoom';
        $this->description = "Zoom into images when you hover over an image. A beautiful effect.";
        $this->confirmUninstall = 'All magiczoom settings would be deleted. Do you really want to uninstall this module ?';
    }

    public function install() {
        if(   !parent::install()
           OR !$this->registerHook('header')
           OR !$this->registerHook('productFooter')
           OR !$this->registerHook('footer')
           OR !$this->installDB()
           OR !$this->fixCSS()


           OR !$this->updatePosition(Hook::get('header'), 0, 1)

          )
          return false;

        return true;
    }



    private function installDB() {
        if(!Db::getInstance()->Execute('CREATE TABLE `'._DB_PREFIX_.'magiczoom_settings` (
                                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                        `block` VARCHAR(32) NOT NULL,
                                        `name` VARCHAR(32) NOT NULL,
                                        `value` TEXT,
                                        `enabled` INT(2) UNSIGNED NOT NULL,
                                        PRIMARY KEY (`id`)
                                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;'
                                      )
            OR !$this->fillDB()

          ) return false;

        return true;
    }

    private function fixCSS() {

        //fix url's in css files
        $fileContents = file_get_contents(dirname(__FILE__) . '/magiczoom.css');
        $toolPath = _MODULE_DIR_ . 'magiczoom';
        $pattern = '/url\(\s*(?:\'|")?(?!'.preg_quote($toolPath, '/').')\/?([^\)\s]+?)(?:\'|")?\s*\)/is';
        $replace = 'url(' . $toolPath . '/$1)';
        $fixedFileContents = preg_replace($pattern, $replace, $fileContents);
        if($fixedFileContents != $fileContents) {
            //file_put_contents(dirname(__FILE__) . '/magiczoom.css', $fixedFileContents);
            $fp = fopen(dirname(__FILE__) . '/magiczoom.css', 'w+');
            if($fp) {
                fwrite($fp, $fixedFileContents);
                fclose($fp);
            }
        }

        return true;
    }

    //function fillDB()
    //function getBlocks()
    //function getParamsMap()
    function fillDB() {
		$sql = 'INSERT INTO `'._DB_PREFIX_.'magiczoom_settings` (`block`, `name`, `value`, `enabled`) VALUES
				(\'default\', \'zoom-width\', \'300\', 1),
				(\'default\', \'zoom-height\', \'300\', 1),
				(\'default\', \'zoom-position\', \'right\', 1),
				(\'default\', \'zoom-align\', \'top\', 1),
				(\'default\', \'zoom-distance\', \'15\', 1),
				(\'default\', \'opacity\', \'50\', 1),
				(\'default\', \'opacity-reverse\', \'No\', 1),
				(\'default\', \'zoom-fade\', \'Yes\', 1),
				(\'default\', \'zoom-window-effect\', \'shadow\', 1),
				(\'default\', \'zoom-fade-in-speed\', \'200\', 1),
				(\'default\', \'zoom-fade-out-speed\', \'200\', 1),
				(\'default\', \'fps\', \'25\', 1),
				(\'default\', \'smoothing\', \'Yes\', 1),
				(\'default\', \'smoothing-speed\', \'40\', 1),
				(\'default\', \'initialize-on\', \'load\', 1),
				(\'default\', \'click-to-activate\', \'No\', 1),
				(\'default\', \'click-to-deactivate\', \'No\', 1),
				(\'default\', \'show-loading\', \'Yes\', 1),
				(\'default\', \'loading-msg\', \'Loading zoom...\', 1),
				(\'default\', \'loading-opacity\', \'75\', 1),
				(\'default\', \'loading-position-x\', \'-1\', 1),
				(\'default\', \'loading-position-y\', \'-1\', 1),
				(\'default\', \'entire-image\', \'No\', 1),
				(\'default\', \'show-title\', \'top\', 1),
				(\'default\', \'link-to-product-page\', \'Yes\', 1),
				(\'default\', \'show-message\', \'Yes\', 1),
				(\'default\', \'message\', \'Move your mouse over image\', 1),
				(\'default\', \'right-click\', \'No\', 1),
				(\'default\', \'disable-zoom\', \'No\', 1),
				(\'default\', \'always-show-zoom\', \'No\', 1),
				(\'default\', \'drag-mode\', \'No\', 1),
				(\'default\', \'move-on-click\', \'Yes\', 1),
				(\'default\', \'x\', \'-1\', 1),
				(\'default\', \'y\', \'-1\', 1),
				(\'default\', \'preserve-position\', \'No\', 1),
				(\'default\', \'fit-zoom-window\', \'Yes\', 1),
				(\'default\', \'thumb-image\', \'large\', 1),
				(\'default\', \'selector-image\', \'small\', 1),
				(\'default\', \'large-image\', \'thickbox\', 1),
				(\'default\', \'hint\', \'Yes\', 1),
				(\'default\', \'hint-text\', \'Zoom\', 1),
				(\'default\', \'hint-position\', \'top left\', 1),
				(\'default\', \'hint-opacity\', \'75\', 1),
				(\'product\', \'template\', \'original\', 0),
				(\'product\', \'magicscroll\', \'No\', 0),
				(\'product\', \'zoom-width\', \'300\', 0),
				(\'product\', \'zoom-height\', \'300\', 0),
				(\'product\', \'zoom-position\', \'right\', 0),
				(\'product\', \'zoom-align\', \'top\', 0),
				(\'product\', \'zoom-distance\', \'15\', 0),
				(\'product\', \'opacity\', \'50\', 0),
				(\'product\', \'opacity-reverse\', \'No\', 0),
				(\'product\', \'zoom-fade\', \'Yes\', 0),
				(\'product\', \'zoom-window-effect\', \'shadow\', 0),
				(\'product\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'product\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'product\', \'fps\', \'25\', 0),
				(\'product\', \'smoothing\', \'Yes\', 0),
				(\'product\', \'smoothing-speed\', \'40\', 0),
				(\'product\', \'selectors-margin\', \'5\', 0),
				(\'product\', \'selectors-change\', \'click\', 0),
				(\'product\', \'selectors-class\', \'\', 0),
				(\'product\', \'preload-selectors-small\', \'Yes\', 0),
				(\'product\', \'preload-selectors-big\', \'No\', 0),
				(\'product\', \'selectors-effect\', \'dissolve\', 0),
				(\'product\', \'selectors-effect-speed\', \'400\', 0),
				(\'product\', \'selectors-mouseover-delay\', \'60\', 0),
				(\'product\', \'initialize-on\', \'load\', 0),
				(\'product\', \'click-to-activate\', \'No\', 0),
				(\'product\', \'click-to-deactivate\', \'No\', 0),
				(\'product\', \'show-loading\', \'Yes\', 0),
				(\'product\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'product\', \'loading-opacity\', \'75\', 0),
				(\'product\', \'loading-position-x\', \'-1\', 0),
				(\'product\', \'loading-position-y\', \'-1\', 0),
				(\'product\', \'entire-image\', \'No\', 0),
				(\'product\', \'show-title\', \'top\', 0),
				(\'product\', \'enable-effect\', \'Yes\', 1),
				(\'product\', \'show-message\', \'Yes\', 0),
				(\'product\', \'message\', \'Move your mouse over image\', 0),
				(\'product\', \'right-click\', \'No\', 0),
				(\'product\', \'disable-zoom\', \'No\', 0),
				(\'product\', \'always-show-zoom\', \'No\', 0),
				(\'product\', \'drag-mode\', \'No\', 0),
				(\'product\', \'move-on-click\', \'Yes\', 0),
				(\'product\', \'x\', \'-1\', 0),
				(\'product\', \'y\', \'-1\', 0),
				(\'product\', \'preserve-position\', \'No\', 0),
				(\'product\', \'fit-zoom-window\', \'Yes\', 0),
				(\'product\', \'thumb-image\', \'large\', 0),
				(\'product\', \'selector-image\', \'small\', 0),
				(\'product\', \'large-image\', \'thickbox\', 0),
				(\'product\', \'hint\', \'Yes\', 0),
				(\'product\', \'hint-text\', \'Zoom\', 0),
				(\'product\', \'hint-position\', \'top left\', 0),
				(\'product\', \'hint-opacity\', \'75\', 0),
				(\'product\', \'scroll-style\', \'default\', 0),
				(\'product\', \'loop\', \'continue\', 0),
				(\'product\', \'speed\', \'5000\', 0),
				(\'product\', \'width\', \'0\', 0),
				(\'product\', \'height\', \'0\', 0),
				(\'product\', \'item-width\', \'0\', 0),
				(\'product\', \'item-height\', \'0\', 0),
				(\'product\', \'step\', \'3\', 0),
				(\'product\', \'items\', \'3\', 0),
				(\'product\', \'arrows\', \'outside\', 0),
				(\'product\', \'arrows-opacity\', \'60\', 0),
				(\'product\', \'arrows-hover-opacity\', \'100\', 0),
				(\'product\', \'slider-size\', \'10%\', 0),
				(\'product\', \'slider\', \'false\', 0),
				(\'product\', \'duration\', \'1000\', 0),
				(\'category\', \'zoom-width\', \'300\', 0),
				(\'category\', \'zoom-height\', \'300\', 0),
				(\'category\', \'zoom-position\', \'right\', 0),
				(\'category\', \'zoom-align\', \'top\', 0),
				(\'category\', \'zoom-distance\', \'15\', 0),
				(\'category\', \'opacity\', \'50\', 0),
				(\'category\', \'opacity-reverse\', \'No\', 0),
				(\'category\', \'zoom-fade\', \'Yes\', 0),
				(\'category\', \'zoom-window-effect\', \'shadow\', 0),
				(\'category\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'category\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'category\', \'fps\', \'25\', 0),
				(\'category\', \'smoothing\', \'Yes\', 0),
				(\'category\', \'smoothing-speed\', \'40\', 0),
				(\'category\', \'initialize-on\', \'load\', 0),
				(\'category\', \'click-to-activate\', \'No\', 0),
				(\'category\', \'click-to-deactivate\', \'No\', 0),
				(\'category\', \'show-loading\', \'Yes\', 0),
				(\'category\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'category\', \'loading-opacity\', \'75\', 0),
				(\'category\', \'loading-position-x\', \'-1\', 0),
				(\'category\', \'loading-position-y\', \'-1\', 0),
				(\'category\', \'entire-image\', \'No\', 0),
				(\'category\', \'show-title\', \'top\', 0),
				(\'category\', \'enable-effect\', \'No\', 1),
				(\'category\', \'link-to-product-page\', \'Yes\', 0),
				(\'category\', \'show-message\', \'No\', 1),
				(\'category\', \'message\', \'Move your mouse over image\', 0),
				(\'category\', \'right-click\', \'No\', 0),
				(\'category\', \'disable-zoom\', \'No\', 0),
				(\'category\', \'always-show-zoom\', \'No\', 0),
				(\'category\', \'drag-mode\', \'No\', 0),
				(\'category\', \'move-on-click\', \'Yes\', 0),
				(\'category\', \'x\', \'-1\', 0),
				(\'category\', \'y\', \'-1\', 0),
				(\'category\', \'preserve-position\', \'No\', 0),
				(\'category\', \'fit-zoom-window\', \'Yes\', 0),
				(\'category\', \'thumb-image\', \'home\', 1),
				(\'category\', \'selector-image\', \'small\', 0),
				(\'category\', \'large-image\', \'thickbox\', 0),
				(\'category\', \'hint\', \'Yes\', 0),
				(\'category\', \'hint-text\', \'Zoom\', 0),
				(\'category\', \'hint-position\', \'top left\', 0),
				(\'category\', \'hint-opacity\', \'75\', 0),
				(\'manufacturer\', \'zoom-width\', \'300\', 0),
				(\'manufacturer\', \'zoom-height\', \'300\', 0),
				(\'manufacturer\', \'zoom-position\', \'right\', 0),
				(\'manufacturer\', \'zoom-align\', \'top\', 0),
				(\'manufacturer\', \'zoom-distance\', \'15\', 0),
				(\'manufacturer\', \'opacity\', \'50\', 0),
				(\'manufacturer\', \'opacity-reverse\', \'No\', 0),
				(\'manufacturer\', \'zoom-fade\', \'Yes\', 0),
				(\'manufacturer\', \'zoom-window-effect\', \'shadow\', 0),
				(\'manufacturer\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'manufacturer\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'manufacturer\', \'fps\', \'25\', 0),
				(\'manufacturer\', \'smoothing\', \'Yes\', 0),
				(\'manufacturer\', \'smoothing-speed\', \'40\', 0),
				(\'manufacturer\', \'initialize-on\', \'load\', 0),
				(\'manufacturer\', \'click-to-activate\', \'No\', 0),
				(\'manufacturer\', \'click-to-deactivate\', \'No\', 0),
				(\'manufacturer\', \'show-loading\', \'Yes\', 0),
				(\'manufacturer\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'manufacturer\', \'loading-opacity\', \'75\', 0),
				(\'manufacturer\', \'loading-position-x\', \'-1\', 0),
				(\'manufacturer\', \'loading-position-y\', \'-1\', 0),
				(\'manufacturer\', \'entire-image\', \'No\', 0),
				(\'manufacturer\', \'show-title\', \'top\', 0),
				(\'manufacturer\', \'enable-effect\', \'No\', 1),
				(\'manufacturer\', \'link-to-product-page\', \'Yes\', 0),
				(\'manufacturer\', \'show-message\', \'No\', 1),
				(\'manufacturer\', \'message\', \'Move your mouse over image\', 0),
				(\'manufacturer\', \'right-click\', \'No\', 0),
				(\'manufacturer\', \'disable-zoom\', \'No\', 0),
				(\'manufacturer\', \'always-show-zoom\', \'No\', 0),
				(\'manufacturer\', \'drag-mode\', \'No\', 0),
				(\'manufacturer\', \'move-on-click\', \'Yes\', 0),
				(\'manufacturer\', \'x\', \'-1\', 0),
				(\'manufacturer\', \'y\', \'-1\', 0),
				(\'manufacturer\', \'preserve-position\', \'No\', 0),
				(\'manufacturer\', \'fit-zoom-window\', \'Yes\', 0),
				(\'manufacturer\', \'thumb-image\', \'home\', 1),
				(\'manufacturer\', \'selector-image\', \'small\', 0),
				(\'manufacturer\', \'large-image\', \'thickbox\', 0),
				(\'manufacturer\', \'hint\', \'Yes\', 0),
				(\'manufacturer\', \'hint-text\', \'Zoom\', 0),
				(\'manufacturer\', \'hint-position\', \'top left\', 0),
				(\'manufacturer\', \'hint-opacity\', \'75\', 0),
				(\'newproductpage\', \'zoom-width\', \'300\', 0),
				(\'newproductpage\', \'zoom-height\', \'300\', 0),
				(\'newproductpage\', \'zoom-position\', \'right\', 0),
				(\'newproductpage\', \'zoom-align\', \'top\', 0),
				(\'newproductpage\', \'zoom-distance\', \'15\', 0),
				(\'newproductpage\', \'opacity\', \'50\', 0),
				(\'newproductpage\', \'opacity-reverse\', \'No\', 0),
				(\'newproductpage\', \'zoom-fade\', \'Yes\', 0),
				(\'newproductpage\', \'zoom-window-effect\', \'shadow\', 0),
				(\'newproductpage\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'newproductpage\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'newproductpage\', \'fps\', \'25\', 0),
				(\'newproductpage\', \'smoothing\', \'Yes\', 0),
				(\'newproductpage\', \'smoothing-speed\', \'40\', 0),
				(\'newproductpage\', \'initialize-on\', \'load\', 0),
				(\'newproductpage\', \'click-to-activate\', \'No\', 0),
				(\'newproductpage\', \'click-to-deactivate\', \'No\', 0),
				(\'newproductpage\', \'show-loading\', \'Yes\', 0),
				(\'newproductpage\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'newproductpage\', \'loading-opacity\', \'75\', 0),
				(\'newproductpage\', \'loading-position-x\', \'-1\', 0),
				(\'newproductpage\', \'loading-position-y\', \'-1\', 0),
				(\'newproductpage\', \'entire-image\', \'No\', 0),
				(\'newproductpage\', \'show-title\', \'top\', 0),
				(\'newproductpage\', \'enable-effect\', \'No\', 1),
				(\'newproductpage\', \'link-to-product-page\', \'Yes\', 0),
				(\'newproductpage\', \'show-message\', \'No\', 1),
				(\'newproductpage\', \'message\', \'Move your mouse over image\', 0),
				(\'newproductpage\', \'right-click\', \'No\', 0),
				(\'newproductpage\', \'disable-zoom\', \'No\', 0),
				(\'newproductpage\', \'always-show-zoom\', \'No\', 0),
				(\'newproductpage\', \'drag-mode\', \'No\', 0),
				(\'newproductpage\', \'move-on-click\', \'Yes\', 0),
				(\'newproductpage\', \'x\', \'-1\', 0),
				(\'newproductpage\', \'y\', \'-1\', 0),
				(\'newproductpage\', \'preserve-position\', \'No\', 0),
				(\'newproductpage\', \'fit-zoom-window\', \'Yes\', 0),
				(\'newproductpage\', \'thumb-image\', \'home\', 1),
				(\'newproductpage\', \'selector-image\', \'small\', 0),
				(\'newproductpage\', \'large-image\', \'thickbox\', 0),
				(\'newproductpage\', \'hint\', \'Yes\', 0),
				(\'newproductpage\', \'hint-text\', \'Zoom\', 0),
				(\'newproductpage\', \'hint-position\', \'top left\', 0),
				(\'newproductpage\', \'hint-opacity\', \'75\', 0),
				(\'blocknewproducts\', \'zoom-width\', \'300\', 0),
				(\'blocknewproducts\', \'zoom-height\', \'300\', 0),
				(\'blocknewproducts\', \'zoom-position\', \'left\', 1),
				(\'blocknewproducts\', \'zoom-align\', \'top\', 0),
				(\'blocknewproducts\', \'zoom-distance\', \'15\', 0),
				(\'blocknewproducts\', \'opacity\', \'50\', 0),
				(\'blocknewproducts\', \'opacity-reverse\', \'No\', 0),
				(\'blocknewproducts\', \'zoom-fade\', \'Yes\', 0),
				(\'blocknewproducts\', \'zoom-window-effect\', \'shadow\', 0),
				(\'blocknewproducts\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'blocknewproducts\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'blocknewproducts\', \'fps\', \'25\', 0),
				(\'blocknewproducts\', \'smoothing\', \'Yes\', 0),
				(\'blocknewproducts\', \'smoothing-speed\', \'40\', 0),
				(\'blocknewproducts\', \'initialize-on\', \'load\', 0),
				(\'blocknewproducts\', \'click-to-activate\', \'No\', 0),
				(\'blocknewproducts\', \'click-to-deactivate\', \'No\', 0),
				(\'blocknewproducts\', \'show-loading\', \'Yes\', 0),
				(\'blocknewproducts\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'blocknewproducts\', \'loading-opacity\', \'75\', 0),
				(\'blocknewproducts\', \'loading-position-x\', \'-1\', 0),
				(\'blocknewproducts\', \'loading-position-y\', \'-1\', 0),
				(\'blocknewproducts\', \'entire-image\', \'No\', 0),
				(\'blocknewproducts\', \'show-title\', \'top\', 0),
				(\'blocknewproducts\', \'enable-effect\', \'No\', 1),
				(\'blocknewproducts\', \'link-to-product-page\', \'Yes\', 0),
				(\'blocknewproducts\', \'show-message\', \'No\', 1),
				(\'blocknewproducts\', \'message\', \'Move your mouse over image\', 0),
				(\'blocknewproducts\', \'right-click\', \'No\', 0),
				(\'blocknewproducts\', \'disable-zoom\', \'No\', 0),
				(\'blocknewproducts\', \'always-show-zoom\', \'No\', 0),
				(\'blocknewproducts\', \'drag-mode\', \'No\', 0),
				(\'blocknewproducts\', \'move-on-click\', \'Yes\', 0),
				(\'blocknewproducts\', \'x\', \'-1\', 0),
				(\'blocknewproducts\', \'y\', \'-1\', 0),
				(\'blocknewproducts\', \'preserve-position\', \'No\', 0),
				(\'blocknewproducts\', \'fit-zoom-window\', \'Yes\', 0),
				(\'blocknewproducts\', \'thumb-image\', \'medium\', 1),
				(\'blocknewproducts\', \'selector-image\', \'small\', 0),
				(\'blocknewproducts\', \'large-image\', \'thickbox\', 0),
				(\'blocknewproducts\', \'hint\', \'Yes\', 0),
				(\'blocknewproducts\', \'hint-text\', \'Zoom\', 0),
				(\'blocknewproducts\', \'hint-position\', \'top left\', 0),
				(\'blocknewproducts\', \'hint-opacity\', \'75\', 0),
				(\'bestsellerspage\', \'zoom-width\', \'300\', 0),
				(\'bestsellerspage\', \'zoom-height\', \'300\', 0),
				(\'bestsellerspage\', \'zoom-position\', \'right\', 0),
				(\'bestsellerspage\', \'zoom-align\', \'top\', 0),
				(\'bestsellerspage\', \'zoom-distance\', \'15\', 0),
				(\'bestsellerspage\', \'opacity\', \'50\', 0),
				(\'bestsellerspage\', \'opacity-reverse\', \'No\', 0),
				(\'bestsellerspage\', \'zoom-fade\', \'Yes\', 0),
				(\'bestsellerspage\', \'zoom-window-effect\', \'shadow\', 0),
				(\'bestsellerspage\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'bestsellerspage\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'bestsellerspage\', \'fps\', \'25\', 0),
				(\'bestsellerspage\', \'smoothing\', \'Yes\', 0),
				(\'bestsellerspage\', \'smoothing-speed\', \'40\', 0),
				(\'bestsellerspage\', \'initialize-on\', \'load\', 0),
				(\'bestsellerspage\', \'click-to-activate\', \'No\', 0),
				(\'bestsellerspage\', \'click-to-deactivate\', \'No\', 0),
				(\'bestsellerspage\', \'show-loading\', \'Yes\', 0),
				(\'bestsellerspage\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'bestsellerspage\', \'loading-opacity\', \'75\', 0),
				(\'bestsellerspage\', \'loading-position-x\', \'-1\', 0),
				(\'bestsellerspage\', \'loading-position-y\', \'-1\', 0),
				(\'bestsellerspage\', \'entire-image\', \'No\', 0),
				(\'bestsellerspage\', \'show-title\', \'top\', 0),
				(\'bestsellerspage\', \'enable-effect\', \'No\', 1),
				(\'bestsellerspage\', \'link-to-product-page\', \'Yes\', 0),
				(\'bestsellerspage\', \'show-message\', \'No\', 1),
				(\'bestsellerspage\', \'message\', \'Move your mouse over image\', 0),
				(\'bestsellerspage\', \'right-click\', \'No\', 0),
				(\'bestsellerspage\', \'disable-zoom\', \'No\', 0),
				(\'bestsellerspage\', \'always-show-zoom\', \'No\', 0),
				(\'bestsellerspage\', \'drag-mode\', \'No\', 0),
				(\'bestsellerspage\', \'move-on-click\', \'Yes\', 0),
				(\'bestsellerspage\', \'x\', \'-1\', 0),
				(\'bestsellerspage\', \'y\', \'-1\', 0),
				(\'bestsellerspage\', \'preserve-position\', \'No\', 0),
				(\'bestsellerspage\', \'fit-zoom-window\', \'Yes\', 0),
				(\'bestsellerspage\', \'thumb-image\', \'home\', 1),
				(\'bestsellerspage\', \'selector-image\', \'small\', 0),
				(\'bestsellerspage\', \'large-image\', \'thickbox\', 0),
				(\'bestsellerspage\', \'hint\', \'Yes\', 0),
				(\'bestsellerspage\', \'hint-text\', \'Zoom\', 0),
				(\'bestsellerspage\', \'hint-position\', \'top left\', 0),
				(\'bestsellerspage\', \'hint-opacity\', \'75\', 0),
				(\'blockbestsellers\', \'zoom-width\', \'300\', 0),
				(\'blockbestsellers\', \'zoom-height\', \'300\', 0),
				(\'blockbestsellers\', \'zoom-position\', \'left\', 1),
				(\'blockbestsellers\', \'zoom-align\', \'top\', 0),
				(\'blockbestsellers\', \'zoom-distance\', \'15\', 0),
				(\'blockbestsellers\', \'opacity\', \'50\', 0),
				(\'blockbestsellers\', \'opacity-reverse\', \'No\', 0),
				(\'blockbestsellers\', \'zoom-fade\', \'Yes\', 0),
				(\'blockbestsellers\', \'zoom-window-effect\', \'shadow\', 0),
				(\'blockbestsellers\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'blockbestsellers\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'blockbestsellers\', \'fps\', \'25\', 0),
				(\'blockbestsellers\', \'smoothing\', \'Yes\', 0),
				(\'blockbestsellers\', \'smoothing-speed\', \'40\', 0),
				(\'blockbestsellers\', \'initialize-on\', \'load\', 0),
				(\'blockbestsellers\', \'click-to-activate\', \'No\', 0),
				(\'blockbestsellers\', \'click-to-deactivate\', \'No\', 0),
				(\'blockbestsellers\', \'show-loading\', \'Yes\', 0),
				(\'blockbestsellers\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'blockbestsellers\', \'loading-opacity\', \'75\', 0),
				(\'blockbestsellers\', \'loading-position-x\', \'-1\', 0),
				(\'blockbestsellers\', \'loading-position-y\', \'-1\', 0),
				(\'blockbestsellers\', \'entire-image\', \'No\', 0),
				(\'blockbestsellers\', \'show-title\', \'top\', 0),
				(\'blockbestsellers\', \'enable-effect\', \'No\', 1),
				(\'blockbestsellers\', \'link-to-product-page\', \'Yes\', 0),
				(\'blockbestsellers\', \'show-message\', \'No\', 1),
				(\'blockbestsellers\', \'message\', \'Move your mouse over image\', 0),
				(\'blockbestsellers\', \'right-click\', \'No\', 0),
				(\'blockbestsellers\', \'disable-zoom\', \'No\', 0),
				(\'blockbestsellers\', \'always-show-zoom\', \'No\', 0),
				(\'blockbestsellers\', \'drag-mode\', \'No\', 0),
				(\'blockbestsellers\', \'move-on-click\', \'Yes\', 0),
				(\'blockbestsellers\', \'x\', \'-1\', 0),
				(\'blockbestsellers\', \'y\', \'-1\', 0),
				(\'blockbestsellers\', \'preserve-position\', \'No\', 0),
				(\'blockbestsellers\', \'fit-zoom-window\', \'Yes\', 0),
				(\'blockbestsellers\', \'thumb-image\', \'medium\', 1),
				(\'blockbestsellers\', \'selector-image\', \'small\', 0),
				(\'blockbestsellers\', \'large-image\', \'thickbox\', 0),
				(\'blockbestsellers\', \'hint\', \'Yes\', 0),
				(\'blockbestsellers\', \'hint-text\', \'Zoom\', 0),
				(\'blockbestsellers\', \'hint-position\', \'top left\', 0),
				(\'blockbestsellers\', \'hint-opacity\', \'75\', 0),
				(\'specialspage\', \'zoom-width\', \'300\', 0),
				(\'specialspage\', \'zoom-height\', \'300\', 0),
				(\'specialspage\', \'zoom-position\', \'right\', 0),
				(\'specialspage\', \'zoom-align\', \'top\', 0),
				(\'specialspage\', \'zoom-distance\', \'15\', 0),
				(\'specialspage\', \'opacity\', \'50\', 0),
				(\'specialspage\', \'opacity-reverse\', \'No\', 0),
				(\'specialspage\', \'zoom-fade\', \'Yes\', 0),
				(\'specialspage\', \'zoom-window-effect\', \'shadow\', 0),
				(\'specialspage\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'specialspage\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'specialspage\', \'fps\', \'25\', 0),
				(\'specialspage\', \'smoothing\', \'Yes\', 0),
				(\'specialspage\', \'smoothing-speed\', \'40\', 0),
				(\'specialspage\', \'initialize-on\', \'load\', 0),
				(\'specialspage\', \'click-to-activate\', \'No\', 0),
				(\'specialspage\', \'click-to-deactivate\', \'No\', 0),
				(\'specialspage\', \'show-loading\', \'Yes\', 0),
				(\'specialspage\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'specialspage\', \'loading-opacity\', \'75\', 0),
				(\'specialspage\', \'loading-position-x\', \'-1\', 0),
				(\'specialspage\', \'loading-position-y\', \'-1\', 0),
				(\'specialspage\', \'entire-image\', \'No\', 0),
				(\'specialspage\', \'show-title\', \'top\', 0),
				(\'specialspage\', \'enable-effect\', \'No\', 1),
				(\'specialspage\', \'link-to-product-page\', \'Yes\', 0),
				(\'specialspage\', \'show-message\', \'No\', 1),
				(\'specialspage\', \'message\', \'Move your mouse over image\', 0),
				(\'specialspage\', \'right-click\', \'No\', 0),
				(\'specialspage\', \'disable-zoom\', \'No\', 0),
				(\'specialspage\', \'always-show-zoom\', \'No\', 0),
				(\'specialspage\', \'drag-mode\', \'No\', 0),
				(\'specialspage\', \'move-on-click\', \'Yes\', 0),
				(\'specialspage\', \'x\', \'-1\', 0),
				(\'specialspage\', \'y\', \'-1\', 0),
				(\'specialspage\', \'preserve-position\', \'No\', 0),
				(\'specialspage\', \'fit-zoom-window\', \'Yes\', 0),
				(\'specialspage\', \'thumb-image\', \'home\', 1),
				(\'specialspage\', \'selector-image\', \'small\', 0),
				(\'specialspage\', \'large-image\', \'thickbox\', 0),
				(\'specialspage\', \'hint\', \'Yes\', 0),
				(\'specialspage\', \'hint-text\', \'Zoom\', 0),
				(\'specialspage\', \'hint-position\', \'top left\', 0),
				(\'specialspage\', \'hint-opacity\', \'75\', 0),
				(\'blockspecials\', \'zoom-width\', \'300\', 0),
				(\'blockspecials\', \'zoom-height\', \'300\', 0),
				(\'blockspecials\', \'zoom-position\', \'left\', 1),
				(\'blockspecials\', \'zoom-align\', \'top\', 0),
				(\'blockspecials\', \'zoom-distance\', \'15\', 0),
				(\'blockspecials\', \'opacity\', \'50\', 0),
				(\'blockspecials\', \'opacity-reverse\', \'No\', 0),
				(\'blockspecials\', \'zoom-fade\', \'Yes\', 0),
				(\'blockspecials\', \'zoom-window-effect\', \'shadow\', 0),
				(\'blockspecials\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'blockspecials\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'blockspecials\', \'fps\', \'25\', 0),
				(\'blockspecials\', \'smoothing\', \'Yes\', 0),
				(\'blockspecials\', \'smoothing-speed\', \'40\', 0),
				(\'blockspecials\', \'initialize-on\', \'load\', 0),
				(\'blockspecials\', \'click-to-activate\', \'No\', 0),
				(\'blockspecials\', \'click-to-deactivate\', \'No\', 0),
				(\'blockspecials\', \'show-loading\', \'Yes\', 0),
				(\'blockspecials\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'blockspecials\', \'loading-opacity\', \'75\', 0),
				(\'blockspecials\', \'loading-position-x\', \'-1\', 0),
				(\'blockspecials\', \'loading-position-y\', \'-1\', 0),
				(\'blockspecials\', \'entire-image\', \'No\', 0),
				(\'blockspecials\', \'show-title\', \'top\', 0),
				(\'blockspecials\', \'enable-effect\', \'No\', 1),
				(\'blockspecials\', \'link-to-product-page\', \'Yes\', 0),
				(\'blockspecials\', \'show-message\', \'No\', 1),
				(\'blockspecials\', \'message\', \'Move your mouse over image\', 0),
				(\'blockspecials\', \'right-click\', \'No\', 0),
				(\'blockspecials\', \'disable-zoom\', \'No\', 0),
				(\'blockspecials\', \'always-show-zoom\', \'No\', 0),
				(\'blockspecials\', \'drag-mode\', \'No\', 0),
				(\'blockspecials\', \'move-on-click\', \'Yes\', 0),
				(\'blockspecials\', \'x\', \'-1\', 0),
				(\'blockspecials\', \'y\', \'-1\', 0),
				(\'blockspecials\', \'preserve-position\', \'No\', 0),
				(\'blockspecials\', \'fit-zoom-window\', \'Yes\', 0),
				(\'blockspecials\', \'thumb-image\', \'medium\', 1),
				(\'blockspecials\', \'selector-image\', \'small\', 0),
				(\'blockspecials\', \'large-image\', \'thickbox\', 0),
				(\'blockspecials\', \'hint\', \'Yes\', 0),
				(\'blockspecials\', \'hint-text\', \'Zoom\', 0),
				(\'blockspecials\', \'hint-position\', \'top left\', 0),
				(\'blockspecials\', \'hint-opacity\', \'75\', 0),
				(\'blockviewed\', \'zoom-width\', \'300\', 0),
				(\'blockviewed\', \'zoom-height\', \'300\', 0),
				(\'blockviewed\', \'zoom-position\', \'right\', 0),
				(\'blockviewed\', \'zoom-align\', \'top\', 0),
				(\'blockviewed\', \'zoom-distance\', \'15\', 0),
				(\'blockviewed\', \'opacity\', \'50\', 0),
				(\'blockviewed\', \'opacity-reverse\', \'No\', 0),
				(\'blockviewed\', \'zoom-fade\', \'Yes\', 0),
				(\'blockviewed\', \'zoom-window-effect\', \'shadow\', 0),
				(\'blockviewed\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'blockviewed\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'blockviewed\', \'fps\', \'25\', 0),
				(\'blockviewed\', \'smoothing\', \'Yes\', 0),
				(\'blockviewed\', \'smoothing-speed\', \'40\', 0),
				(\'blockviewed\', \'initialize-on\', \'load\', 0),
				(\'blockviewed\', \'click-to-activate\', \'No\', 0),
				(\'blockviewed\', \'click-to-deactivate\', \'No\', 0),
				(\'blockviewed\', \'show-loading\', \'Yes\', 0),
				(\'blockviewed\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'blockviewed\', \'loading-opacity\', \'75\', 0),
				(\'blockviewed\', \'loading-position-x\', \'-1\', 0),
				(\'blockviewed\', \'loading-position-y\', \'-1\', 0),
				(\'blockviewed\', \'entire-image\', \'No\', 0),
				(\'blockviewed\', \'show-title\', \'top\', 0),
				(\'blockviewed\', \'enable-effect\', \'No\', 1),
				(\'blockviewed\', \'link-to-product-page\', \'Yes\', 0),
				(\'blockviewed\', \'show-message\', \'No\', 1),
				(\'blockviewed\', \'message\', \'Move your mouse over image\', 0),
				(\'blockviewed\', \'right-click\', \'No\', 0),
				(\'blockviewed\', \'disable-zoom\', \'No\', 0),
				(\'blockviewed\', \'always-show-zoom\', \'No\', 0),
				(\'blockviewed\', \'drag-mode\', \'No\', 0),
				(\'blockviewed\', \'move-on-click\', \'Yes\', 0),
				(\'blockviewed\', \'x\', \'-1\', 0),
				(\'blockviewed\', \'y\', \'-1\', 0),
				(\'blockviewed\', \'preserve-position\', \'No\', 0),
				(\'blockviewed\', \'fit-zoom-window\', \'Yes\', 0),
				(\'blockviewed\', \'thumb-image\', \'medium\', 1),
				(\'blockviewed\', \'selector-image\', \'small\', 0),
				(\'blockviewed\', \'large-image\', \'thickbox\', 0),
				(\'blockviewed\', \'hint\', \'Yes\', 0),
				(\'blockviewed\', \'hint-text\', \'Zoom\', 0),
				(\'blockviewed\', \'hint-position\', \'top left\', 0),
				(\'blockviewed\', \'hint-opacity\', \'75\', 0),
				(\'homefeatured\', \'zoom-width\', \'300\', 0),
				(\'homefeatured\', \'zoom-height\', \'300\', 0),
				(\'homefeatured\', \'zoom-position\', \'right\', 0),
				(\'homefeatured\', \'zoom-align\', \'top\', 0),
				(\'homefeatured\', \'zoom-distance\', \'15\', 0),
				(\'homefeatured\', \'opacity\', \'50\', 0),
				(\'homefeatured\', \'opacity-reverse\', \'No\', 0),
				(\'homefeatured\', \'zoom-fade\', \'Yes\', 0),
				(\'homefeatured\', \'zoom-window-effect\', \'shadow\', 0),
				(\'homefeatured\', \'zoom-fade-in-speed\', \'200\', 0),
				(\'homefeatured\', \'zoom-fade-out-speed\', \'200\', 0),
				(\'homefeatured\', \'fps\', \'25\', 0),
				(\'homefeatured\', \'smoothing\', \'Yes\', 0),
				(\'homefeatured\', \'smoothing-speed\', \'40\', 0),
				(\'homefeatured\', \'initialize-on\', \'load\', 0),
				(\'homefeatured\', \'click-to-activate\', \'No\', 0),
				(\'homefeatured\', \'click-to-deactivate\', \'No\', 0),
				(\'homefeatured\', \'show-loading\', \'Yes\', 0),
				(\'homefeatured\', \'loading-msg\', \'Loading zoom...\', 0),
				(\'homefeatured\', \'loading-opacity\', \'75\', 0),
				(\'homefeatured\', \'loading-position-x\', \'-1\', 0),
				(\'homefeatured\', \'loading-position-y\', \'-1\', 0),
				(\'homefeatured\', \'entire-image\', \'No\', 0),
				(\'homefeatured\', \'show-title\', \'top\', 0),
				(\'homefeatured\', \'enable-effect\', \'No\', 1),
				(\'homefeatured\', \'link-to-product-page\', \'Yes\', 0),
				(\'homefeatured\', \'show-message\', \'No\', 1),
				(\'homefeatured\', \'message\', \'Move your mouse over image\', 0),
				(\'homefeatured\', \'right-click\', \'No\', 0),
				(\'homefeatured\', \'disable-zoom\', \'No\', 0),
				(\'homefeatured\', \'always-show-zoom\', \'No\', 0),
				(\'homefeatured\', \'drag-mode\', \'No\', 0),
				(\'homefeatured\', \'move-on-click\', \'Yes\', 0),
				(\'homefeatured\', \'x\', \'-1\', 0),
				(\'homefeatured\', \'y\', \'-1\', 0),
				(\'homefeatured\', \'preserve-position\', \'No\', 0),
				(\'homefeatured\', \'fit-zoom-window\', \'Yes\', 0),
				(\'homefeatured\', \'thumb-image\', \'home\', 1),
				(\'homefeatured\', \'selector-image\', \'small\', 0),
				(\'homefeatured\', \'large-image\', \'thickbox\', 0),
				(\'homefeatured\', \'hint\', \'Yes\', 0),
				(\'homefeatured\', \'hint-text\', \'Zoom\', 0),
				(\'homefeatured\', \'hint-position\', \'top left\', 0),
				(\'homefeatured\', \'hint-opacity\', \'75\', 0)';
		return Db::getInstance()->Execute($sql);
	}

	function getBlocks() {
		return array(
			'default' => 'Defaults',
			'product' => 'Product page',
			'category' => 'Category page',
			'manufacturer' => 'Manufacturers page',
			'newproductpage' => 'New products page',
			'blocknewproducts' => 'New products block',
			'bestsellerspage' => 'Best sellers page',
			'blockbestsellers' => 'Best sellers block',
			'specialspage' => 'Specials page',
			'blockspecials' => 'Specials block',
			'blockviewed' => 'Viewed block',
			'homefeatured' => 'Featured block'
		);
	}

	function getMessages() {
		return array(
			'default' => array(
				'loading-msg' => array(
					'title' => 'Defaults loading message',
					'translate' => $this->l('Defaults loading message')
				),
				'message' => array(
					'title' => 'Defaults message (under Magic Zoom)',
					'translate' => $this->l('Defaults message (under Magic Zoom)')
				)
			),
			'product' => array(
				'loading-msg' => array(
					'title' => 'Product page loading message',
					'translate' => $this->l('Product page loading message')
				),
				'message' => array(
					'title' => 'Product page message (under Magic Zoom)',
					'translate' => $this->l('Product page message (under Magic Zoom)')
				)
			),
			'category' => array(
				'loading-msg' => array(
					'title' => 'Category page loading message',
					'translate' => $this->l('Category page loading message')
				),
				'message' => array(
					'title' => 'Category page message (under Magic Zoom)',
					'translate' => $this->l('Category page message (under Magic Zoom)')
				)
			),
			'manufacturer' => array(
				'loading-msg' => array(
					'title' => 'Manufacturers page loading message',
					'translate' => $this->l('Manufacturers page loading message')
				),
				'message' => array(
					'title' => 'Manufacturers page message (under Magic Zoom)',
					'translate' => $this->l('Manufacturers page message (under Magic Zoom)')
				)
			),
			'newproductpage' => array(
				'loading-msg' => array(
					'title' => 'New products page loading message',
					'translate' => $this->l('New products page loading message')
				),
				'message' => array(
					'title' => 'New products page message (under Magic Zoom)',
					'translate' => $this->l('New products page message (under Magic Zoom)')
				)
			),
			'blocknewproducts' => array(
				'loading-msg' => array(
					'title' => 'New products block loading message',
					'translate' => $this->l('New products block loading message')
				),
				'message' => array(
					'title' => 'New products block message (under Magic Zoom)',
					'translate' => $this->l('New products block message (under Magic Zoom)')
				)
			),
			'bestsellerspage' => array(
				'loading-msg' => array(
					'title' => 'Best sellers page loading message',
					'translate' => $this->l('Best sellers page loading message')
				),
				'message' => array(
					'title' => 'Best sellers page message (under Magic Zoom)',
					'translate' => $this->l('Best sellers page message (under Magic Zoom)')
				)
			),
			'blockbestsellers' => array(
				'loading-msg' => array(
					'title' => 'Best sellers block loading message',
					'translate' => $this->l('Best sellers block loading message')
				),
				'message' => array(
					'title' => 'Best sellers block message (under Magic Zoom)',
					'translate' => $this->l('Best sellers block message (under Magic Zoom)')
				)
			),
			'specialspage' => array(
				'loading-msg' => array(
					'title' => 'Specials page loading message',
					'translate' => $this->l('Specials page loading message')
				),
				'message' => array(
					'title' => 'Specials page message (under Magic Zoom)',
					'translate' => $this->l('Specials page message (under Magic Zoom)')
				)
			),
			'blockspecials' => array(
				'loading-msg' => array(
					'title' => 'Specials block loading message',
					'translate' => $this->l('Specials block loading message')
				),
				'message' => array(
					'title' => 'Specials block message (under Magic Zoom)',
					'translate' => $this->l('Specials block message (under Magic Zoom)')
				)
			),
			'blockviewed' => array(
				'loading-msg' => array(
					'title' => 'Viewed block loading message',
					'translate' => $this->l('Viewed block loading message')
				),
				'message' => array(
					'title' => 'Viewed block message (under Magic Zoom)',
					'translate' => $this->l('Viewed block message (under Magic Zoom)')
				)
			),
			'homefeatured' => array(
				'loading-msg' => array(
					'title' => 'Featured block loading message',
					'translate' => $this->l('Featured block loading message')
				),
				'message' => array(
					'title' => 'Featured block message (under Magic Zoom)',
					'translate' => $this->l('Featured block message (under Magic Zoom)')
				)
			)
		);
	}

	function getParamsMap() {
		return array(
			'default' => array(
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'product' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'General' => array(
					'template',
					'magicscroll'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Multiple images' => array(
					'selectors-margin',
					'selectors-change',
					'selectors-class',
					'preload-selectors-small',
					'preload-selectors-big',
					'selectors-effect',
					'selectors-effect-speed',
					'selectors-mouseover-delay'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				),
				'Scroll' => array(
					'scroll-style',
					'loop',
					'speed',
					'width',
					'height',
					'item-width',
					'item-height',
					'step',
					'items'
				),
				'Scroll Arrows' => array(
					'arrows',
					'arrows-opacity',
					'arrows-hover-opacity'
				),
				'Scroll Slider' => array(
					'slider-size',
					'slider'
				),
				'Scroll effect' => array(
					'duration'
				)
			),
			'category' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'manufacturer' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'newproductpage' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'blocknewproducts' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'bestsellerspage' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'blockbestsellers' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'specialspage' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'blockspecials' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'blockviewed' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			),
			'homefeatured' => array(
				'Enable effect' => array(
					'enable-effect'
				),
				'Positioning and Geometry' => array(
					'zoom-width',
					'zoom-height',
					'zoom-position',
					'zoom-align',
					'zoom-distance'
				),
				'Effects' => array(
					'opacity',
					'opacity-reverse',
					'zoom-fade',
					'zoom-window-effect',
					'zoom-fade-in-speed',
					'zoom-fade-out-speed',
					'fps',
					'smoothing',
					'smoothing-speed'
				),
				'Initialization' => array(
					'initialize-on',
					'click-to-activate',
					'click-to-deactivate',
					'show-loading',
					'loading-msg',
					'loading-opacity',
					'loading-position-x',
					'loading-position-y',
					'entire-image'
				),
				'Title and Caption' => array(
					'show-title'
				),
				'Miscellaneous' => array(
					'link-to-product-page',
					'show-message',
					'message',
					'right-click'
				),
				'Zoom mode' => array(
					'disable-zoom',
					'always-show-zoom',
					'drag-mode',
					'move-on-click',
					'x',
					'y',
					'preserve-position',
					'fit-zoom-window'
				),
				'Image type' => array(
					'thumb-image',
					'selector-image',
					'large-image'
				),
				'Hint' => array(
					'hint',
					'hint-text',
					'hint-position',
					'hint-opacity'
				)
			)
		);
	}

    public function uninstall() {
        if(!parent::uninstall() OR !$this->uninstallDB()) return false;

        return true;
    }

    private function uninstallDB() {
        return  Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'magiczoom_settings`;')

                ;
    }

    public function getImagesTypes() {
        if(!isset($GLOBALS['magictoolbox']['imagesTypes'])) {
            $GLOBALS['magictoolbox']['imagesTypes'] = array('original');
            // get image type values
            $sql = 'SELECT name FROM `' . _DB_PREFIX_ . 'image_type` ORDER BY `id_image_type` ASC';
            $result = Db::getInstance()->ExecuteS($sql);
            foreach($result as $row) {
                $GLOBALS['magictoolbox']['imagesTypes'][] = $row['name'];
            }
        }
        return $GLOBALS['magictoolbox']['imagesTypes'];
    }

    public function getContent() {

        $tool = $this->loadTool();
        $paramsMap = $this->getParamsMap();





        foreach(array('large', 'thumb', 'selector') as $name) {

            //$tool->params->params[$name . '-image']['values'] = $this->getImagesTypes();
            foreach($this->getBlocks() as $id => $label) {
                if($tool->params->paramExists($name . '-image', $id)) {
                    $tool->params->setValues($name . '-image', $this->getImagesTypes(), $id);
                }
            }
        }

        if(isset($_POST['magic_submit'])) {
            // save settings
            if($_POST['magic_submit'] == $this->l('Save settings'))
            foreach($paramsMap as $blockId => $groups) {
                foreach($groups as $group) {
                    foreach($group as $param) {
                        if(isset($_POST[$blockId.'-'.$param])) {
                            $value = $_POST[$blockId.'-'.$param];
                            //switch($tool->params->params[$param]['type']) {
                            switch($tool->params->getType($param)) {
                                case "num":
                                    $value = intval($value);
                                    break;
                                case "array":
                                    $value = trim($value);
                                    if(!in_array($value, $tool->params->getValues($param))) $value = $tool->params->getDefaultValue($param);
                                    break;
                                case "text":
                                    $value = pSQL(trim($value));
                                    break;
                                default: $value = trim($value);
                            }
                            Db::getInstance()->Execute(
                                'UPDATE `'._DB_PREFIX_.'magiczoom_settings` SET `value`=\''.$value.'\', `enabled`=1 WHERE `block`=\''.$blockId.'\' AND `name`=\''.$param.'\''
                            );
                            $tool->params->setValue($param, $value, $blockId);
                        } else {
                            Db::getInstance()->Execute(
                                'UPDATE `'._DB_PREFIX_.'magiczoom_settings` SET `enabled`=0 WHERE `block`=\''.$blockId.'\' AND `name`=\''.$param.'\''
                            );
                            if($tool->params->paramExists($param, $blockId)) {
                                $tool->params->removeParam($param, $blockId);
                            };
                        }
                    }
                }
            }

        }

        //change subtype for some params to display them like radio
        foreach($tool->params->getParams() as $id => $param) {
            if($tool->params->getSubType($id) == 'select' && count($tool->params->getValues($id)) < 6)
                $tool->params->setSubType($id, 'radio');
        }

        // display params
        ob_start();
        include(dirname(__FILE__) . '/magiczoom.settings.tpl.php');
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    public function loadTool($profile = false, $force = false) {
        if(!isset($GLOBALS['magictoolbox']['magiczoom']['class']) || $force) {
            require_once(dirname(__FILE__) . '/magiczoom.module.core.class.php');
            $GLOBALS['magictoolbox']['magiczoom']['class'] = new MagicZoomModuleCoreClass();
            $tool = &$GLOBALS['magictoolbox']['magiczoom']['class'];
            // load current params
            $sql = 'SELECT `name`, `value`, `block` FROM `' . _DB_PREFIX_ . 'magiczoom_settings` WHERE `enabled`=1';
            $result = Db::getInstance()->ExecuteS($sql);
            foreach($result as $row) {
                $tool->params->setValue($row['name'], $row['value'], $row['block']);
            }
            // load translates
            $GLOBALS['magictoolbox']['magiczoom']['translates'] = $this->getMessages();
            foreach($this->getBlocks() as $block => $label) {

                if($GLOBALS['magictoolbox']['magiczoom']['translates'][$block]['message']['title'] != $GLOBALS['magictoolbox']['magiczoom']['translates'][$block]['message']['translate']) {
                    $tool->params->setValue('message', $GLOBALS['magictoolbox']['magiczoom']['translates'][$block]['message']['translate'], $block);
                }

                if($GLOBALS['magictoolbox']['magiczoom']['translates'][$block]['loading-msg']['title'] != $GLOBALS['magictoolbox']['magiczoom']['translates'][$block]['loading-msg']['translate']) {
                    $tool->params->setValue('loading-msg', $GLOBALS['magictoolbox']['magiczoom']['translates'][$block]['loading-msg']['translate'], $block);
                }



                // prepare image types
                foreach(array('large', 'selector', 'thumb') as $name) {
                    if($tool->params->checkValue($name . '-image', 'original', $block)) {
                        $tool->params->setValue($name . '-image', false, $block);
                    }
                }
            }

            if($tool->type == 'standard' && $tool->params->checkValue('magicscroll', 'yes', 'product')) {
                require_once(dirname(__FILE__) . '/magicscroll.module.core.class.php');
                $GLOBALS['magictoolbox']['magiczoom']['magicscroll'] = new MagicScrollModuleCoreClass();
                $scroll = &$GLOBALS['magictoolbox']['magiczoom']['magicscroll'];
                $scroll->params->setScope('MagicScroll');
                $scroll->params->appendParams($tool->params->getParams('product'));//!!!!!!!!!!!!!
                $scroll->params->setValue('direction', $scroll->params->checkValue('template', array('left', 'right')) ? 'bottom' : 'right');
            }

        }

        $tool = &$GLOBALS['magictoolbox']['magiczoom']['class'];

        if($profile) {
            $tool->params->setProfile($profile);
        }



        return $tool;
    }

    public function hookHeader($params) {

        global $smarty;
        if(Configuration::get('PS_FORCE_SMARTY_2') === "0") {
            //Smarty v3 template engine
            $getTemplateVars = 'getTemplateVars';
        } else {
            //Smarty v2 template engine
            $getTemplateVars = 'get_template_vars';
        }

        ob_start();

        $headers = '';
        $tool = $this->loadTool();
        $tool->params->resetProfile();


//         $tool = $this->loadTool('default');



        $page = $smarty->$getTemplateVars('page_name');
        switch($page) {
            case 'product':

            case 'index':


            case 'category':
            case 'manufacturer':

                break;

            case 'best-sales':
                $page = 'bestsellerspage';
                break;
            case 'new-products':
                $page = 'newproductpage';
                break;
            case 'prices-drop':
                $page = 'specialspage';
                break;

            default:
                $page = '';
        }
        //old check if(preg_match('/\/prices-drop.php$/is', $GLOBALS['_SERVER']['SCRIPT_NAME']))

        if(/*$page && */$tool->params->profileExists($page) && !$tool->params->checkValue('enable-effect', 'No', $page)


           || $page == 'index' && !$tool->params->checkValue('enable-effect', 'No', 'homefeatured') && parent::isInstalled('homefeatured') && parent::getInstanceByName('homefeatured')->active
           || !$tool->params->checkValue('enable-effect', 'No', 'blockviewed') && parent::isInstalled('blockviewed') && parent::getInstanceByName('blockviewed')->active
           || !$tool->params->checkValue('enable-effect', 'No', 'blockspecials') && parent::isInstalled('blockspecials') && parent::getInstanceByName('blockspecials')->active
           || !$tool->params->checkValue('enable-effect', 'No', 'blocknewproducts') && parent::isInstalled('blocknewproducts') && parent::getInstanceByName('blocknewproducts')->active
           || !$tool->params->checkValue('enable-effect', 'No', 'blockbestsellers') && parent::isInstalled('blockbestsellers') && parent::getInstanceByName('blockbestsellers')->active

          ) {
            // include headers
            $headers = $tool->getHeadersTemplate(_MODULE_DIR_ . 'magiczoom');

            if($tool->type == 'standard' && $tool->params->checkValue('magicscroll', 'Yes', $page)) {
                $scroll = &$GLOBALS['magictoolbox']['magiczoom']['magicscroll'];
                $headers .= $scroll->getHeadersTemplate(_MODULE_DIR_ . 'magiczoom');
            }

            if($page == 'product' && !$tool->params->checkValue('enable-effect', 'No', 'product')) {
                $headers .= '
                <script type="text/javascript">
                    var mEvent = \''.strtolower($tool->params->getValue('selectors-change', 'product')).'\';




                    var thumbnailLayout = \''.strtolower($tool->params->getValue('template', 'product')).'\';
                    var scrollThumbnails = '.($tool->params->checkValue('magicscroll', 'Yes', 'product')?'true':'false').';
                    var scrollItems = '.$tool->params->getValue('items', 'product').';


                </script>
                <script type="text/javascript" src="'._MODULE_DIR_ . 'magiczoom/product.js"></script>
                <style type="text/css">.hidden-selector {display: none !important;}</style>';
            }
            /*
                Commented as discussion in issue #0021547
            */
            /*
            $headers .= '
            <!--[if !(IE 8)]>
            <style type="text/css">
                #center_column, #left_column, #right_column {overflow: hidden !important;}
            </style>
            <![endif]-->
            ';*/

            $filter = array(Module::getInstanceByName('magiczoom'), 'parseTemplate' . ($tool->type == 'standard' ? 'Standard' : 'Category'));
            if(Configuration::get('PS_FORCE_SMARTY_2') === "0") {
                //Smarty v3 template engine

                $smarty->registerFilter('output', $filter);

            } else {
                //Smarty v2 template engine

                $smarty->register_outputfilter($filter);

            }
            $GLOBALS['magictoolbox']['filters'][] = $filter;
            // presta create new class every time when hook called
            // so we need save our data in the GLOBALS
            $GLOBALS['magictoolbox']['magiczoom']['cookie'] = $params['cookie'];
            $GLOBALS['magictoolbox']['magiczoom']['productsViewed'] = (isset($params['cookie']->viewed) AND !empty($params['cookie']->viewed)) ? explode(',', $params['cookie']->viewed) : array();
        }
        return '<!-- MTHEADERS START MAGICZOOM --> ' . $headers . '<!-- MTHEADERS END MAGICZOOM -->';
    }

    public function hookProductFooter($params) {
        //we need save this data in the GLOBALS for compatible with some Prestashop module which reset the $product smarty variable
        $GLOBALS['magictoolbox']['magiczoom']['product'] = array('id' => $params['product']->id, 'name' => $params['product']->name, 'link_rewrite' => $params['product']->link_rewrite);
        return '';
    }

    public function hookFooter($params) {

        $contents = ob_get_contents();
        ob_end_clean();

        if($GLOBALS['magictoolbox']['magiczoom']['headers'] == false) {
            $contents = preg_replace('/<\!-- MTHEADERS START MAGICZOOM .*? MTHEADERS END MAGICZOOM -->/is', '', $contents);
        } else {
            $contents = preg_replace('/<\!-- MTHEADERS (START|END) MAGICZOOM -->/is', '', $contents);
        }

        echo $contents;

        //need this for blockcart module
        //return '<img id="bigpic" src="" style="display: none;">';
        return '';
    }



    private static $outputMatches = array();

    public function prepareOutput($output, $index = 'DEFAULT') {

        if(!isset(self::$outputMatches[$index])) {
            preg_match_all('/<div [^>]*?class="[^"]*?MagicToolboxContainer[^"]*?".*?<\/div>\s/is', $output, self::$outputMatches[$index]);

            foreach(self::$outputMatches[$index][0] as $key => $match) {
                //die($match);
                $output = str_replace($match, 'MAGICZOOM_MATCH_' . $index . '_'. $key, $output);
            }
        } else {
            foreach(self::$outputMatches[$index][0] as $key => $match) {
                $output = str_replace('MAGICZOOM_MATCH_' . $index . '_'. $key, $match, $output);
            }

            unset(self::$outputMatches[$index]);
        }

        return $output;
    }

    public function parseTemplateStandard($output, $smarty) {

        $output = self::prepareOutput($output);


        if(Configuration::get('PS_FORCE_SMARTY_2') === "0") {
            //Smarty v3 template engine
            //$currentTemplate = substr(basename($smarty->_current_file), 0, -4);
            $currentTemplate = substr(basename($smarty->template_resource), 0, -4);
            if($currentTemplate == 'breadcrumb') {
                $currentTemplate = 'product';
            } elseif($currentTemplate == 'pagination') {
                $currentTemplate = 'category';
            }
            $getTemplateVars = 'getTemplateVars';
        } else {
            //Smarty v2 template engine
            $currentTemplate = $smarty->currentTemplate;
            $getTemplateVars = 'get_template_vars';
        }
        switch($currentTemplate) {
            case 'manufacturer':
                $currentTemplate = 'manufacturer';
                break;
            case 'best-sales':
                $currentTemplate = 'bestsellerspage';
                break;
            case 'new-products':
                $currentTemplate = 'newproductpage';
                break;
            case 'prices-drop':
                $currentTemplate = 'specialspage';
                break;
        }
        $tool = $this->loadTool();
        if(!$tool->params->profileExists($currentTemplate) || $tool->params->checkValue('enable-effect', 'No', $currentTemplate)) {
            return self::prepareOutput($output);
        }
        $tool->params->setProfile($currentTemplate);

        global $link;
        $cookie = &$GLOBALS['magictoolbox']['magiczoom']['cookie'];
        if(method_exists($link, 'getImageLink')) {
            $_link = &$link;
        } else {
            //for Prestashop ver 1.1
            $_link = &$this;
        }

        switch($currentTemplate) {
            case 'homefeatured':
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;

                $category = new Category(1);
                $nb = intval(Configuration::get('HOME_FEATURED_NBR'));//Number of product displayed
                $products = $category->getProducts(intval($cookie->id_lang), 1, ($nb ? $nb : 10));

                foreach($products as $product) {
                    $lrw = $product['link_rewrite'];
                    if(!$tool->params->checkValue('link-to-product-page', 'No')) {
                        $lnk = $link->getProductLink($product['id_product'], $lrw);
                    } else {
                        $lnk = false;
                    }
                    $thumb = $_link->getImageLink($lrw, $product['id_image'], $tool->params->getValue('thumb-image'));
                    $image = $tool->getMainTemplate(array(
                        'id' => 'homefeatured' . $product['id_image'],
                        'group' => 'homefeatured',
                        'link' => $lnk,
                        'img' => $_link->getImageLink($lrw, $product['id_image'], $tool->params->getValue('large-image')),
                        'thumb' => $thumb,
                        'title' => $product['name'],
                        'shortDescription' => $product['description_short'],
                        'description' => $product['description']
                    ));
                    //need a.product_image > img for blockcart module
                    $image = '<div class="MagicToolboxContainer"><div style="width:0px;height:1px;overflow:hidden;visibility:hidden;"><a class="product_image" href="#"><img src="'.$thumb.'" /></a></div>' . $image . '</div>';
                    //$image = '<div class="MagicToolboxContainer">' . $image . '</div>';
                    $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $product['id_image'], 'home'), '/') . '"[^>]*?>';
                    $pattern = '(?:<a[^>]*?href="[^"]*?"[^>]*>\s*)?' . $pattern . '(?:\s*<\/a>)?';
                    $output = preg_replace('/' . $pattern . '/is', $image, $output);
                }
                break;
            case 'category':
            case 'manufacturer':
            case 'newproductpage':
            case 'bestsellerspage':
            case 'specialspage':
                //global $p, $n, $orderBy, $orderWay;
                //$category = new Category(intval(Tools::getValue('id_category')), intval($cookie->id_lang));
                //$products = $category->getProducts(intval($cookie->id_lang), intval($p), intval($n), $orderBy, $orderWay);
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;
                $products = $smarty->$getTemplateVars('products');
                foreach($products as $product) {
                    $lrw = $product['link_rewrite'];
                    if(!$tool->params->checkValue('link-to-product-page', 'No')) {
                        $lnk = $link->getProductLink($product['id_product'], $lrw);
                    } else {
                        $lnk = false;
                    }
                    $thumb = $_link->getImageLink($lrw, $product['id_image'], $tool->params->getValue('thumb-image'));
                    $image = $tool->getMainTemplate(array(
                        'id' => 'category' . $product['id_image'],
                        'group' => 'category',
                        'link' => $lnk,
                        'img' => $_link->getImageLink($lrw, $product['id_image'], $tool->params->getValue('large-image')),
                        'thumb' => $thumb,
                        'title' => $product['name'],
                        'shortDescription' => $product['description_short'],
                        'description' => $product['description']
                    ));
                    //$image = preg_replace('/<a class="MagicZoom"/is', '<a class="MagicZoom product_img_link"', $image);
                    $image_suffix = $tool->params->getValue('thumb-image') ? '-' . $tool->params->getValue('thumb-image') : '';
                    $file_path = _PS_PROD_IMG_DIR_ . $product['id_image'] . $image_suffix . '.jpg';
                    if(!file_exists($file_path)) {
                        $split_ids = explode('-', $product['id_image']);
                        $id_image = (isset($split_ids[1]) ? $split_ids[1] : $split_ids[0]);
                        $folders = implode('/', str_split((string)$id_image)).'/';
                        $file_path = _PS_PROD_IMG_DIR_ . $folders . $id_image . $image_suffix . '.jpg';
                    }
                    $size = getimagesize($file_path);
                    //need a.product_img_link > img for blockcart module
                    $image = '<div class="MagicToolboxContainer" style="float: left; width: '.$size[0].'px; margin-right: 0.6em;" ><div style="width:0px;height:1px;overflow:hidden;visibility:hidden;"><a class="product_img_link" href="#"><img src="'.$thumb.'" /></a></div>'.$image.'</div>';
                    //$image = '<div class="MagicToolboxContainer" style="float: left; width: '.$size[0].'px; margin-right: 0.6em;" >'.$image.'</div>';
                    $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $product['id_image'], 'home'), '/') . '"[^>]*?>';
                    $pattern = '(<a[^>]*?href="[^"]*?"[^>]*>\s*)?' . $pattern . '(\s*<\/a>)?';
                    $output = preg_replace('/' . $pattern . '/is', $image, $output);
                }
                break;
            case 'product':
                if(!isset($GLOBALS['magictoolbox']['magiczoom']['product'])) {
                    //for skip loyalty module product.tpl
                    return self::prepareOutput($output);
                }
                //$product = new Product(intval($smarty->$tpl_vars['product']->id), true, intval($cookie->id_lang));
                //get some data from $GLOBALS for compatible with Prestashop modules which reset the $product smarty variable
                $product = new Product(intval($GLOBALS['magictoolbox']['magiczoom']['product']['id']), true, intval($cookie->id_lang));
                $lrw = $product->link_rewrite;
                $pid = $product->id;

                $images = $product->getImages(intval($cookie->id_lang));
                $productImages = array();
                foreach($images as $image) {
                    if ($image['cover']) {
                        $cover = $image;
                        $cover['id_image'] = intval($product->id).'-'.$cover['id_image'];
                    }
                    $productImages[intval($image['id_image'])] = $image;
                }
                if (!isset($cover)) {
                    // ensure that we have the image
                    return self::prepareOutput($output);
                }
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;
                $thumb = $_link->getImageLink($lrw, $cover['id_image'], $tool->params->getValue('thumb-image'));
                $image = $tool->getMainTemplate(array(
                    'id' => 'MainImage',
                    'img' => $_link->getImageLink($lrw, $cover['id_image'], $tool->params->getValue('large-image')),
                    'thumb' => $thumb,
                    'title' => $product->name,
                    'shortDescription' => $product->description_short,
                    'description' => $product->description
                ));

                $iTypes = $this->getImagesTypes();
                $selectors = array();
                if(count($productImages) > 0) {
                    $pattern = '<img[^>]*?src="[^"]*?{medium}"[^>]*>';
                    //$pattern = '(<a[^>]*?href="[^"]*?{thickbox}"[^>]*>\s*)?' . $pattern . '(\s*<\/a>)?';
                    $pattern = '(<a[^>]*?href="[^"]*"[^>]*>\s*)?' . $pattern . '(\s*<\/a>)?';
                    foreach($productImages as $i) {
                        $s = $tool->getSelectorTemplate(array(
                            'id' => 'MainImage',
                            'img' => $_link->getImageLink($lrw, $pid . '-' . $i['id_image'], $tool->params->getValue('large-image')),
                            'medium' => $_link->getImageLink($lrw, $pid . '-' . $i['id_image'], $tool->params->getValue('thumb-image')),
                            'thumb' => $_link->getImageLink($lrw, $pid . '-' . $i['id_image'], $tool->params->getValue('selector-image')),
                            'title' => $i['legend']
                        ));
                        $s = str_replace('<img ', '<img id="thumb_' . $i['id_image'] . '" ', $s);
                        $s = str_replace('<a ', '<a class="magicthickbox" ', $s);
                        //$p = str_replace('{thickbox}', preg_quote($_link->getImageLink($lrw, $pid . '-' . $i['id_image'], 'thickbox'), '/'), $pattern);
                        //$p = str_replace('{medium}', preg_quote($_link->getImageLink($lrw, $pid . '-' . $i['id_image'], 'medium'), '/'), $p);
                        $p = str_replace('{medium}', preg_quote($_link->getImageLink($lrw, $pid . '-' . $i['id_image'], 'medium'), '/'), $pattern);
                        $replaced = 0;
                        if($tool->params->checkValue('template', 'original')) {
                            // append selector in their preserved place
                            $output = preg_replace('/' . $p . '/is', $s, $output, -1, $replaced);
                            if(!$replaced) {
                                $p = '(<a[^>]*?href="[^"]*"[^>]*>\s*)?<img[^>]*?id="thumb_'.$i['id_image'].'"[^>]*>(\s*<\/a>)?';
                                $output = preg_replace('/' . $p . '/is', $s, $output, -1, $replaced);
                            }
                        } else {
                            // remove selector from contents
                            $output = preg_replace('/' . $p . '/is', '', $output, -1, $replaced);
                            if(!$replaced) {
                                $p = '(<a[^>]*?href="[^"]*"[^>]*>\s*)?<img[^>]*?id="thumb_'.$i['id_image'].'"[^>]*>(\s*<\/a>)?';
                                $output = preg_replace('/' . $p . '/is', $s, $output, -1, $replaced);
                            }
                            $selectors[] = $s;
                        }
                    }
                }

                // append selectors
                if(!$tool->params->checkValue('template', 'original')) {
                    //remove selectors from contents
                    $pattern = '<div id="thumbs_list">.*?<\/div>';
                    $output = preg_replace('/<div id="thumbs_list">.*?<\/div>/is', '', $output);
                    $output = preg_replace('/<\!-- thumbnails -->\s*<div id="views_block"\s*>.*?<\/div>/is', '<!-- thumbnails -->', $output);
                    $output = preg_replace('/<\!-- thumbnails -->\s*<p[^>]*><a[^>]+reset[^>]+>.*?<\/a><\/p>/is', '<!-- thumbnails -->', $output);
                    //remove "View full size" link
                    $output = preg_replace('/<li>[^<]*?<span[^>]*?id="view_full_size"[^>]*?>[^<]*?<\/span>[^<]*?<\/li>/is', '', $output);
                } else {
                    $tool->params->setValue('template', 'bottom');
                }

                // we need this sizes for template renderer
                $sql = 'SELECT name,width,height FROM `' . _DB_PREFIX_ . 'image_type` WHERE name in (\'' . $tool->params->getValue('thumb-image') . '\',\'' . $tool->params->getValue('selector-image') . '\')';
                $result = Db::getInstance()->ExecuteS($sql);
                $result[$result[0]['name']] = $result[0];
                $result[$result[1]['name']] = $result[1];
                $tool->params->setValue('thumb-max-width', $result[$tool->params->getValue('thumb-image')]['width']);
                $tool->params->setValue('thumb-max-height', $result[$tool->params->getValue('thumb-image')]['height']);
                $tool->params->setValue('selector-max-width', $result[$tool->params->getValue('selector-image')]['width']);
                $tool->params->setValue('selector-max-height', $result[$tool->params->getValue('selector-image')]['height']);

                require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'magictoolbox.templatehelper.class.php');
                MagicToolboxTemplateHelperClass::setPath(dirname(__FILE__). DIRECTORY_SEPARATOR .'templates');
                MagicToolboxTemplateHelperClass::setOptions($tool->params);
                $html = MagicToolboxTemplateHelperClass::render(array(
                    'main' => $image,
                    'thumbs' => $selectors,
                    'pid' => $pid,
                ));
                //need img#bigpic for blockcart module
                $html = preg_replace('/(<div class="MagicToolboxContainer"[^>]*>)/is', '$1<div style="width:0px;height:1px;overflow:hidden;visibility:hidden;"><img id="bigpic" src="'.$thumb.'" /></div>', $html);

                // append main image
                $replaced = 0;
                $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $cover['id_image'], 'large'), '/') . '".*?>';
                $output = preg_replace('/' . $pattern . '/is', $html, $output, -1, $replaced);
                if(!$replaced) {
                    $iTypes = $this->getImagesTypes();
                    foreach($iTypes as $iType) {
                        if($iType != 'large') {
                            $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $cover['id_image'], $iType), '/') . '".*?>';
                            $output = preg_replace('/' . $pattern . '/is', $html, $output, -1, $replaced);
                            if($replaced) break;
                        }
                    }
                }

                break;
            case 'blockspecials':
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;
                //$product = $smarty->get_template_vars('special');
                $product = $smarty->$getTemplateVars('special');
                $lrw = $product['link_rewrite'];
                if(!$tool->params->checkValue('link-to-product-page', 'No') && (!isset($_GET['id_product']) || ($_GET['id_product'] != $product['id_product']))) {
                    $lnk = $link->getProductLink($product['id_product'], $lrw);
                } else {
                    $lnk = false;
                }
                $image = $tool->getMainTemplate(array(
                    'id' => 'blockspecials' . $product['id_image'],
                    'group' => 'blockspecials',
                    'link' => $lnk,
                    'img' => $_link->getImageLink($lrw, $product['id_image'], $tool->params->getValue('large-image')),
                    'thumb' => $_link->getImageLink($lrw, $product['id_image'], $tool->params->getValue('thumb-image')),
                    'title' => $product['name'],
                    'shortDescription' => $product['description_short'],
                    'description' => $product['description']
                ));
                $image = '<div class="MagicToolboxContainer">' . $image . '</div>';
                $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $product['id_image'], 'medium'), '/') . '"[^>]*?>';
                $pattern = '(<a[^>]*?href="[^"]*?"[^>]*>\s*)?' . $pattern . '(\s*<\/a>)?';
                $output = preg_replace('/' . $pattern . '/is', $image, $output);

                break;
            case 'blockviewed':
                $productsViewed = array_slice($GLOBALS['magictoolbox']['magiczoom']['productsViewed'], 0, Configuration::get('PRODUCTS_VIEWED_NBR'));
                if(sizeof($productsViewed)) {
                    foreach($productsViewed as $id_product) {
                        $productViewedObj = new Product(intval($id_product), false, intval($cookie->id_lang));
                        if (!Validate::isLoadedObject($productViewedObj) OR !$productViewedObj->active)
                            continue;
                        else {
                            $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;
                            $images = $productViewedObj->getImages(intval($cookie->id_lang));
                            foreach($images as $image) {
                                if($image['cover']) {
                                    $productViewedObj->cover = $productViewedObj->id.'-'.$image['id_image'];
                                    $productViewedObj->legend = $image['legend'];
                                    break;
                                }
                            }
                            if(!isset($productViewedObj->cover)) {
                                $productViewedObj->cover = Language::getIsoById($cookie->id_lang).'-default';
                                $productViewedObj->legend = '';
                            }
                            $lrw = $productViewedObj->link_rewrite;
                            if(!$tool->params->checkValue('link-to-product-page', 'No') && (!isset($_GET['id_product']) || ($_GET['id_product'] != $id_product))) {
                                $lnk = $link->getProductLink($id_product, $lrw);
                            } else {
                                $lnk = false;
                            }
                            $image = $tool->getMainTemplate(array(
                                'id' => 'blockviewed' . $id_product,
                                'group' => 'blockviewed',
                                'link' => $lnk,
                                'img' => $_link->getImageLink($lrw, $productViewedObj->cover, $tool->params->getValue('large-image')),
                                'thumb' => $_link->getImageLink($lrw, $productViewedObj->cover, $tool->params->getValue('thumb-image')),
                                'title' => $productViewedObj->name,
                                'shortDescription' => $productViewedObj->description_short,
                                'description' => $productViewedObj->description
                            ));
                            $image_suffix = $tool->params->getValue('thumb-image') ? '-' . $tool->params->getValue('thumb-image') : '';
                            $file_path = _PS_PROD_IMG_DIR_ . $productViewedObj->cover . $image_suffix . '.jpg';
                            if(!file_exists($file_path)) {
                                $split_ids = explode('-', $productViewedObj->cover);
                                $id_image = (isset($split_ids[1]) ? $split_ids[1] : $split_ids[0]);
                                $folders = implode('/', str_split((string)$id_image)).'/';
                                $file_path = _PS_PROD_IMG_DIR_ . $folders . $id_image . $image_suffix . '.jpg';
                            }
                            $size = getimagesize($file_path);
                            $image = '<div class="MagicToolboxContainer" style="float: left; width: ' . $size[0] . 'px;">' . $image . '</div>';
                            $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $productViewedObj->cover, 'medium'), '/') . '"[^>]*?>';
                            $pattern = '(<a[^>]*?href="[^"]*?"[^>]*>\s*)?' . $pattern . '(\s*<\/a>)?';
                            $output = preg_replace('/' . $pattern . '/is', $image, $output);
                        }
                    }
                }
                break;
            case 'blockbestsellers':
                $blockbestsellers = true;
            case 'blocknewproducts':
                if(isset($blockbestsellers)) {
                    //$products = $smarty->$getTemplateVars('best_sellers');
                    //to get with description etc.
                    $products = ProductSale::getBestSales(intval($cookie->id_lang), 0, 4);
                } else {
                    $products = $smarty->$getTemplateVars('new_products');
                }
                $pCount = count($products);
                if($pCount) {
                    $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;
                    for($i = 0; $i < 2 && $i < $pCount; $i++) {
                        $lrw = $products[$i]['link_rewrite'];
                        if(!$tool->params->checkValue('link-to-product-page', 'No') && (!isset($_GET['id_product']) || ($_GET['id_product'] != $products[$i]['id_product']))) {
                            $lnk = $link->getProductLink($products[$i]['id_product'], $lrw);
                        } else {
                            $lnk = false;
                        }
                        $image = $tool->getMainTemplate(array(
                            'id' => $currentTemplate . $products[$i]['id_image'],
                            'group' => $currentTemplate,
                            'link' => $lnk,
                            'img' => $_link->getImageLink($lrw, $products[$i]['id_image'], $tool->params->getValue('large-image')),
                            'thumb' => $_link->getImageLink($lrw, $products[$i]['id_image'], $tool->params->getValue('thumb-image')),
                            'title' => $products[$i]['name'],
                            'shortDescription' => $products[$i]['description_short'],
                            'description' => $products[$i]['description']
                        ));
                        $image = '<div class="MagicToolboxContainer">' . $image . '</div>';
                        $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink($lrw, $products[$i]['id_image'], 'medium'), '/') . '"[^>]*?>';
                        $pattern = '(<a[^>]*?href="[^"]*?"[^>]*>\s*)?' . $pattern . '(\s*<\/a>)?';
                        $output = preg_replace('/' . $pattern . '/is', $image, $output);
                    }
                }
                break;
        }

        return self::prepareOutput($output);
    }

    public function parseTemplateCategory($output, $smarty) {

        $output = self::prepareOutput($output);

        if(Configuration::get('PS_FORCE_SMARTY_2') === "0") {
            //Smarty v3 template engine
            //$currentTemplate = substr(basename($smarty->_current_file), 0, -4);
            $currentTemplate = substr(basename($smarty->template_resource), 0, -4);
            if($currentTemplate == 'breadcrumb') {
                $currentTemplate = 'product';
            } elseif($currentTemplate == 'pagination') {
                $currentTemplate = 'category';
            }
            $getTemplateVars = 'getTemplateVars';
        } else {
            //Smarty v2 template engine
            $currentTemplate = $smarty->currentTemplate;
            $getTemplateVars = 'get_template_vars';
        }
        switch($currentTemplate) {
            case 'manufacturer':
                $currentTemplate = 'manufacturer';
                break;
            case 'best-sales':
                $currentTemplate = 'bestsellerspage';
                break;
            case 'new-products':
                $currentTemplate = 'newproductpage';
                break;
            case 'prices-drop':
                $currentTemplate = 'specialspage';
                break;
        }
        $tool = $this->loadTool();
        if(!$tool->params->profileExists($currentTemplate) || $tool->params->checkValue('enable-effect', 'No', $currentTemplate)) {
            return self::prepareOutput($output);
        }
        $tool->params->setProfile($currentTemplate);

        global $link;
        $cookie = &$GLOBALS['magictoolbox']['magiczoom']['cookie'];
        if(method_exists($link, 'getImageLink')) {
            $_link = &$link;
        } else {
            //for Prestashop ver 1.1
            $_link = &$this;
        }

        switch($currentTemplate) {
            case 'homefeatured':
                $category = new Category(1);
                $nb = intval(Configuration::get('HOME_FEATURED_NBR'));//Number of product displayed
                $products = $category->getProducts(intval($cookie->id_lang), 1, ($nb ? $nb : 10));
                $pCount = count($products);
                if(!$pCount) break;
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;

                $productImagesData = array();
                $useLink = !$tool->params->checkValue('link-to-product-page', 'No');
                foreach($products as $p_key => $product) {
                    $productImagesData[$p_key]['link'] = $useLink?$link->getProductLink($product['id_product'], $product['link_rewrite']):'';
                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['thumb'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], 'small');
                    if($tool->type == 'circle') {
                        $productImagesData[$p_key]['medium'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                        $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('large-image'));
                    } else {
                        $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                    }
                }
                $magiczoom = $tool->getMainTemplate($productImagesData, array("id" => "homefeaturedMagicZoom"));
                $pattern = '<ul[^>]*?>.*?<\/ul>';
                $output = preg_replace('/' . $pattern . '/is', $magiczoom, $output);
                break;
            case 'category':
            case 'manufacturer':
            case 'newproductpage':
            case 'bestsellerspage':
            case 'specialspage':

                break;

                $products = $smarty->$getTemplateVars('products');
                $pCount = count($products);
                if(!$pCount) break;
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;
                if($pCount < $tool->params->getValue('items')) {
                    $tool->params->setValue('items', $pCount);
                }
                $magiczoom = array();
                foreach($products as $product) {
                    $lrw = $product['link_rewrite'];
                    $img = $_link->getImageLink($lrw, $product['id_image'], 'home');
                    $pattern = '/<li class="ajax_block_product[^"]*">[^<]*<div class="center_block">((?:[^<]*<span[^>]*>[^<]*<\/span>)?[^<]*<a[^>]*>[^<]*<img[^>]*?src="'.preg_quote($img, '/').'"[^>]*>[^<]*<\/a>.*?)<\/div>[^<]*<div class="right_block">(.*?)<\/div>(?:[^<]*<br[^>]*>)?[^<]*<\/li>/is';
                    $matches = array();
                    if(preg_match($pattern, $output, $matches)) {
                        $magiczoom[] = '<div>'.$matches[1].'<div class="bottom_block">'.$matches[2].'</div></div>';
                    }
                }
                if(!empty($magiczoom)) {
                    $tool->params->setValue('item-tag', 'div');
                    $options = $tool->getPersonalOptions('categoryMagicZoom');
                    $additionalClass = '';
                    if($tool->params->checkValue('scroll-style', 'with-borders')) {
                        $additionalClass = ' msborder';
                    }
                    $magiczoom = $options.'<div id="categoryMagicZoom" class="MagicZoom'.$additionalClass.'">'.implode('', $magiczoom).'</div>';
                    $output = preg_replace('/<ul[^>]*?id="product_list"[^>]*>.*?<\/ul>/is', $magiczoom, $output);
                    $tool->params->setValue('item-tag', 'a');
                }
                break;
            case 'product':
                if(!isset($GLOBALS['magictoolbox']['magiczoom']['product'])) {
                    //for skip loyalty module product.tpl
                    return self::prepareOutput($output);
                }
                $pCount = count($smarty->$getTemplateVars('images'));
                if(!$pCount) break;


                //$product = $smarty->tpl_vars['product'];
                //get some data from $GLOBALS for compatible with Prestashop modules which reset the $product smarty variable
                $product = $GLOBALS['magictoolbox']['magiczoom']['product'];

                $productImagesData = array();
                $ids = Array();
                foreach($smarty->$getTemplateVars('images') as $image) {
                    $id_image = intval($image['id_image']);
                    $ids[] = $id_image;
                    if($image['cover']) $coverID = $id_image;
                    $productImagesData[$id_image]['title'] = /*$product->name*/$product['name'];
                    $productImagesData[$id_image]['thumb'] = $_link->getImageLink(/*$product->link_rewrite*/$product['link_rewrite'], intval(/*$product->id*/$product['id']).'-'.$id_image, $tool->params->getValue('selector-image'));
                    if($tool->type == 'circle') {
                        $productImagesData[$id_image]['medium'] = $_link->getImageLink(/*$product->link_rewrite*/$product['link_rewrite'], intval(/*$product->id*/$product['id']).'-'.$id_image, $tool->params->getValue('thumb-image'));
                        $productImagesData[$id_image]['img'] = $_link->getImageLink(/*$product->link_rewrite*/$product['link_rewrite'], intval(/*$product->id*/$product['id']).'-'.$id_image, $tool->params->getValue('large-image'));
                    } else {
                        $productImagesData[$id_image]['img'] = $_link->getImageLink(/*$product->link_rewrite*/$product['link_rewrite'], intval(/*$product->id*/$product['id']).'-'.$id_image, $tool->params->getValue('thumb-image'));
                    }
                }
                if(!isset($coverID)) {
                    // ensure that we have the image
                    break;
                }

                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;

                $magiczoom = $tool->getMainTemplate($productImagesData, array("id" => "productMagicZoom"));

                //need img#bigpic for blockcart module

                $magiczoom = '<div style="width:0px;height:0px;overflow:hidden;visibility:hidden;"><img id="bigpic" src="'.$productImagesData[$ids[0]]['img'].'" /></div>' . $magiczoom;


                $replaced = 0;
                $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink(/*$product->link_rewrite*/$product['link_rewrite'], intval(/*$product->id*/$product['id']).'-'.$coverID, 'large'), '/') . '".*?>';
                $output = preg_replace('/' . $pattern . '/is', $magiczoom, $output, -1, $replaced);
                if(!$replaced) {
                    $iTypes = $this->getImagesTypes();
                    foreach($iTypes as $iType) {
                        if($iType != 'large') {
                            $pattern = '<img src="[^"]*?' . preg_quote($_link->getImageLink(/*$product->link_rewrite*/$product['link_rewrite'], intval(/*$product->id*/$product['id']).'-'.$coverID, $iType), '/') . '".*?>';
                            $output = preg_replace('/' . $pattern . '/is', $magiczoom, $output, -1, $replaced);
                            if($replaced) break;
                        }
                    }
                }
                //remove selectors
                $output = preg_replace('/<div id="thumbs_list">.*?<\/div>/is', '', $output);
                $output = preg_replace('/<\!-- thumbnails -->\s*<div id="views_block"\s*>.*?<\/div>/is', '<!-- thumbnails -->', $output);
                $output = preg_replace('/<\!-- thumbnails -->\s*<p[^>]*><a[^>]+reset[^>]+>.*?<\/a><\/p>/is', '<!-- thumbnails -->', $output);
                //remove "View full size" link
                $output = preg_replace('/<li>[^<]*?<span[^>]*?id="view_full_size"[^>]*?>[^<]*?<\/span>[^<]*?<\/li>/is', '', $output);
                //remove "Display all pictures" link
                $output = preg_replace('/<p[^>]*>\s*<span[^>]*?id="wrapResetImages"[^>]*>.*?<\/span>\s*<\/p>/is', '', $output);
                break;
            case 'blockspecials':

                if(version_compare(_PS_VERSION_, '1.4', '<')) {
                    $products = $this->getAllSpecial(intval($cookie->id_lang));
                } else {
                    $products = Product::getPricesDrop((int)($cookie->id_lang), 0, 10, false, 'position', 'asc');
                }
                $pCount = count($products);
                if(!$pCount) break;
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;

                $productImagesData = array();
                $useLink = !$tool->params->checkValue('link-to-product-page', 'No');
                foreach($products as $p_key => $product) {
                    if($useLink && (!isset($_GET['id_product']) || ($_GET['id_product'] != $product['id_product']))) {
                        $productImagesData[$p_key]['link'] = $link->getProductLink($product['id_product'], $product['link_rewrite']);
                    } else {
                        $productImagesData[$p_key]['link'] = '';
                    }
                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['thumb'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], 'small');
                    if($tool->type == 'circle') {
                        $productImagesData[$p_key]['medium'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                        $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('large-image'));
                    } else {
                        $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                    }
                }

                $magiczoom = $tool->getMainTemplate($productImagesData, array("id" => "blockspecialsMagicZoom"));
                $pattern = '<ul[^>]*?>.*?<\/ul>';
                $output = preg_replace('/' . $pattern . '/is', $magiczoom, $output);
                break;
            case 'blockviewed':
                $productsViewed = $GLOBALS['magictoolbox']['magiczoom']['productsViewed'];
                $pCount = count($productsViewed);
                if(!$pCount) break;
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;

                $productImagesData = array();
                $useLink = !$tool->params->checkValue('link-to-product-page', 'No');
                foreach($productsViewed as $id_product) {
                    $productViewedObj = new Product(intval($id_product), false, intval($cookie->id_lang));
                    if (!Validate::isLoadedObject($productViewedObj) OR !$productViewedObj->active)
                        continue;
                    else {
                        $images = $productViewedObj->getImages(intval($cookie->id_lang));
                        foreach($images as $image) {
                            if($image['cover']) {
                                $productViewedObj->cover = $productViewedObj->id.'-'.$image['id_image'];
                                $productViewedObj->legend = $image['legend'];
                                break;
                            }
                        }
                        if(!isset($productViewedObj->cover)) {
                            $productViewedObj->cover = Language::getIsoById($cookie->id_lang).'-default';
                            $productViewedObj->legend = '';
                        }
                        $lrw = $productViewedObj->link_rewrite;
                        if($useLink && (!isset($_GET['id_product']) || ($_GET['id_product'] != $id_product))) {
                            $productImagesData[$id_product]['link'] = $link->getProductLink($id_product, $lrw);
                        } else {
                            $productImagesData[$id_product]['link'] = '';
                        }
                        $productImagesData[$id_product]['title'] = $productViewedObj->name;
                        $productImagesData[$id_product]['thumb'] = $_link->getImageLink($lrw, $productViewedObj->cover, 'small');
                        if($tool->type == 'circle') {
                            $productImagesData[$id_product]['medium'] = $_link->getImageLink($lrw, $productViewedObj->cover, $tool->params->getValue('thumb-image'));
                            $productImagesData[$id_product]['img'] = $_link->getImageLink($lrw, $productViewedObj->cover, $tool->params->getValue('large-image'));
                        } else {
                            $productImagesData[$id_product]['img'] = $_link->getImageLink($lrw, $productViewedObj->cover, $tool->params->getValue('thumb-image'));
                        }
                    }
                }
                $magiczoom = $tool->getMainTemplate($productImagesData, array("id" => "blockviewedMagicZoom"));
                $pattern = '<ul[^>]*?>.*?<\/ul>';
                $output = preg_replace('/' . $pattern . '/is', $magiczoom, $output);
                break;
            case 'blockbestsellers':
                $blockbestsellers = true;
            case 'blocknewproducts':
                if(isset($blockbestsellers)) {
                    //$products = $smarty->$getTemplateVars('best_sellers');
                    //to get with description etc.
                    $products = ProductSale::getBestSales(intval($cookie->id_lang), 0, 4);
                } else {
                    $products = $smarty->$getTemplateVars('new_products');
                }
                $pCount = count($products);
                if(!$pCount || !$products) break;
                $GLOBALS['magictoolbox']['magiczoom']['headers'] = true;

                $productImagesData = array();
                $useLink = !$tool->params->checkValue('link-to-product-page', 'No');
                foreach($products as $p_key => $product) {
                    if($useLink && (!isset($_GET['id_product']) || ($_GET['id_product'] != $product['id_product']))) {
                        $productImagesData[$p_key]['link'] = $link->getProductLink($product['id_product'], $product['link_rewrite']);
                    } else {
                        $productImagesData[$p_key]['link'] = '';
                    }
                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['thumb'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], 'small');
                    if($tool->type == 'circle') {
                        $productImagesData[$p_key]['medium'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                        $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('large-image'));
                    } else {
                        $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                    }
                }
                $magiczoom = $tool->getMainTemplate($productImagesData, array("id" => $currentTemplate."MagicZoom"));
                $pattern = '<ul[^>]*?>.*?<\/ul>';
                $output = preg_replace('/' . $pattern . '/is', $magiczoom, $output);
                break;
        }
        return self::prepareOutput($output);
    }

    public function getAllSpecial($id_lang, $beginning = false, $ending = false) {

        $currentDate = date('Y-m-d');
        $result = Db::getInstance()->ExecuteS('
        SELECT p.*, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, p.`ean13`,
            i.`id_image`, il.`legend`, t.`rate`
        FROM `'._DB_PREFIX_.'product` p
        LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.intval($id_lang).')
        LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
        LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.intval($id_lang).')
        LEFT JOIN `'._DB_PREFIX_.'tax` t ON t.`id_tax` = p.`id_tax`
        WHERE (`reduction_price` > 0 OR `reduction_percent` > 0)
        '.((!$beginning AND !$ending) ?
            'AND (`reduction_from` = `reduction_to` OR (`reduction_from` <= \''.$currentDate.'\' AND `reduction_to` >= \''.$currentDate.'\'))'
        :
            ($beginning ? 'AND `reduction_from` <= \''.$beginning.'\'' : '').($ending ? 'AND `reduction_to` >= \''.$ending.'\'' : '')).'
        AND p.`active` = 1
        ORDER BY RAND()');

        if (!$result)
            return false;

        foreach ($result as $row)
            $rows[] = Product::getProductProperties($id_lang, $row);

        return $rows;
    }

    //for Prestashop ver 1.1
    public function getImageLink($name, $ids, $type = null) {
        return _THEME_PROD_DIR_.$ids.($type ? '-'.$type : '').'.jpg';
    }

}

?>
