<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Shipping
{
	private $Address;
	private $City_ID;
	private $Cus_ID;
	private $FirstName;
	private $LastName;
	private $Phone_Number;
	private $Postal_Code;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Address="";
	  $this->City_ID="";
	  $this->Cus_ID="";
	  $this->FirstName="";
	  $this->LastName="";
	  $this->Phone_Number="";
	  $this->Postal_Code="";
	}
//End Construct

//Properties
	public function getAddress()
	{
		return $this->Address;
	}

	public function getCity_ID()
	{
		return $this->City_ID;
	}

	public function getCus_ID()
	{
		return $this->Cus_ID;
	}
	public function getFirstName()
	{
		return $this->FirstName;
	}

	public function getLastName()
	{
		return $this->LastName;
	}
	public function getPhone_Number()
	{
		return $this->Phone_Number;
	}

	public function getPostal_Code()
	{
		return $this->Postal_Code;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setAddress($newVal)
	{
		$this->Address = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCity_ID($newVal)
	{
		$this->City_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCus_ID($newVal)
	{
		$this->Cus_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFirstName($newVal)
	{
		$this->FirstName = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setLastName($newVal)
	{
		$this->LastName = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPhone_Number($newVal)
	{
		$this->Phone_Number = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPostal_Code($newVal)
	{
		$this->Postal_Code = $newVal;
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
			$this->Cus_ID=$row['Cus_ID'];
			$this->FirstName=$row['FirstName'];
			$this->LastName=$row['LastName'];
			$this->Address=$row['Address'];
			$this->City_ID=$row['City_ID'];
			$this->Postal_Code=$row['Postal_Code'];
			$this->Phone_Number=$row['Phone_Number'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Shipping_ID)
	{
	    $strSQL="SELECT  *  FROM shipping WHERE Shipping_ID=".$Shipping_ID;
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

	public function insertAll($Cus_ID,$FirstName,$LastName,$Address,$City_ID,$Postal_Code,$Phone_Number)
	{
	    /*$strSQL ="INSERT INTO shipping (Cus_ID,FirstName,LastName,Address,City_ID,Postal_Code,Phone_Number) "; 
		$strSQL.="VALUES ('".$Cus_ID."','".$FirstName."','".$LastName."','".$Address."',".$City_ID
		$strSQL.=",'".$Postal_Code."','".$Phone_Number."')";*/
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
	public function Dbdelete($Shipping_ID)
	{
	    $strSQL="DELETE FROM shipping WHERE Shipping_ID=".$Shipping_ID;
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
	public function cus($id)
	{
		$strSQL="SELECT  *  FROM shipping WHERE Cus_ID='".$id."'" ;
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
	public function insert($firstname,$id,$lastname,$address,$postcode)
	{
		$strSQL="UPDATE shipping set FirstName = '".$firstname."',LastName = '".$lastname."',Address = '".$address."',Postal_Code = '".$postcode."' where Cus_ID = '".$id."'";		
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
		    $code=-1;
			try
			{
			   $Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
            }
		}
	}
	public function same_billing($id)
	{
		$strSQL="UPDATE shipping set FirstName = (select FirstName from customers WHERE shipping.Cus_ID = (customers.Cus_ID) and customers.Cus_ID = '".$id."') 
		,LastName = (select LastName from customers WHERE shipping.Cus_ID = (customers.Cus_ID) and customers.Cus_ID = '".$id."')
		,Address = (select Address from customers WHERE shipping.Cus_ID = (customers.Cus_ID) and customers.Cus_ID = '".$id."')
		,Postal_Code = (select Postal_Code from customers WHERE shipping.Cus_ID = (customers.Cus_ID) and customers.Cus_ID = '".$id."')";
		
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
		    $code=-1;
			try
			{
			   $Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
            }
		}
	}
	public function createcus_id($id)
	{
	    $strSQL="INSERT INTO shipping (Cus_ID) VALUES ('".$id."')";
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
		    $code=-1;
			try
			{
			   $Dbcon->Dbclose();
			}
			catch(Exception $ex)
			{
			   
            }
		}
	}
//End Operation

}
?>