<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\helpers;

/**
 * Description of HelpersFunctions
 *
 * @author Вадим
 */

class HelpersFunctions 
{    
    public static function translit($title){
		 $converter = array(

	        'а' => 'a',   'б' => 'b',   'в' => 'v',

	        'г' => 'g',   'д' => 'd',   'е' => 'e',

	        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

	        'и' => 'i',   'й' => 'y',   'к' => 'k',

	        'л' => 'l',   'м' => 'm',   'н' => 'n',

	        'о' => 'o',   'п' => 'p',   'р' => 'r',

	        'с' => 's',   'т' => 't',   'у' => 'u',

	        'ф' => 'f',   'х' => 'h',   'ц' => 'c',

	        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

	        'ь' => '',  'ы' => 'y',   'ъ' => '',

	        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

	        

	        'А' => 'a',   'Б' => 'b',   'В' => 'v',

	        'Г' => 'g',   'Д' => 'd',   'Е' => 'e',

	        'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',

	        'И' => 'i',   'Й' => 'y',   'К' => 'k',

	        'Л' => 'l',   'М' => 'm',   'Н' => 'n',

	        'О' => 'o',   'П' => 'p',   'Р' => 'r',

	        'С' => 's',   'Т' => 't',   'У' => 'u',

	        'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',

	        'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',

	        'Ь' => '',  'Ы' => 'y',   'Ъ' => '',

	        'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',  '"' => '',
                
                 ' ' => '_', '-' => '_', '«' => '', '»' => '', '.' => '',
                 
                 ',' => ''

	    );

		return strtr($title, $converter);
	}
        
        public static function arrForList($arr = array())
        {
            $new_arr = array();
            foreach($arr as $key => $value){
                $new_arr[$key] = $value['title'];
            }
            return $new_arr;
        }
}
