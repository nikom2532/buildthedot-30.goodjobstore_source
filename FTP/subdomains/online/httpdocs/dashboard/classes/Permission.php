<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Permission
{
	private $Delete;
	private $Edit;
	private $Permission_ID;
	private $Read;
	private $User;
	private $Write;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Delete="";
		 $this->Edit="";
		 $this->Permission_ID="";
		 $this->Read="";
		 $this->User="";
		 $this->Write="";
	}
//End Construct

//Properties
	public function getDelete()
	{
		return $this->Delete;
	}

	public function getEdit()
	{
		return $this->Edit;
	}

	public function getPermission_ID()
	{
		return $this->Permission_ID;
	}

	public function getRead()
	{
		return $this->Read;
	}

	public function getUser()
	{
		return $this->User;
	}

	public function getWrite()
	{
		return $this->Write;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDelete($newVal)
	{
		$this->Delete = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setEdit($newVal)
	{
		$this->Edit = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPermission_ID($newVal)
	{
		$this->Permission_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setRead($newVal)
	{
		$this->Read = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setUser($newVal)
	{
		$this->User = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setWrite($newVal)
	{
		$this->Write = $newVal;
	}
//End Properties
		 $this->Delete="";
		 $this->Edit="";
		 $this->Permission_ID="";
		 $this->Read="";
		 $this->User="";
		 $this->Write="";
//Operation
	private function bind($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$row=mysql_fetch_array($ResultSet);
			$this->Permission_ID=$row['Permission_ID'];
			$this->Read=$row['Read'];
			$this->Write=$row['Write'];
			$this->Edit=$row['Edit'];
			$this->Delete=$row['Delete'];
			$this->User=$row['User'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Permission_ID)
	{
	    $strSQL="SELECT  *  FROM permission WHERE Permission_ID=".$Permission_ID;
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bind($result);
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
		}
		catch(Exception $e)
		{
		    $code= -1;
		   	try
			{
				$Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
			}
		}
		return $code;
	}

	public function insertAll($Read,$Write,$Edit,$Delete,$User)
	{
	    $strSQL="INSERT INTO permission (Read,Write,Edit,Delete,User) VALUES (".$Read.",".$Write.",".$Edit.",".$Delete.",".$User.")";
		echo $strSQL;
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  mysql_query("BEGIN");
		  $result = $Dbcon->Dbupdate($strSQL);
		  mysql_query("COMMIT");
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code= -1;
			try
			{
				$Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
			}
		}
		return $code;
	}
	public function Dbdelete($Permission_ID)
	{
	    $strSQL="DELETE FROM permission WHERE Permission_ID=".$Permission_ID;
	    $Dbcon= new Connection();
		$code= 0;
		try
		{
		  mysql_query("BEGIN");
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbupdate($strSQL);
		  mysql_query("COMMIT");
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    return -1;
			try
			{
				$Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
			}
		}
		return $code;
	}
//End Operation

}
?>