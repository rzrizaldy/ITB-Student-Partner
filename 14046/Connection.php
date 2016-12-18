<?php
//'error_reporting(1);

class Connection extends mysqli{
	
	function __construct(...$arg)
	{
		if(NULL!=$arg){
			parent::__construct(...$arg);
		}else{
			//parent::__construct("localhost","root","fgjhgfghgfhffbfh", "APIprogif");
			parent::__construct("sql6.freemysqlhosting.net","sql6148447","mB5dPkzsf7", "sql6148447");
		}
	}
}


?>