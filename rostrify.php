<?php
/**
 * Plugin Name: Rostrify
 * Plugin URI: https://github.com/z0d14c/rostrify
 * Description: A brief description of the plugin.
 * Version: The plugin's version number. Example: 1.0.0
 * Author: Name of the plugin author
 * Author URI: http://URI_Of_The_Plugin_Author
 * Text Domain: Optional. Plugin's text domain for localization. Example: mytextdomain
 * Domain Path: Optional. Plugin's relative directory path to .mo files. Example: /locale/
 * Network:
 * License: GPL2
*/

/**
 * Unopinionated transport interface. This is what everything should expect to interact with
 */
interface MyPluginTransportInterface
{
    /**
     * @param string $url
     * @returns string
     */
    public function loadResource($url);
}

/**
 * Implementation of transport interface
 * This is what you instantiate, and does the legwork
 * Discover you don't like how it does loadResource?
 * Just make a new class, use the same interface, instantiate that instead. Job done.
 */
class MyPluginTransport implements MyPluginTransportInterface
{
    public $CLIENTID = '509447046148-7821ju5c00qvfjcno5l5cv1fd7n1vgbm.apps.googleusercontent.com';
    public $url;


    public function loadResource($url)
    {
        $url = '';
        $response = wp_remote_get($url);
        // Opinionated transport method
        return wp_remote_retrieve_body( wp_remote_get($url) );
    }
}

//secret: notasecret
// So code looks a bit like this
$transport = new MyPluginTransport();
if (!$transport instanceof MyPluginTransportInterface) {
    throw new \LogicException('whoops, transport class must implement the Transport Interface, you idiot coder.');
}
$spreadsheet = $transport->loadResource($my_resource_url);

//*  Copyright 2015  z0d14c (Thomas Grice)  (email : zodiac.mailbox@gmail.com)
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License, version 2, as
//    published by the Free Software Foundation.
//
//This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA