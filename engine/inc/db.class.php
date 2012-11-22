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

class DB
{
	private $total_time;
	private $queries;
	
	public function __construct($host, $user, $pw, $base)
	{
		$time = microtime(true);
        $this->time = microtime(true) - $time;
		
        if($res = mysql_connect($host, $user, $pw)):
            $time = microtime(true);
			
            mysql_set_charset('utf8');
            mysql_select_db($base);
			
            $this->time += microtime(true) - $time;
		endif;
	}
	
	public function query($query)
    {
        $time = microtime(true);
		
        $result = mysql_query($query);
		
        $time = microtime(true) - $time;
        $this->time += $time;

        $this->queries[] = array('query' => $query, 'time' => $time);

        if(!$result)
			exit('query error.');
    }
	
	function arg($arg)
	{
		if(is_bool($arg))
			return $arg ? '1' : '0';
		elseif(is_int($arg))
			return "$arg";
		elseif(is_string($arg))
			return '"'.mysql_real_escape_string($arg).'"';
	}
	
	public function get_queries_count()
    {
        return count($this->queries);
    }
	
	public function last_id()
    {
        return mysql_insert_id();
    }
	
	public function fetch($query)
    {
        return mysql_fetch_assoc($query);
    }
	
	public function num_rows($query)
	{
		return mysql_num_rows($query);
	}
	
}