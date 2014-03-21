<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Employees
{
	private $Address;
	private $City_ID;
	private $Email;
	private $Emp_ID;
	private $FirstName;
	private $LastName;
	private $Password;
	private $Phone_Number;
	private $Position_ID;
	private $Postal_Code;
	private $AllEmployee;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Address="";
	  $this->City_ID="";
	  $this->Email="";
	  $this->Emp_ID="";
	  $this->FirstName="";
	  $this->LastName="";
	  $this->Password="";
	  $this->Phone_Number="";
	  $this->Position_ID="";
	  $this->Postal_Code="";
	  $this->AllEmployee="";
	}
//End Construct

//Properties
	public function getAllEmployee()
	{
		return $this->AllEmployee;
	}
	public function getAddress()
	{
		return $this->Address;
	}

	public function getCity_ID()
	{
		return $this->City_ID;
	}

	public function getEmail()
	{
		return $this->Email;
	}

	public function getEmp_ID()
	{
		return $this->Emp_ID;
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

	public function getPosition_ID()
	{
		return $this->Position_ID;
	}

	public function getPostal_Code()
	{
		return $this->Postal_Code;
	}
	
	public function setAllEmployee($newVal)
	{
		$this->AllEmployee = $newVal;
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
	public function setEmail($newVal)
	{
		$this->Email = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setEmp_ID($newVal)
	{
		$this->Emp_ID = $newVal;
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
	public function setPosition_ID($newVal)
	{
		$this->Position_ID = $newVal;
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
			$this->Emp_ID=$row['Emp_ID'];
			$this->FirstName=$row['FirstName'];
			$this->LastName=$row['LastName'];
			$this->Address=$row['Address'];
			$this->City_ID=$row['City_ID'];
			$this->Postal_Code=$row['Postal_Code'];
			$this->Phone_Number=$row['Phone_Number'];
			$this->Position_ID=$row['Position_ID'];
			$this->Email=$row['Email'];
			$this->Password=$row['Password'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Emp_ID)
	{
	    $strSQL="SELECT  *  FROM employees WHERE Emp_ID='".$Emp_ID."'";
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

	public function insertAll($Emp_ID,$FirstName,$LastName,$Address,$City_ID,$Postal_Code,$Phone_Number,$Position_ID,$Email,$Password)
	{
	    $strSQL="INSERT INTO employees (Emp_ID,FirstName,LastName,Address,City_ID,Postal_Code,Phone_Number,Position_ID,Email,Password) VALUES ('".$Emp_ID."','".$FirstName."','".$LastName."','".$Address."',".$City_ID.",'".$Postal_Code."','".$Phone_Number."',".$Position_ID.",'".$Email."','".$Password."')";
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
	public function Dbdelete($Emp_ID)
	{
	    $strSQL="DELETE FROM employees WHERE Emp_ID='".$Emp_ID."'";
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
	public function check($email,$password)
	{
		$strSQL="SELECT  *  FROM employees WHERE Email='".$email."' and Password='".$password."'" ;
	    $Dbcon= new Connection();
		$code=-1;
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
	public function emp($get_empid)
	{
		$strSQL="SELECT  *  FROM employees WHERE Emp_ID='".$get_empid."'" ;
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
	
		public function allEmployee()
	{
	    $strSQL="select * from employees e,positions p where e.Position_ID = p.Position_ID";
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
					    <th width=\"100px\"><h3>Emp_ID</h3></th>
						<th width=\"100px\"><h3>First Name</h3></th>
						<th width=\"100px\"><h3>Last Name</h3></th>
						<th width=\"120px\"><h3>Position Name</h3></th>
						<th width=\"200px\"><h3>Email</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $dataset .= "<tr >";
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Emp_ID'] . "</td>";
             $dataset .= "<td height=\"25px\">" . $row['FirstName'] . "</td>";
			 $dataset .= "<td height=\"25px\">" . $row['LastName'] . "</td>";
			 $dataset .= "<td height=\"25px\">" . $row['Position_name'] ."</td>";
			 $dataset .= "<td height=\"25px\">" . $row['Email'] ."</td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllEmployee($dataset);
			
	}
//End Operation

}
?>