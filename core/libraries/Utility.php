<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Utitily Class
 *
 * This class is based on a library I found at Zend:
 * http://www.zend.com/codex.php?id=696&single=1
 *
 * The original library is a little rough around the edges so I
 * refactored it and added several additional methods -- Rick Ellis
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Utility
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/zip.html
 */
class CI_Utility  {

	
	/**
	 * Constructor
	 */
	public function __construct() {
		
	}
	
    public function dump($vars, $label = '', $return = false) {
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
    
    public function array_to_hashmap(& $arr, $keyField, $valueField = null)
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
?>