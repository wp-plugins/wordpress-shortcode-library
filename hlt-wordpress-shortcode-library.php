<?php
/* 
Plugin Name: WordPress Shortcode Library by Host Like Toast
Plugin URI: http://www.hostliketoast.com/wordpress-resource-centre/
Description: Collection of Shortcodes for Wordpress and a place for you to define your own. <a href="http://www.hostliketoast.com/2011/12/extending-wordpress-powerful-shortcodes/">See here for more information</a>.
Version: 1.3
Author: Host Like Toast
Author URI: http://www.hostliketoast.com 
*/

/**
 * Copyright (c) 2011 Host Like Toast <helpdesk@hostliketoast.com>
 * All rights reserved.
 * 
 * "WordPress Shortcode Library" is distributed under the GNU General Public License, Version 2,
 * June 1991. Copyright (C) 1989, 1991 Free Software Foundation, Inc., 51 Franklin
 * St, Fifth Floor, Boston, MA 02110, USA
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */
class HLT_WordPressShortcodeLibrary {
	
	protected $m_aShortcodes;
	
	public function __construct( $bInitialize = false ){
		if ($bInitialize) $this->initializeShortcodes();
	}//__construct

	protected function createShortcodeArray() {
	
		$this->m_aShortcodes = array(
			'MYFIRSTSHORTCODE'	=>	'myFirstShortCode',
			'DIVCLEAR'			=> 	'getDivClearHtml',
			'PRINTDIV'			=> 	'getDivHtml',
			'TWEET'				=>	'getTweetButtonHtml',
			'NOSC'				=>	'doNotProcessShortcode'
		);
	}
	
	protected function initializeShortcodes() {
		
		$this->createShortcodeArray();
		
		if ( function_exists('add_shortcode') ) {
			foreach( $this->m_aShortcodes as $shortcode => $function_to_call ) {
				add_shortcode($shortcode, array(&$this, $function_to_call) );
			}//foreach
		}
	}//initializeShortcodes
	
	
	/**
	 * Here you can create your own Shortcode.
	 * 
	 * The Shortcode will be called exactly the same name as the function, but in all-caps
	 * 
	 * Currently the shortcode name is "MYFIRSTSHORTCODE" and if you use it as it stand, the
	 * follow line of text will be output on your WordPress site:
	 * 
	 * 'Enter the HTML/Javascript that you want to appear'
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function myFirstShortCode( $inaAtts = array(), $insContent = '' ) {
		$sReturn = 'Enter the HTML/Javascript that you want to appear';

		return $sReturn;

	}//myFirstShortCode
	
	/**
	 * Returns an HTML string which is a <div> containing CSS to clear:both. 
	 * 
	 * If you enclose any text (including other shortcodes) between the shortcode
	 * this will be printed within the DIV.
	 * 
	 * This is an example of nested shortcodes.
	 * 
	 * @param array $inaAtts
	 * @param string $insContent
	 */
	public function getDivClearHtml( $inaAtts = array(), $insContent = '' ) {
		return $this->getDivHtml( array('style'=>'clear:both'), $insContent );
	}
	
	/**
	 * A function that will output an HTML DIV element. To give the DIV classes or an ID
	 * simply use shortcode attributes when using the shortcode in your post.
	 * 
	 * e.g. [HTMLDIV class="my-div-class" id="my-div-id"] div content [/HTMLDIV]
	 * gives: <div id="my-div-id" class="my-div-class"> div content </div>
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function getDivHtml( $inaAtts = array(), $insContent = '' ) {

		$this->def( &$inaAtts, 'class' );
		$this->def( &$inaAtts, 'id' );
		$this->def( &$inaAtts, 'style' );
		
		//Items that don't need to be printed if empty
		$inaAtts['style'] = $this->noEmptyHtml( $inaAtts['style'], 'style' );
		$inaAtts['id'] = $this->noEmptyHtml( $inaAtts['id'], 'id' );
		$inaAtts['class'] = $this->noEmptyHtml( $inaAtts['class'], 'class' );
		
		$sReturn = '<div '.$inaAtts['style']
					.$inaAtts['id']
					.$inaAtts['class']
					.'>'.do_shortcode( $insContent ).'</div>';

		return $sReturn;

	}//htmlDiv
	
	/**
	 * Prints a Twitter Share button for the current page.
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function getTweetButtonHtml( $inaAtts = array(), $insContent = '' ) {

		$this->def( &$inaAtts, 'count', 'none' );
		$this->def( &$inaAtts, 'via' );
		$this->def( &$inaAtts, 'related' );
		
		//Items that don't need to be printed if empty
		$inaAtts['via'] = $this->noEmptyHtml( $inaAtts['via'], 'data-via' );
		$inaAtts['related'] = $this->noEmptyHtml( $inaAtts['related'], 'data-related' );

		$sReturn = '<a href="https://twitter.com/share" class="twitter-share-button" data-count="'.$inaAtts['count'].'"'
						. $inaAtts['via']
						. $inaAtts['related']
						.'>'.'Tweet'.'</a>';
		$sReturn .= '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
		
		return $sReturn;
	}
	
	/**
	 * Simply prevents processing of all nested shortcodes.
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function doNotProcessShortcode( $inaAtts = array(), $insContent = '' ) {

		return $insContent;
	}

	/**
	 * A helper function; not a WordPress Shortcode.
	 */
	protected function def( &$aSrc, $insKey, $insValue = '' ) {
		if ( !isset( $aSrc[$insKey] ) ) {
			$aSrc[$insKey] = $insValue;
		}
	}
	/**
	 * A helper function; not a WordPress Shortcode.
	 */
	protected function noEmptyHtml( $insCont, $insTag = '' ) {
		return (($insCont != '')? ' '.$insTag.'="'.$insCont.'" ' : '' );	
	}

}//class HLT_WordPressShortcodeLibrary

$oHLT_WordPressShortcodeLibrary = new HLT_WordPressShortcodeLibrary( true );