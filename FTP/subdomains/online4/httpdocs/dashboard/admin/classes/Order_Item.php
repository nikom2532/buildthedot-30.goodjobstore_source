<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Order_Item
{

	private $Create_Date;
	private $Dis_Price;
	private $Discount_Flag;
	private $Item_ID;
	private $Order_ID;
	private $Product_ID;
	private $Qty;
	private $Status;
	private $Total_Price;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Create_Date="";
		 $this->Dis_Price="";
		 $this->Discount_Flag="";
		 $this->Item_ID="";
		 $this->Order_ID="";
		 $this->Product_ID="";
		 $this->Qty="";
		 $this->Status="";
		 $this->Total_Price="";
	}
//End Construct

//Properties
	public function getCreate_Date()
	{
		return $this->Create_Date;
	}

	public function getDis_Price()
	{
		return $this->Dis_Price;
	}

	public function getDiscount_Flag()
	{
		return $this->Discount_Flag;
	}

	public function getItem_ID()
	{
		return $this->Item_ID;
	}

	public function getOrder_ID()
	{
		return $this->Order_ID;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getQty()
	{
		return $this->Qty;
	}

	public function getStatus()
	{
		return $this->Status;
	}

	public function getTotal_Price()
	{
		return $this->Total_Price;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCreate_Date($newVal)
	{
		$this->Create_Date = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDis_Price($newVal)
	{
		$this->Dis_Price = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_Flag($newVal)
	{
		$this->Discount_Flag = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setItem_ID($newVal)
	{
		$this->Item_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setOrder_ID($newVal)
	{
		$this->Order_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_ID($newVal)
	{
		$this->Product_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setQty($newVal)
	{
		$this->Qty = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setStatus($newVal)
	{
		$this->Status = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTotal_Price($newVal)
	{
		$this->Total_Price = $newVal;
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
			$this->Item_ID=$row['Item_ID'];
			$this->Order_ID=$row['Order_ID'];
			$this->Product_ID=$row['Product_ID'];
			$this->Qty=$row['Qty'];
			$this->Total_Price=$row['Total_Price'];
			$this->Dis_Price=$row['Dis_Price'];
			$this->Create_Date=$row['Create_Date'];
			$this->Discount_Flag=$row['Discount_Flag'];
			$this->Status=$row['Status'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Item_ID)
	{
	    $strSQL="SELECT  *  FROM order_item WHERE Item_ID=".$Item_ID;
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

	public function insertAll($Item_ID,$Order_ID,$Product_ID,$Qty,$Total_Price,$Dis_Price,$Create_Date,$Discount_Flag,$Status)
	{
	    $strSQL="INSERT INTO order_item (Item_ID,Order_ID,Product_ID,Qty,Total_Price,Dis_Price,Create_Date,Discount_Flag,Status) VALUES ('".$Item_ID."','".$Order_ID."','".$Product_ID."',".$Qty.",".$Total_Price.",".$Dis_Price.",'".$Create_Date."',".$Discount_Flag.",'".$Status."')";
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
	public function Dbdelete($Item_ID)
	{
	    $strSQL="DELETE FROM order_item WHERE Item_ID='".$Item_ID."'";
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