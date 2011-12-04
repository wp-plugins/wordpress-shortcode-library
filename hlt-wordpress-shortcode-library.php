<?php
/* 
Plugin Name: WordPress Shortcode Library
Plugin URI: http://www.hostliketoast.com/wordpress-resource-centre/
Description: Collection of Shortcodes for Wordpress and a place for you to define your own. <a href="http://www.hostliketoast.com/2011/12/extending-wordpress-powerful-shortcodes/">See here for more information</a>.
Version: 1.1
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
	
	public function __construct() {
		$aMethods = get_class_methods( $this );
		$aExclude = array( 'def', 'cleanHtml' );
		foreach ( $aMethods as $sMethod ) {
			if ( !in_array( $sMethod, $aExclude ) ) {
				add_shortcode( strtoupper( $sMethod ), array( &$this, $sMethod ) );
			}
		}
	}//construct
	
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
	public function divClear( $inaAtts = array(), $insContent = '' ) {
		
		$sReturn = do_shortcode('[HTMLDIV style="clear:both" id="bob" class=""]'.$insContent.'[/HTMLDIV]');

		return $sReturn;

	}//divclear
	
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
	public function htmlDiv( $inaAtts = array(), $insContent = '' ) {

		$this->def( &$inaAtts, 'class' );
		$this->def( &$inaAtts, 'id' );
		$this->def( &$inaAtts, 'style' );
		
		$sReturn = '<div '.$this->cleanHtml( $inaAtts['style'], 'style' )
					.' '.$this->cleanHtml( $inaAtts['id'], 'id' )
					.' '.$this->cleanHtml( $inaAtts['class'], 'class' )
					.'>'.do_shortcode( $insContent ).'</div>';

		return $sReturn;

	}//htmlDiv
	
	public function tweet( $inaAtts = array(), $insContent = '' ) {

		$this->def( &$inaAtts, 'count', 'none' );
		$this->def( &$inaAtts, 'via' );
		$this->def( &$inaAtts, 'related' );

		$sReturn = '<a href="https://twitter.com/share" class="twitter-share-button" data-count="'.$inaAtts['count'].'"'
						. $this->cleanHtml( $inaAtts['via'], 'data-via' )
						. $this->cleanHtml( $inaAtts['related'], 'data-related' )
						.'>'.'Tweet'.'</a>';
		$sReturn .= '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
		
		return $sReturn;
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
	protected function cleanHtml( $insCont, $insTag = '' ) {
		return (($insCont != '')? ' '.$insTag.'="'.$insCont.'" ' : '' );	
	}

}//class HLT_WordPressShortcodeLibrary

$oHLT_WordPressShortcodeLibrary = new HLT_WordPressShortcodeLibrary();