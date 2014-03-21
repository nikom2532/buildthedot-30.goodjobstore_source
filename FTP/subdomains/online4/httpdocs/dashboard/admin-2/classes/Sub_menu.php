<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Sub_menu
{
	private $FK_Sub_ID;
	private $Level;
	private $Linked;
	private $Main_ID;
	private $Name_En;
	private $Name_Th;
	private $Sub_Flag;
	private $Sub_ID;
	private $Target;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->FK_Sub_ID="";
		 $this->Level="";
		 $this->Linked="";
		 $this->Main_ID="";
		 $this->Name_En="";
		 $this->Name_Th="";
		 $this->Sub_Flag="";
		 $this->Sub_ID="";
		 $this->Target="";
	}
//End Construct


//Properties
	public function getFK_Sub_ID()
	{
		return $this->FK_Sub_ID;
	}

	public function getLevel()
	{
		return $this->Level;
	}

	public function getLinked()
	{
		return $this->Linked;
	}

	public function getMain_ID()
	{
		return $this->Main_ID;
	}

	public function getName_En()
	{
		return $this->Name_En;
	}

	public function getName_Th()
	{
		return $this->Name_Th;
	}

	public function getSub_Flag()
	{
		return $this->Sub_Flag;
	}

	public function getSub_ID()
	{
		return $this->Sub_ID;
	}

	public function getTarget()
	{
		return $this->Target;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFK_Sub_ID($newVal)
	{
		$this->FK_Sub_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setLevel($newVal)
	{
		$this->Level = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setLinked($newVal)
	{
		$this->Linked = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMain_ID($newVal)
	{
		$this->Main_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setName_En($newVal)
	{
		$this->Name_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setName_Th($newVal)
	{
		$this->Name_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSub_Flag($newVal)
	{
		$this->Sub_Flag = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSub_ID($newVal)
	{
		$this->Sub_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTarget($newVal)
	{
		$this->Target = $newVal;
	}
//End Properties

//Operation
	private function bind($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $row=mysql_fetch_array($ResultSet);
           $this->Sub_ID=$row['Sub_ID'];
		   $this->Main_ID=$row['Main_ID'];
		   $this->Name_Th=$row['Name_Th'];
           $this->Name_En=$row['Name_En'];
		   $this->Linked=$row['Linked'];
		   $this->Target=$row['Target'];
		   $this->Level=$row['Level'];
		   $this->FK_Sub_ID=$row['FK_Sub_ID'];
		   $this->Sub_Flag=$row['Sub_Flag'];
	}
	public function selectAll($Sub_ID)
	{
	    $strSQL="SELECT  *  FROM sub_menu WHERE Sub_ID=".$Sub_ID;
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
		    $code=-1;
		}
		catch(Exception $e)
		{
		   $code=-1;
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

	public function insertAll($Main_ID,$Name_Th,$Name_En,$Linked,$Target,$Level,$FK_Sub_ID,$Sub_Flag)
	{
	    $strSQL  ="INSERT INTO sub_menu (Main_ID,Name_Th,Name_En,Linked,Target,Level,FK_Sub_ID,Sub_Flag) ";
		$strSQL .="VALUES ('".$Main_ID."','".$Name_Th."','".$Name_En."','".$Linked."','".$Target."',";
		$strSQL .=$Level.",".$FK_Sub_ID.",".$Sub_Flag.")";
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
		    $code=-1;
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code=-1;
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
	public function Dbdelete($Sub_ID)
	{
	    $strSQL="DELETE FROM sub_menu WHERE Sub_ID=".$Sub_ID;
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
		   $code=-1; 
		}
		catch(Exception $e)
		{
			mysql_query("ROLLBACK");
		    $code=-1;
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