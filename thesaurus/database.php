<?php
class Database{

	private $result = array();
	private $con = false;
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "mysqlpd11l1p12016";
    private $_database = "jurnal";

	public function connect(){
        if(!$this->con)
        {
            $myconn = @mysql_connect($this->_host,$this->_username,$this->_password);
            if($myconn)
            {
                $seldb = @mysql_select_db($this->_database,$myconn);
                if($seldb)
                {
                    $this->con = true; 
                    return true; 
                } else
                {
                    return false; 
                }
            } else
            {
                return false; 
            }
        } else
        {
            return true; 
        }
    }

    public function disconnect(){
	    if($this->con)
	    {
	        if(@mysql_close())
	        {
	                       $this->con = false; 
	            return true; 
	        }
	        else
	        {
	            return false; 
	        }
	    }
	}

	public function getToken(){
		return $this->_token;
	}

    public function getDBName(){
        return $this->_database;
    }

    public function error403(){
        $s = '<!DOCTYPE html>
                <html style="height:100%">
                <head><title> 403 Forbidden
                </title></head>
                <body style="color: #444; margin:0;font: normal 14px/20px Arial, Helvetica, sans-serif; height:100%; background-color: #fff;">
                <div style="height:auto; min-height:100%; ">     <div style="text-align: center; width:800px; margin-left: -400px; position:absolute; top: 30%; left:50%;">
                        <h1 style="margin:0; font-size:150px; line-height:150px; font-weight:bold;">403</h1>
                <h2 style="margin-top:20px;font-size: 30px;">Forbidden
                </h2>
                <p>Access to this resource on the server is denied!</p>
                </div></div></body></html>';
        return $s;
    }
}
?>