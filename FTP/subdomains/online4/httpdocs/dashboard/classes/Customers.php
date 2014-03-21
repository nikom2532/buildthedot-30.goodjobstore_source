<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Customers
{
	private $Address;
	private $City_ID;
	private $Cus_ID;
	private $Email;
	private $FirstName;
	private $LastName;
	private $Password;
	private $Phone_Number;
	private $Postal_Code;
	private $Same_Add;
	private $AllCustomer;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Address="";
	  $this->City_ID="";
	  $this->Cus_ID="";
	  $this->Email="";
	  $this->FirstName="";
	  $this->LastName="";
	  $this->Password="";
	  $this->Phone_Number="";
	  $this->Postal_Code="";
	  $this->Same_Add="";
	  $this->AllCustomer="";
	}
//End Construct

//Properties
	public function getAllCustomer()
	{
		return $this->AllCustomer;
	}
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
	public function getEmail()
	{
		return $this->Email;
	}
	public function getFirstName()
	{
		return $this->FirstName;
	}

	public function getLastName()
	{
		return $this->LastName;
	}

	public function getPassword()
	{
		return $this->Password;
	}

	public function getPhone_Number()
	{
		return $this->Phone_Number;
	}

	public function getPostal_Code()
	{
		return $this->Postal_Code;
	}
	public function getSame_Add()
	{
		return $this->Same_Add;
	}
	public function setAllCustomer($newVal)
	{
		$this->AllCustomer = $newVal;
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
	public function setPassword($newVal)
	{
		$this->Password = $newVal;
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
	/**
	 * 
	 * @param newVal
	 */
	public function setSame_Add($newVal)
	{
		$this->Same_Add = $newVal;
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
			$this->Email=$row['Email'];
			$this->Password=$row['Password'];
			//$this->Same_Add=$row['Same_Add'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Cus_ID)
	{
	    $strSQL="SELECT  *  FROM customers WHERE Cus_ID='".$Cus_ID."'";
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

	public function insertAll($Cus_ID,$FirstName,$LastName,$Address,$City_ID,$Postal_Code,$Phone_Number,$Email,$Password,$Same_Add)
	{
	    $strSQL="INSERT INTO customers (Cus_ID,FirstName,LastName,Address,City_ID,Postal_Code,Phone_Number,Email,Password,Same_Add) VALUES ('".$Cus_ID."','".$FirstName."','".$LastName."','".$Address."',".$City_ID.",'".$Postal_Code."','".$Phone_Number."','".$Email."','".$Password."',".$Same_Add.")";
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
		return $code;
	}
	public function Dbdelete($Cus_ID)
	{
	    $strSQL="DELETE FROM customers WHERE Cus_ID='".$Cus_ID."'";
	    $Dbcon= new Connection();
		$code=0;
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
	public function createCus_ID()
	{
	    $strSQL="SELECT  *  FROM customers ORDER BY Cus_ID DESC";
	    $Dbcon= new Connection();
		$code=0;

		try
		{
		  $temp_Cus_ID="P00001";
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bind($result);
		  $Dbcon->Dbclose();
		  if(isset($this->Cus_ID))
		  {
				$p=$this->Cus_ID{0};
				$x1=$this->Cus_ID{1};
				$x2=$this->Cus_ID{2};
				$x3=$this->Cus_ID{3};
				$x4=$this->Cus_ID{4};
				$x5=$this->Cus_ID{5};
				$remainder=0;
				$x5 = $x5 + 1;
				if($x5>9)
			    {
					$x5=0;
					$remainder=1;
				}
				if($remainder > 0)
			    {
				  $x4 = $x4 + $remainder;
				  if($x4>9)
			      {
					$x4=0;
					$remainder=1;
				  }
				}
				if($remainder > 0)
			    {
				  $x3 = $x3 + $remainder;
				  if($x3>9)
			      {
					$x3=0;
					$remainder=1;
				  }
				}
				if($remainder > 0)
			    {
				  $x2 = $x2 + $remainder;
				  if($x2>9)
			      {
					$x2=0;
					$remainder=1;
				  }
				}
				if($remainder > 0)
			    {
				  $x1 = $x1 + $remainder;
				  if($x4>9)
			      {
					  $code= -1;
					  throw new Exception("Overflow Cus_ID");
				  }
				}
				$temp_Cus_ID=$p.$x1.$x2.$x3.$x4.$x5;	
		  }
		  $code= $temp_Cus_ID;
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
		}
		catch(Exception $e)
		{
		    $code="P00001";
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
	public function check($email,$password)
	{
		$strSQL="SELECT  *  FROM customers WHERE Email='".$email."' and Password='".$password."'" ;
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bind($result); 
		  $Dbcon->Dbclose();
		  if($this->Email == $email && $this->Password == $password)
		  {
			$code = 0;
		  
		  }
		  else
		  {
			$code = -1;
		  }
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
	public function register($Cus_id,$Email,$Password)
	{
		$strSQL="INSERT INTO customers (Cus_ID,Email,Password) VALUES ('".$Cus_id."','".$Email."','".$Password."')";
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
	public function cus($get_cusid)
	{
		$strSQL="SELECT  *  FROM customers WHERE Cus_ID='".$get_cusid."'" ;
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
	public function billing_insert($firstname,$lastname,$address,$postcode,$phonenumber,$email)
	{
	    $strSQL="INSERT INTO customers (FirstName,LastName,Address,Postal_Code,Phone_Number,Email,Password) VALUES ('".$firstname."','".$lastname."','".$address."','".$postcode."','".$phonenumber."','".$email."')";
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
	public function insert($firstname,$id,$lastname,$phonenumber,$address,$postcode,$email)
	{
		$strSQL="UPDATE customers set FirstName = '".$firstname."',LastName = '".$lastname."',Phone_Number = '".$phonenumber."',Address = '".$address."',Postal_Code = '".$postcode."',Email = '".$email."' where Cus_ID = '".$id."'";		
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
	public function allCustomer()
	{
	    $strSQL="select * from customers";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindHTML($result);
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
	private function bindHTML($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
						<th width=\"100px\"><h3>ID</h3></th>
						<th width=\"100px\"><h3>First Name</h3></th>
						<th width=\"100px\"><h3>Last Name</h3></th>
						<th width=\"120px\"><h3>Address</h3></th>
						<th width=\"200px\"><h3>Email</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $dataset .= "<tr >";
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Cus_ID'] . "</td>";
             $dataset .= "<td height=\"25px\">" . $row['FirstName'] . "</td>";
			 $dataset .= "<td height=\"25px\">" . $row['LastName'] . "</td>";
			 $dataset .= "<td height=\"25px\">" . $row['Address'] ."</td>";
			 $dataset .= "<td height=\"25px\">" . $row['Email'] ."</td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllCustomer($dataset);
			
	}
//End Operation

}
?>