<?php
/**
 * @package  Gist
 * @author   Alan Hardman <alan@phproject.org>
 * @version  0.1.0
 */

namespace Plugin\Gist;

class Base extends \Plugin
{
    /**
     * Initialize the plugin
     */
    public function _load()
    {
        // Replace Gist links with embeds
        // TODO: don't add embeds when rendering in an email
        $this->_hook('text.parse.after', function ($str) {
            // TODO: use file fragment to add ?file= parameter
            $urlPatt = '(https?://gist.github.com/[0-9A-Za-z_-]+/[0-9a-f]+)(#file-[0-9A-Za-z_-]+)?';
            $pattern = "@(<a href=\")?{$urlPatt}(\" ?(rel=\"nofollow\")? ?(target=\"_blank\")?>)?({$urlPatt})?(</a>)?@";
            $replace = '<script src="$2.js"></script>';
            return preg_replace($pattern, $replace, $str);
        });
    }
}
