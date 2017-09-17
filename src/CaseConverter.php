<?php
/**
 * PHP Case Converter
 *
 * Copyright © 2017 Yves Sorge <yves.sorge@toolpage.org>
 * https://toolpage.org/
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

/**
 * The text conversion class helps changing the cases of an existing text.
 * Get more information and online tools for this implementation on:
 * https://en.toolpage.org/cat/case-converter
 *
 * @author Yves Sorge <yves.sorge@toolpage.org>
 *        
 */
class CaseConverter {
	
	/**
	 * Converts a text into uppercase.
	 * The converted text will only consist of uppercase letters.
	 * Example input: Hello World.
	 * Example ouput: HELLO WORLD.
	 *
	 * @param string $value        	
	 * @param string $encoding        	
	 */
	public function convertToUpperCase(string $value, string $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		return mb_convert_case($value, MB_CASE_UPPER, $encoding);
	}
	
	/**
	 * Converts a text into lowercase.
	 * The converted text will only consist of lowercase letters.
	 * Example input: Hello World.
	 * Example ouput: hello world.
	 *
	 * @param string $value        	
	 * @param string $encoding        	
	 */
	public function convertToLowerCase(string $value, string $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		return mb_convert_case($value, MB_CASE_LOWER, $encoding);
	}
	
	/**
	 * Converts a text into start case / title case.
	 *
	 * @param string $value        	
	 * @param string $encoding        	
	 */
	public function convertToStartCase(string $value, string $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		return mb_convert_case($value, MB_CASE_TITLE, $encoding);
	}
	
	/**
	 * Converts a text into alternating case.
	 *
	 * @param string $value        	
	 * @param string $encoding        	
	 * @return string
	 */
	public function convertToAlternatingCase(string $value, string $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		$value = mb_convert_case ( $value, MB_CASE_LOWER, $encoding );
		$output = "";
		$len = strlen ( $value );
		$doCaps = true;
		$pattern = "/^[\s".preg_quote( "()[]{}=?!.:,-_+#~/", "/" )."]$/";
		for($i = 0; $len > $i; $i ++) {
			$char = mb_substr ( $value, $i, 1 );
			if (!preg_match ( $pattern, $char )) {
				if ($doCaps) {
					$output .= mb_convert_case( $char, MB_CASE_UPPER, "UTF-8" );
					$doCaps = false;
				} else {
					$output .= $char;
					$doCaps = true;
				}
			} else {
				$output .= $char;
			}
		}
		return $output;
	}
	
	/**
	 * Converts a text into camel case.
	 *
	 * @param string $value
	 * @param string $encoding 
	 * @return string
	 */
	public function convertToCamelCase(string $value, string $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		$stripChars = "()[]{}=?!.:,-_+\"#~/";
		$len = strlen( $stripChars );
		for($i = 0; $len > $i; $i ++) {
			$value = str_replace( $stripChars [$i], " ", $value );
		}
		$value = mb_convert_case( $value, MB_CASE_TITLE, $encoding );
		$value = preg_replace( "/\s+/", "", $value );
		return $value;
	}
	
	/**
	 * Converts a text into snake case.
	 * Example: "snake case" into "Snake_Case".
	 *
	 * @param string value
	 * @return string
	 */
	public function convertToSnakeCase(string $value, string $encoding = null){
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		$value = preg_replace("/[\(\)\[\]\{\}\=\?\!\.\:,\-_\+\\\"#~\/]/", " ", $value);
		$value = CaseConverter::convertToStartCase($value, $encoding);
		return preg_replace("/\s+/","_",trim($value));
	}

	/**
	 * Converts a text into snake case.
	 * Example: "snake case" into "Snake_Case".
	 *
	 * @param string value
	 * @return string
	 */
	public function convertToKebabCase(string $value, string $encoding = null){
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		$value = preg_replace("/[\(\)\[\]\{\}\=\?\!\.\:,\-_\+\\\"#~\/]/", " ", $value);
		$value = mb_convert_case($value, MB_CASE_LOWER, $encoding);
		return preg_replace("/\s+/","-",trim($value));
	}	

	/**
	 * Converts a text into path case.
	 * Example: "path case" into "path/case".
	 *
	 * @param string value
	 * @return string
	 */
	public function convertToKPathCase(string $value, string $encoding = null){
		$value = preg_replace("/[\(\)\[\]\{\}\=\?\!\.\:,\-_\+\\\"#~\/]/", " ", $value);
		return preg_replace("/\s+/","/",trim($value));
	}	
	
	/**
	 * Converts a text into studly caps. Studly caps is a text case where the
	 * capitalization of letters varies randomly.
	 * Example: "Studly Caps" into "stuDLY CaPS" or "STudLy CAps".
	 *
	 * @param string value
	 * @return string
	 */
	public function convertToStudlyCaps($value, $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		$returnValue = "";
		$numOfFollowingUppercase = 0;
		$numOfFollowingLowercase = 0;
		$doCapitalLetter = false;
		$value = mb_convert_case($value, MB_CASE_LOWER, $encoding);
		$len = strlen($value);
		for ($i = 0; $len > $i; $i++) {
			$c = mb_substr($value, $i, 1, $encoding);
			if (mb_convert_case( $c, MB_CASE_UPPER, $encoding ) != 
					mb_convert_case( $c, MB_CASE_LOWER, $encoding )) {
				if ($numOfFollowingUppercase < 2) {
					if (mt_rand(1,100) % 2 == 0) {
						$doCapitalLetter = true;
						$numOfFollowingUppercase++;
					} else {
						$doCapitalLetter = false;
						$numOfFollowingUppercase = 0;
					}
				} else {
					$doCapitalLetter = false;
					$numOfFollowingUppercase = 0;
				}
				if (!$doCapitalLetter) {
					$numOfFollowingLowercase++;
				}
				if ($numOfFollowingLowercase > 3) {
					$doCapitalLetter = true;
					$numOfFollowingLowercase = 0;
					$numOfFollowingUppercase++;
				}
				if ($doCapitalLetter) {
					$c = mb_convert_case( $c, MB_CASE_UPPER, $encoding );
				}
			}
			$returnValue .= $c;
		}
		return $returnValue;
	}	
	
	/**
	 * Inverts the case of a given text.
	 * Converts the spelling of each letter in the reverse order:
	 * lowercase letters are converted to uppercase and vice versa.
	 *
	 * @param string $value 
	 * @param string $encoding 
	 * @return string
	 */
	public function invertCase(string $value, string $encoding = null) {
		if ($encoding == null){
			$encoding = mb_internal_encoding();
		}
		$output = "";
		$len = strlen ( $value );
		for($i = 0; $len > $i; $i ++) {
			$char = mb_substr ( $value, $i, 1 );
			if ($char != mb_convert_case( $char, MB_CASE_UPPER, $encoding )) {
				$output .= mb_convert_case( $char, MB_CASE_UPPER, $encoding );
			} else if ($char != mb_convert_case( $char, MB_CASE_LOWER, $encoding )) {
				$output .= mb_convert_case( $char, MB_CASE_LOWER, $encoding );
			} else {
				$output .= $char;
			}
		}
		return $output;
	}
}
	
