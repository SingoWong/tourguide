<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('dump'))
{
    function dump($vars, $label = '', $return = false) {
        if (ini_get('html_errors')) {
            $content = "<pre>\n";
            if ($label != '') {
                $content .= "<strong>{$label} :</strong>\n";
            }
            $content .= htmlspecialchars(print_r($vars, true));
            $content .= "\n</pre>\n";
        } else {
            $content = $label . " :\n" . print_r($vars, true);
        }
        if ($return) { return $content; }
        echo $content;
        return null;
    }
}

if ( ! function_exists('array_to_hashmap'))
{
    function array_to_hashmap(& $arr, $keyField, $valueField = null)
    {
        $ret = array();
        if ($valueField) {
            foreach ($arr as $row) {
                $ret[$row->$keyField] = $row->$valueField;
            }
        } else {
            foreach ($arr as $row) {
                $ret[$row->$keyField] = $row;
            }
        }
        return $ret;
    }
}

if ( ! function_exists('alert'))
{
    function alert($msg) {
        echo '<script>alert("'.$msg.'");</script>';
    }
}
?>