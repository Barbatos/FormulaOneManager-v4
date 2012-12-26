<?php
/*
 *  This file is part of Formula One Manager.
 *
 *  Formula One Manager is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Formula One Manager is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Formula One Manager. If not, see http://www.gnu.org/licenses/
 *
 *  @copyright  (c) Formula One Manager 2007/2012
 *  @author     Charles 'Barbatos' Duprey
 *  @email      barbatos@f1m.fr
 */

if (!defined('IN_BLD')) exit('Incorrect access attempt.');

session_start();
session_regenerate_id();

if (!isset($_SESSION['token']))
    $_SESSION['token'] = md5(uniqid(rand(), true));
	
function __autoload($name)
{
    $name = mb_strtolower($name);
    require(ENGINE_ROOT.'inc/'.$name.'.class.php');
}

require(ENGINE_ROOT.'inc/common.functions.php');

if( get_magic_quotes_gpc()):
    function remove_magic_quotes_gpc($val)
    {
        if(is_array($val))
            return array_map('remove_magic_quotes_gpc', $val);
        else
            return stripslashes($val);
    }
    $_POST = array_map( 'remove_magic_quotes_gpc', $_POST );
    $_GET = array_map( 'remove_magic_quotes_gpc', $_GET );
    $_COOKIE = array_map( 'remove_magic_quotes_gpc', $_COOKIE );
endif;


define('ENV_LOCAL', 1);
define('ENV_PROD', 2);

define('MSG_SUCCESS', 1);
define('MSG_ERROR', 2);

$Bld['env']			= ENV_LOCAL;
$Bld['microtime'] 	= microtime(true);
$Bld['time']		= time();

$Bld['request_url'] = $_SERVER['REQUEST_URI'];
$Bld['site_url']	= 'http://'.$_SERVER['SERVER_NAME'].'/';
$Bld['lang']		= 'en';


if($Bld['env'] == ENV_PROD)
	include_once(ENGINE_ROOT.'conf/prod.php');
else
	include_once(ENGINE_ROOT.'conf/local.php');
	
//Bld::$db = new DB($Bld['db']['host'], $Bld['db']['ident'], $Bld['db']['pwd'], $Bld['db']['base']);
Bld::$db = new PDO('mysql:host='.$Bld['db']['host'].';port='.$Bld['db']['port'].';dbname='.$Bld['db']['base'], $Bld['db']['ident'], $Bld['db']['pwd']);
if(!Bld::$db)
	exit('PDO connection failed.');
	
unset($Bld['db']);

/* Langs */
$L_msg = loadIniFile(SITE_ROOT.'files/lang/en/msg.ini');
if(!$L_msg)
	exit('error with L_msg!');

$Bld['config_time'] = number_format(microtime(true) - $Bld['microtime'], 4);

$user = new User($Bld);

