=== Plugin Name ===
Contributors: paultgoodchild
Donate link: http://www.hostliketoast.com/
Tags: Shortcodes, Library, WordPress
Requires at least: 3.2.0
Tested up to: 3.4
Stable tag: 1.6

With Wordpress Shortcode Library we bring you a collection of Shortcodes we find useful to help you get more from WordPress.

== Description ==

Currently there are 5 active shortcodes in the library: (See Changelog for updates!)

[SITENAME]
This will create a piece of HTML is your WordPress site title wrapped in a SPAN with ID "siteBrandName"
You can also change the ID by using ID="yourOwnID"

[NOSC] ... [/NOSC]
Short for "No Shortcode". Any shortcodes present within this shortcode are ignored. Useful for writing *about* shortcodes without
them being interpreted.

[TWEET]
Add a Twitter Share button for the given page wherever this shortcode is present. There are 3 optional parameters
count="none/horizontal/vertical" (optional- default is 'none')
via="your Twitter Handle" (optional)
related="another related Twitter handle" (optional)

[DIVCLEAR]
This will create a piece of HTML that is a DIV element with "style=clear:both".

[HTMLDIV] ... [/HTMLDIV]
You can add a DIV element with parameters:
class=""
id=""
style=""

You are also free to edit the file directly to add your own.

More information can be seen here: [Host Like Toast](http://www.hostliketoast.com/2011/12/how-extend-wordpress-powerful-shortcodes/ "Host Like Toast: How To Extend WordPress With Powerful Shortcodes")

== Installation ==

This plugin should install as any other Wordpress.org respository plugin.

1.	Browse to Plugins -> Add Plugin
1.	Search: Wordpress Shortcode Library
1.	Click Install
1.	Click to Activate.

Alternatively using FTP:

1.	Download the zip file using the download link to the right.
1.	Extract the contents of the file and locate the folder called 'wordpress-shortcode-library' containing the plugin files.
1.	Upload this whole folder to your '/wp-content/plugins/' directory
1.	From the plugins page within Wordpress locate the plugin 'Wordpress Shortcode Library' and click Activate

The new Shortcodes will now be available to you.

Select the CSS file as desired.

== Frequently Asked Questions ==

= There is no page to modify shortcodes? =

We haven't built a configuration page into the plugin (yet).

= How do I add Shortcodes of my own? =

Go to 'Plugins' => 'Editor'

On the top-right select 'Wordpress Shortcode Library' from the menu.

Edit as desired.

== Changelog ==

= 1.6 =

* Fix: Call-time pass-by-reference error reported: http://wordpress.org/support/topic/plugin-wordpress-shortcode-library-by-host-like-toast-fatal-error-when-activating-host-like-toast-shortcut-library?replies=1

= 1.5 =
* Added a new shortcode: [SITENAME]. This will output your WordPress site name in a SPAN with default ID "brandedSiteName".
You change the ID and also add "class" and "style" as you wish. This shortcode is useful so that if you decide to
alter the name of your site later, and you've used this shortcode throughout, it will automatically update across
your site! You can apply a consistent style for your site name text throughout the site by referencing the ID.
I started using it here: [Kick Start Valencia](http://www.kickstartvalencia.com/ "Kick Start Valencia: Start Living in Valencia")

= 1.4 =
Skipped.

= 1.3 =
* Restructured the code to be slightly cleaner so as to more easily as new shortcodes later

= 1.2 =
* Added Shortcode: [NOSC] ... [/NOSC]  Any shortcodes present within this shortcode are ignored.

= 1.1 =
* Added Shortcode: [TWEET]  (this creates a Twitter share button for the given page wherever you write it).
Parameters include:
count="none/horizontal/vertical" (optional- default is 'none')
via="your Twitter Handle" (optional)
related="another related Twitter handle" (optional)

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.6 =

* Fix: Call-time pass-by-reference error reported
