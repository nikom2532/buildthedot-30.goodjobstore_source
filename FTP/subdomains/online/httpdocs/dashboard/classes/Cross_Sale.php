<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Cross_Sale
{

	private $Cross_ID;
	private $Product_Cross_ID;
	private $Product_ID;
	private $SQL_Query;
	private $cross;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Cross_ID="";
	  $this->Product_Cross_ID="";
	  $this->Product_ID="";
	  $this->SQL_Query="";
	  $this->cross="";
	}
//End Construct

//Properties
	public function getcross()
	{
		return $this->cross;
	}
	
	public function getQuery()
	{
		return $this->SQL_Query;
	}

	public function getCross_ID()
	{
		return $this->Cross_ID;
	}

	public function getProduct_Cross_ID()
	{
		return $this->Product_Cross_ID;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	
	/**
	 * 
	 * @param newVal
	 */
	public function setcross($newVal)
	{
		$this->cross = $newVal;
	}
	/**
	 * 
	 * @param newVal
	 */
	public function setCross_ID($newVal)
	{
		$this->Cross_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_Cross_ID($newVal)
	{
		$this->Product_Cross_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_ID($newVal)
	{
		$this->Product_ID = $newVal;
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
           $this->Cross_ID=$row['Cross_ID'];
		   $this->Product_ID=$row['Product_ID'];
		   $this->Product_Cross_ID=$row['Product_Cross_ID'];
	}
	public function selectAll($Id)
	{
	    $strSQL="SELECT  *  FROM cross_sale WHERE Cross_ID=".$Id;
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
	public function insertAll($Product_ID,$Product_Cross_ID)
	{
	    $strSQL="INSERT INTO cross_sale (Product_ID,Product_Cross_ID) VALUES ('".$Product_ID."','".$Product_Cross_ID."')";
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
	public function Dbdelete($Id)
	{
	    $strSQL="DELETE FROM cross_sale WHERE Cross_ID=".$Id;
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
	public function selectQuery($Id)
	{
	    $strSQL="SELECT  c.Product_Cross_ID,m.Thumbnail_path  FROM products p ,cross_sale c ,images m WHERE 
		p.Product_ID = c.Product_ID and
		c.Product_Cross_ID = m.Product_ID and
		p.Product_ID = '".$Id ."'
		and m.Mode ='Main'";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindQuery($result);
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
	private function bindQuery($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $cross = null;
		   while($row=mysql_fetch_array($ResultSet))
		   {
           $cross .= "<li><a href='#'><img src= '".$row['Thumbnail_path']."' /></a></li>";
		   
		   /*$this->Cross_ID=$row['Cross_ID'];
		   $this->Product_ID=$row['Product_ID'];
		   $this->Product_Cross_ID=$row['Product_Cross_ID'];*/
		   }
		   $this->SQL_Query = $cross;
	}
	
			public function selectcross()
	{
	    $strSQL="SELECT * FROM products order by Product_ID";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindpro($result);
		  $Dbcon->Dbclose();
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
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
	private function bindpro($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset= null;
			while($row=mysql_fetch_array($ResultSet))
			{
			$dataset .= "<option value='".$row['Product_ID']."'>".$row['Pro_Name_En']."</option>";
			}
				$this->setcross($dataset);
	}
	
	
	
	
	
//End Operation

}
?>