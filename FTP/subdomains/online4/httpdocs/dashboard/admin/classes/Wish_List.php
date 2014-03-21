<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Wish_List
{
	private $Comment;
	private $Cus_ID;
	private $Create_Date;
	private $Product_ID;
	private $Qty;
	private $WL_ID;
	private $WL_show;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Comment;
		 $this->Cus_ID;
		 $this->Create_Date;
		 $this->Product_ID;
		 $this->Qty;
		 $this->WL_ID;
		 $this->WL_show="";
	}
//End Construct

//Properties
	public function getWL_show()
	{
		return $this->WL_show;
	}
	public function getComment()
	{
		return $this->Comment;
	}

	public function getCus_ID()
	{
		return $this->Cus_ID;
	}

	public function getCreate_Date()
	{
		return $this->Create_Date;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getQty()
	{
		return $this->Qty;
	}

	public function getWL_ID()
	{
		return $this->WL_ID;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setComment($newVal)
	{
		$this->Comment = $newVal;
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
	public function setCreate_Date($newVal)
	{
		$this->Create_Date = $newVal;
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
	public function setWL_ID($newVal)
	{
		$this->WL_ID = $newVal;
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
           $this->WL_ID=$row['WL_ID'];
		   $this->Cus_ID=$row['Cus_ID'];
		   $this->Product_ID=$row['Product_ID'];
		   $this->Create_Date=$row['Create_Date'];
		   $this->Comment=$row['Comment'];
		   $this->Qty=$row['Qty'];
	}
	public function selectAll($WL_ID)
	{
	    $strSQL="SELECT  *  FROM wish_list WHERE WL_ID='".$WL_ID."'";
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

	public function insertAll($WL_ID,$Cus_ID,$Product_ID,$Create_Date,$Comment,$Qty)
	{
	    $strSQL  ="INSERT INTO wish_list (WL_ID,Cus_ID,Product_ID,Create_Date,Comment,Qty) ";
		$strSQL .="VALUES ('".$WL_ID."','".$Cus_ID."','".$Product_ID."','".$Create_Date."','";
		$strSQL .=$Comment."',".$Qty.")";
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
	public function Dbdelete($WL_ID)
	{
	    $strSQL="DELETE FROM wish_list WHERE WL_ID=".$WL_ID;
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
		$strSQL="SELECT  *  FROM wish_list WHERE Cus_ID='".$id."'" ;
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
	public function Wishlist_Button($id,$Product_id)
	{
		$strSQL="UPDATE wish_list set Product_ID ='".$Product_id."' and  Cus_ID = '".$id."')";
		
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
	public function showAllWithProduct($product_id,$color_id)
	{
	    $strSQL="";
		   $strSQL .="SELECT p.Product_ID, p.Product_Code, p.Pro_Name_En, p.Size, p.Price_sale, p.Discount_PC,";
		   $strSQL .="p.Discount_Num, p.Discount_Status, p.Sale_min,im.Product_ID, im.Thumbnail_path,";
		   $strSQL .="im.Color_ID, c.Color_ID, c.Name_EN ";
		   $strSQL .="FROM products p, images im, color c ";
		   $strSQL .="WHERE p.Product_ID = im.Product_ID ";
		   $strSQL .="AND   im.color_ID = c.color_ID ";
		   $strSQL .="AND   c.color_ID =".$color_id ." ";
		   $strSQL .="AND   p.Product_ID='".$product_id."' ";
		   $strSQL .="GROUP BY p.Product_ID";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindWLP($result);
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
	public function showAll($Cus_ID)
	{
	    $strSQL ="";
	    $strSQL .="SELECT w.Cus_ID,w.Create_Date,w.Comment,w.Qty,p.Product_ID, p.Product_Code, p.Pro_Name_En,";
		$strSQL .="p.Size, p.Price_sale, p.Discount_PC, p.Discount_Num, p.Discount_Status,";
		$strSQL .="im.Product_ID,im.Thumbnail_path,im.Color_ID,c.Color_ID,c.Name_EN ";
		$strSQL .="FROM color c,wish_list w, products p, images im ";
		$strSQL .="WHERE c.Color_ID = w.Color_ID
                   AND w.Product_ID = p.Product_ID
                   AND p.Product_ID = im.Product_ID
                   AND w.Cus_ID = '".$Cus_ID."'
				   GROUP BY c.Color_ID
                   ORDER BY Create_Date DESC";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindWL($result);
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
	private function bindWLP($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $data="";
		   while($row=mysql_fetch_array($ResultSet))
		   {
			$data .="<tr class='body'>
			         <td><img src='".$row['Thumbnail_path']."' /></td>
					 <td></td>
					 <td>
						<textarea row='3' colum='5'> </textarea>
					</td>
					<td></td>
					<td>".date('Y-m-d')."</td>
					<td></td>
					<td>
					<!-- Action Field -->
					<table id='action'>
					<tbody>
					<tr>
						<td width='100px'></td>
						<td width='80px'></td>
						<td width='150px'>
						<input type='button' value='ADD TO CART' name='add' class='button'></td>
					</tr>
					<tr>
						<td><input type='text' name='qty' class='qty' value='".$row['Sale_min']."'></td>
						<td>QTY</td>
						 <td><input type='button' value='EDIT' name='edit' class='button'></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td><input type='button' value='ROMOVE ITEM' name='rm' class='button'</td>
					</tr>
					</tbody>
					</table>
					</td>
					</tr>
					<tr class='tableline'>
					<td>".$row['Pro_Name_En']."</td>
					<td></td>
					<td><div id='left'>Color Yellow</div> <div id='right'>Size ".$row['Size']."</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td><div id='left'>Price ".$row['Price_sale']." </div> <div id='right'>Subtotal ";
					   $total=0;
					   if($row['Discount_Status']==1)
					   {
					      if($row['Discount_PC'] > 0)
						  {
					       $total=  ($row['Price_sale'] * $row['Sale_min']) - ($row['Discount_PC']/100.0 * ($row['Price_sale'] * $row['Sale_min'])) ;
						   }
						  else
						  {
						     $total=  $row['Price_sale'] * $row['Sale_min'] ;
						  }
					   }
					   else
					   {
					      if($row['Discount_Num'] > 0)
						  {
					       $total=  ($row['Price_sale'] * $row['Sale_min']) - $row['Discount_Num'] ;
						   }
						  else
						  {
						     $total=  $row['Price_sale'] * $row['Sale_min'] ;
						  }					   
					   }
                    $data .=$total ."</div></td></tr>";
		   }
		   $this->WL_show=$data;
	}	
	private function bindWL($ResultSet)
	{
		   if (mysql_num_rows($ResultSet)==0)
		   { 
            throw new Exception('Query not executed.'); 
           }
		   $data="";
		   while($row=mysql_fetch_array($ResultSet))
		   {
			$data .="<tr class='body'>
			         <td><img src='".$row['Thumbnail_path']."' /></td>
					 <td></td>
					 <td>
						<textarea row='3' colum='5'>".$row['Comment']."</textarea>
					</td>
					<td></td>
					<td>".$row['Create_Date']."</td>
					<td></td>
					<td>
					<!-- Action Field -->
					<table id='action'>
					<tbody>
					<tr>
						<td width='100px'></td>
						<td width='80px'></td>
						<td width='150px'>
						<input type='button' value='ADD TO CART' name='add' class='button'></td>
					</tr>
					<tr>
						<td><input type='text' name='qty' class='qty' value='".$row['Qty']."'></td>
						<td>QTY</td>
						 <td><input type='button' value='EDIT' name='edit' class='button'></td>
						</tr>
						<tr>
						<td></td>
						<td></td>
						<td><input type='button' value='ROMOVE ITEM' name='rm' class='button'</td>
					</tr>
					</tbody>
					</table>
					</td>
					</tr>
					<tr class='tableline'>
					<td>".$row['Pro_Name_En']."</td>
					<td></td>
					<td><div id='left'>Color Yellow</div> <div id='right'>Size ".$row['Size']."</div></td>
					<td></td>
					<td></td>
					<td></td>
					<td><div id='left'>Price ".$row['Price_sale']." </div> <div id='right'>Subtotal ";
					   $total=0;
					   if($row['Discount_Status']==1)
					   {
					      if($row['Discount_PC'] > 0)
						  {
					       $total=  ($row['Price_sale'] * $row['Qty']) - ($row['Discount_PC']/100.0 * ($row['Price_sale'] * $row['Qty'])) ;
						   }
						  else
						  {
						     $total=  $row['Price_sale'] * $row['Qty'] ;
						  }
					   }
					   else
					   {
					      if($row['Discount_Num'] > 0)
						  {
					       $total=  ($row['Price_sale'] * $row['Qty']) - $row['Discount_Num'] ;
						   }
						  else
						  {
						     $total=  $row['Price_sale'] * $row['Qty'] ;
						  }					   
					   }
					   $data .=$total."</div></td>
					</tr>";
		   }
		   $this->WL_show=$data;
	}	
//End Operation

}
?>
