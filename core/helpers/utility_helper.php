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
    function alert($msg, $url='', $is_back=false) {
        if ($is_back) {
            $url = 'history.go(-1);';
        } else {
            $url = ($url == '') ? '' : 'top.location.href="'.$url.'";';
        }
        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title></title></head><body>';
		echo '<script>alert("'.$msg.'");'.$url.'</script></body></html>';
        
    }
}

if ( ! function_exists('pagerui'))
{
    function pagerui($data) {
		$ctr = $_GET['ctr'];
		$act = ($_GET['act']=='')?'index':$_GET['act'];
		$base_url = url($ctr.'/'.$act);
		$html = '';
		
		//输出第一页
		if ($data->current_page == '1') {
			$html .= '<span>第一頁</span>';
		} else {
			$html .= '<a href="'.$base_url.'&page=1">第一頁</a>';
		}
		
		//输出上一页
		if ($data->has_previous != '1') {
			$html .= '<span>上一頁</span>';
		} else {
			$html .= '<a href="'.$base_url.'&page='.$data->previous_page.'">上一頁</a>';
		}
		
		//输出页码
		if ($data->current_page < 5) {
			$start_i=0;
			$end_i=10;
		} elseif ($data->current_page > $data->total_pages-5) {
			$start_i=$data->total_pages-10;
			$end_i=$data->total_pages;
		} else {
			$start_i=$data->current_page-5;
			$end_i=$data->current_page+5;
		}
		if ($end_i > $data->total_pages) {
			$end_i = $data->total_pages;
		}
		if ($start_i != 0) {
			$html .= '<em>...</em>';
		}
		for ($i=$start_i;$i<$end_i;$i++) {
			$page = $i+1;
			if ($data->current_page==$page) {
				$html .= '<span class="curr_item">'.$page.'</span>';
			} else {
				$html .= '<a href="'.$base_url.'&page='.$page.'">'.$page.'</a>';
			}
		}
		if ($data->total_pages != $end_i) {
			$html .= '<em>...</em>';
		}
		
		//输出下一页
		if ($data->has_next != '1') {
			$html .= '<span>下一頁</span>';
		} else {
			$html .= '<a href="'.$base_url.'&page='.$data->next_page.'">下一頁</a>';
		}
		
		//输出第一页
		if ($data->current_page == $data->total_pages) {
			$html .= '<span>最後頁</span>';
		} else {
			$html .= '<a href="'.$base_url.'&page='.$data->total_pages.'">最後頁</a>';
		}
		
		return $html;
	}
}
?>