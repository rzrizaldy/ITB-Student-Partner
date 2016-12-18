<?php
error_reporting(1);

class Connection extends mysqli{
	
	function __construct(...$arg)
	{
		if(NULL!=$arg){
			parent::__construct(...$arg);
		}else{
			//parent::__construct("localhost","root","fgjhgfghgfhfbfh", "APIprogif");
			//parent::__construct("sql6.freemysqlhosting.net","sql6148447","mB5dPkzsf7", "sql6148447");
			parent::__construct("mysql.idhostinger.com","u774923342_fat","16514146f", "u774923342_gizi");
		}
	}
}


?>