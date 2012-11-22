<?php

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