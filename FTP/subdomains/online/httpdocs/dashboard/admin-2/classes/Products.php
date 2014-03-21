<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Products
{
	private $Color_En;
	private $Color_Th;
	private $Description_En;
	private $Description_Th;
	private $Discount_Num;
	private $Discount_PC;
	private $Discount_Status;
	private $KeyWord;
	private $Price_Buy;
	private $Price_sale;
	private $Pro_Name_En;
	private $Pro_Name_Th;
	private $Product_ID;
	private $Product_Status;
	private $ProductType_ID;
	private $Property_En;
	private $Property_Th;
	private $Qty;
	private $Sale_max;
	private $Sale_min;
	private $Short_msg_En;
	private $Short_msg_Th;
	private $Size;
	private $Url_En;
	private $Url_Th;
	private $Weight;
	private $Product_Code;
	private $Product_image;
	private $Pro_Code;
	private $Allproduct;
	private $Allproduct_cat;
	private $Allproduct_color;
	private $Allproduct_catcolor;
	private $Allproducts;
	private $Allproduct_c;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
		 $this->Color_En="";
		 $this->Color_Th="";
		 $this->Description_En="";
		 $this->Description_Th="";
		 $this->Discount_Num="";
		 $this->Discount_PC="";
		 $this->Discount_Status="";
		 $this->KeyWord="";
		 $this->Price_Buy="";
		 $this->Price_sale="";
		 $this->Pro_Name_En="";
		 $this->Pro_Name_Th="";
		 $this->Product_ID="";
		 $this->Product_Code="";
		 $this->Product_Status="";
		 $this->ProductType_ID="";
		 $this->Property_En="";
		 $this->Property_Th="";
		 $this->Qty="";
		 $this->Sale_max="";
		 $this->Sale_min="";
		 $this->Short_msg_En="";
		 $this->Short_msg_Th="";
		 $this->Size="";
		 $this->Url_En="";
		 $this->Url_Th="";
		 $this->Weight="";
		 $this->Product_image="";
		 $this->Pro_code="";
		 $this->Allproduct="";
		 $this->Allproduct_cat="";
		 $this->Allproduct_color="";
	     $this->Allproduct_catcolor="";
		 $this->Allproducts="";
		 $this->Allproduct_c="";
	}

//End Construct

//Properties
	
	
	public function getAllproduct_c()
	{
		return $this->Allproduct_c;
	}
	public function getAllproducts()
	{
		return $this->Allproducts;
	}
	public function getAllproduct_cat()
	{
		return $this->Allproduct_cat;
	}
	public function getAllproduct_color()
	{
		return $this->Allproduct_color;
	}
	public function getAllproduct_catcolor()
	{
		return $this->Allproduct_catcolor;
	}
	public function getAllproduct()
	{
		return $this->Allproduct;
	}
	public function getPro_code()
	{
		return $this->Pro_code;
	}
	public function getProduct_image()
	{
		return $this->Product_image;
	}
	
	public function getColor_En()
	{
		return $this->Color_En;
	}

	public function getColor_Th()
	{
		return $this->Color_Th;
	}

	public function getDescription_En()
	{
		return $this->Description_En;
	}

	public function getDescription_Th()
	{
		return $this->Description_Th;
	}

	public function getDiscount_Num()
	{
		return $this->Discount_Num;
	}

	public function getDiscount_PC()
	{
		return $this->Discount_PC;
	}

	public function getDiscount_Status()
	{
		return $this->Discount_Status;
	}

	public function getKeyWord()
	{
		return $this->KeyWord;
	}

	public function getPrice_Buy()
	{
		return $this->Price_Buy;
	}

	public function getPrice_sale()
	{
		return $this->Price_sale;
	}

	public function getPro_Name_En()
	{
		return $this->Pro_Name_En;
	}

	public function getPro_Name_Th()
	{
		return $this->Pro_Name_Th;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getProduct_Code()
	{
		return $this->Product_Code;
	}
	
	public function getProduct_Status()
	{
		return $this->Product_Status;
	}

	public function getProductType_ID()
	{
		return $this->ProductType_ID;
	}

	public function getProperty_En()
	{
		return $this->Property_En;
	}

	public function getProperty_Th()
	{
		return $this->Property_Th;
	}

	public function getQty()
	{
		return $this->Qty;
	}

	public function getSale_max()
	{
		return $this->Sale_max;
	}

	public function getSale_min()
	{
		return $this->Sale_min;
	}

	public function getShort_msg_En()
	{
		return $this->Short_msg_En;
	}

	public function getShort_msg_Th()
	{
		return $this->Short_msg_Th;
	}

	public function getSize()
	{
		return $this->Size;
	}

	public function getUrl_En()
	{
		return $this->Url_En;
	}

	public function getUrl_Th()
	{
		return $this->Url_Th;
	}

	public function getWeight()
	{
		return $this->Weight;
	}
	
	public function setAllproduct_c($newVal)
	{
		$this->Allproduct_c = $newVal;
	}
	public function setAllproducts($newVal)
	{
		$this->Allproducts = $newVal;
	}
	public function setAllproduct($newVal)
	{
		$this->Allproduct = $newVal;
	}
	public function setAllproduct_cat($newVal)
	{
		$this->Allproduct_cat = $newVal;
	}
	public function setAllproduct_color($newVal)
	{
		$this->Allproduct = $newVal;
	}
	public function setAllproduct_catcolor($newVal)
	{
		$this->Allproduct = $newVal;
	}
	/**
	 * 
	 * @param newVal
	 */
	public function setPro_code($newVal)
	{
		$this->Pro_code = $newVal;
	}
	/**
	 * 
	 * @param newVal
	 */
	 
	public function setProduct_image($newVal)
	{
		$this->Product_image = $newVal;
	}
	/**
	 * 
	 * @param newVal
	 */
	public function setColor_En($newVal)
	{
		$this->Color_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setColor_Th($newVal)
	{
		$this->Color_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDescription_En($newVal)
	{
		$this->Description_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDescription_Th($newVal)
	{
		$this->Description_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_Num($newVal)
	{
		$this->Discount_Num = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_PC($newVal)
	{
		$this->Discount_PC = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDiscount_Status($newVal)
	{
		$this->Discount_Status = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setKeyWord($newVal)
	{
		$this->KeyWord = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPrice_Buy($newVal)
	{
		$this->Price_Buy = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPrice_sale($newVal)
	{
		$this->Price_sale = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPro_Name_En($newVal)
	{
		$this->Pro_Name_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPro_Name_Th($newVal)
	{
		$this->Pro_Name_Th = $newVal;
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
	public function setProduct_Code($newVal)
	{
		$this->Product_Code = $newVal;
	}
	
	/**
	 * 
	 * @param newVal
	 */
	public function setProduct_Status($newVal)
	{
		$this->Product_Status = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProductType_ID($newVal)
	{
		$this->ProductType_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProperty_En($newVal)
	{
		$this->Property_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProperty_Th($newVal)
	{
		$this->Property_Th = $newVal;
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
	public function setSale_max($newVal)
	{
		$this->Sale_max = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSale_min($newVal)
	{
		$this->Sale_min = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setShort_msg_En($newVal)
	{
		$this->Short_msg_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setShort_msg_Th($newVal)
	{
		$this->Short_msg_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSize($newVal)
	{
		$this->Size = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setUrl_En($newVal)
	{
		$this->Url_En = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setUrl_Th($newVal)
	{
		$this->Url_Th = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setWeight($newVal)
	{
		$this->Weight = $newVal;
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
			$this->Product_ID=$row['Product_ID'];
			$this->Product_Code=$row['Product_Code'];
			$this->Pro_Name_Th=$row['Pro_Name_Th'];
			$this->Pro_Name_En=$row['Pro_Name_En'];
			$this->Description_Th=$row['Description_Th'];
			$this->Description_En=$row['Description_En'];
			$this->Size=$row['Size'];
			//$this->Color_Th=$row['Color_Th'];
			//$this->Color_En=$row['Color_En'];
			$this->Property_Th=$row['Property_Th'];
			$this->Property_En=$row['Property_En'];
			$this->Price_Buy=$row['Price_Buy'];
			$this->Price_sale=$row['Price_sale'];
			$this->Discount_PC=$row['Discount_PC'];
			$this->Discount_Num=$row['Discount_Num'];
			$this->Short_msg_Th=$row['Short_msg_Th'];
			$this->Short_msg_En=$row['Short_msg_En'];
			$this->Qty=$row['Qty'];
			$this->Sale_min=$row['Sale_min'];
			$this->Sale_max=$row['Sale_max'];
			$this->KeyWord=$row['KeyWord'];
			$this->Weight=$row['Weight'];
			$this->Url_Th=$row['Url_Th'];
			$this->Url_En=$row['Url_En'];
			$this->Discount_Status=$row['Discount_Status'];
			$this->Product_Status=$row['Product_Status'];
			$this->Pro_code=$row['Product_ID'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Product_ID)
	{
	    $strSQL="SELECT  *  FROM products WHERE Product_ID='".$Product_ID."'";
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

	public function insertAll()
	{
	    $strSQL  ="INSERT INTO products ";
		$strSQL .="(Product_ID,Pro_Name_Th,Pro_Name_En,Description_Th,Description_En,Size";
		$strSQL .=",Color_Th,Color_En,Property_Th,Property_En,Price_Buy,Price_sale";
		$strSQL .=",Discount_PC,Discount_Num,Short_msg_Th,Short_msg_En,Qty,Sale_min,Sale_max";
		$strSQL .=",KeyWord,Weight,Url_Th,Url_En,Discount_Status,Product_Status) ";
		$strSQL .="VALUES ('".$this->getProduct_ID()."','".$this->getPro_Name_Th()."','";
		$strSQL .=$this->getPro_Name_En()."','".$this->getDescription_Th()."','";
		$strSQL .=$this->getDescription_En()."','".$this->getSize()."','".$this->getColor_Th();
		$strSQL .="','".$this->getColor_En()."','".$this->getProperty_Th()."','";
		$strSQL .=$this->getProperty_En()."',".$this->getPrice_Buy().",".$this->getPrice_sale();
		$strSQL .=",".$this->getDiscount_PC().",".$this->getDiscount_Num().",'";
		$strSQL .=$this->getShort_msg_Th()."','".$this->getProperty_En()."',".$this->getQty();
		$strSQL .=",".$this->getSale_min().",".$this->getSale_max().",'".$this->getKeyWord();
		$strSQL .="',".$this->getWeight().",'".$this->getUrl_Th()."','".$this->getUrl_En()."',";
		$strSQL .=$this->getDiscount_Status().",'".$this->getProduct_Status()."')";
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
	public function Dbdelete($Product_ID)
	{
	    $strSQL="DELETE FROM products WHERE Product_ID='".$Product_ID."'";
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
	
	public function pro($getpro)
	{
		$strSQL="SELECT  *  FROM products WHERE Product_ID='".$getpro."'";
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
	public function createPro_ID()
	{
	    $strSQL="SELECT  *  FROM products ORDER BY Product_ID DESC";
	    $Dbcon= new Connection();
		$code=0;

		try
		{
		  $temp_Pro_ID="PR00001";
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bind($result);
		  $Dbcon->Dbclose();
		  if(isset($this->Product_ID))
		  {
				$p=$this->Product_ID{0};
				$r=$this->Product_ID{1};
				$x2=$this->Product_ID{2};
				$x3=$this->Product_ID{3};
				$x4=$this->Product_ID{4};
				$x5=$this->Product_ID{5};
				$x6=$this->Product_ID{6};
				$x7=$this->Product_ID{7};
				
				$remainder=0;
				$x7 = $x7 + 1;
				if($x7>9)
				{
					$x7=0;
					$remainder=1;
				}
				if($remainder > 0)
				{
					$x6 + $remainder;
					if($x6>9)
					{
						$x6=0;
						$remainder=1;
					}
				}
				if($remainder > 0)
				{
					$x5 + $remainder;
					if($x5>9)
					{
						$x5=0;
						$remainder=1;
					}
				}
				if($remainder > 0)
				{
					$x4 + $remainder;
					if($x4>9)
					{
						$x4=0;
						$remainder=1;
					}
				}
				if($remainder > 0)
				{
					$x3 + $remainder;
					if($x3>9)
					{
						$x3=0;
						$remainder=1;
					}
				}
				if($remainder > 0)
			    {
				  $x6 = $x6 + $remainder;
				  if($x6>9)
			      {
					  $code= -1;
					  throw new Exception("Overflow Cus_ID");
				  }
				}
				$temp_Product_ID=$p.$r.$x2.$x3.$x4.$x5.$x6.$x7;	
		  }
		  $code= $temp_Product_ID;
		}
		catch(ConnectException $ec)
		{
		    $code= -1;
		}
		catch(Exception $e)
		{
		    $code="PR000001";
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
	public function selectimage($Product_ID)
	{
	    $strSQL="SELECT  *  FROM images WHERE Product_ID='".$Product_ID."' and Status = 'Active' order by Level" ;
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindimage($result);
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
	private function bindimage($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$images = null;
			$first = 0;
			$image_2 = null;
			while($row=mysql_fetch_array($ResultSet))
			{
				if($row['Mode'] == 'Main')
				{
				$images .= "<div class='clearfix'>
							<a href='".$row['Path']."' class='jqzoom' rel='gal1'  title='' >
							<img src='".$row['Path_Small']."'  title=''>
							</a>
							</div>";
				$images .= "<br/>
							<div class='clearfix' >
							<ul id='thumblist' class='clearfix' >";
				$image_2 .="<li><a class='zoomThumbActive' href='javascript:void(0);' rel=".'"';
				$image_2 .="{gallery: 'gal1', smallimage: '".$row['Path_Small']."',largeimage: '".$row['Path']."'".'}">';
				$image_2 .="<img src='".$row['Thumbnail_path']."'></a></li>";
				}
				else
				{
				$image_2 .="<li><a href='javascript:void(0);' rel=".'"';
				$image_2 .="{gallery: 'gal1', smallimage: '".$row['Path_Small']."',largeimage: '".$row['Path']."'}".'">';
				$image_2 .="<img src= '".$row['Thumbnail_path']."'></a>";
				$image_2 .="</li>";
				
				
				}
			}
				$image_2 .="</ul>
							</div>";
				$images .= $image_2;
				$this->Product_image = $images;
	}
	//Back Office
	
	public function selectPro_code()
	{
	    $strSQL="SELECT  *  FROM products order by Product_ID";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindcode($result);
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
	private function bindcode($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset= null;
			while($row=mysql_fetch_array($ResultSet))
			{
			$dataset .= "<option value='".$row['Product_Code']."'>".$row['Product_Code']."</option>";
		
			}
				$this->setPro_code($dataset);
	}
	
	public function selectcode($Product_Code)
	{
	    $strSQL="SELECT  *  FROM products WHERE Product_Code='".$Product_Code."'";
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
	
	public function selectid($Product_id)
	{
	    $strSQL="SELECT  *  FROM products WHERE Product_id='".$Product_id."'";
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
	public function product($pro_id,$Product_Code,$Product_Name_Th,$Product_Name_En,$Description_Th,$Description_En
							,$Size,$Property_Th,$Property_En,$Price_Buy,$Price_sale,$Discount_PC,$Discount_Num,$Short_msg_Th
							,$Short_msg_En,$Qty,$Sale_min,$Sale_max,$KeyWord,$Weight,$Url_Th,$Url_En,$Discount_Status,$Product_Status)
	{
	    $strSQL="INSERT INTO products (Product_ID,Product_Code,Pro_Name_Th,Pro_Name_En,Description_Th,Description_En,Size,Property_Th
									,Property_En,Price_Buy,Price_sale,Discount_PC,Discount_Num,Short_msg_Th,Short_msg_En,Qty
									,Sale_min,Sale_max,KeyWord,Weight,Url_Th,Url_En,Discount_Status,Product_Status) 
									VALUES ('".$pro_id."','".$Product_Code."','".$Product_Name_Th."','".$Product_Name_En."','".$Description_Th."'
									,'".$Description_En."','".$Size."','".$Property_Th."','".$Property_En."','".$Price_Buy."','".$Price_sale."'
									,'".$Discount_PC."','".$Discount_Num."','".$Short_msg_Th."','".$Short_msg_En."','".$Qty."','".$Sale_min."'
									,'".$Sale_max."','".$KeyWord."','".$Weight."','".$Url_Th."','".$Url_En."','".$Discount_Status."','".$Product_Status."')";
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
	//For Product_Change.php
	public function Updateproduct($pro_id,$Product_Name_En)
	{
	    $strSQL="UPDATE products set Pro_Name_En = '".$Product_Name_En."' where Product_ID = '".$pro_id."' ";
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
	
	public function Allproducts()
	{
	    $strSQL="SELECT DISTINCT p.Product_ID,p.Product_Code, p.Pro_Name_En, im.Path, p.Price_sale, p.Qty
				 FROM products p, images im
				 WHERE p.product_id = im.product_id
				 GROUP BY p.product_id";
		
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindproducts($result);
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
	private function bindproducts($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
					    <th width=\"100px\"><h3>Product Code</h3></th>
						<th width=\"100px\"><h3>Name</h3></th>
						<th width=\"100px\"><h3>Picture</h3></th>
						<th width=\"100px\"><h3>Price</h3></th>
						<th width=\"100px\"><h3>Qty</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $dataset .= "<tr >";
			 $image = '../';
			 $file = $image.$row['Path'];
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Product_Code'] . "</td>";
			 $dataset .= "<td height=\"25px\">" . $row['Pro_Name_En'] . "</td>";
			 $dataset .= "<td height=\"25px\"><img src='".$file."' alt='' width='50' height='50'/></td>";
			 $dataset .= "<td height=\"25px\">".$row['Price_sale']."</td>";
			 $dataset .= "<td height=\"25px\">".$row['Qty']."</td>";
			 $dataset .= "<td height=\"25px\"><a href='Product_Change.php?Product_code=". $row['Product_Code'] ."'>Edit</a></td>";
			  $dataset .= "<td height=\"25px\"><a href='Product_color.php?id=". $row['Product_ID'] ."'>View</a></td>";
			 $dataset .= "<td height=\"25px\"><a href='delete_product.php?id=". $row['Product_ID'] ."'>Delete</a></td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllproducts($dataset);
			
	}
	
	public function Allproduct($product_id)
	{
	    $strSQL="select p.Product_ID,p.Product_Code,im.Path,p.Pro_Name_En,m.Name_En Category,c.Name_En,im.Image_ID from products p,images im,main_menu m, color c
				where p.product_id = im.product_id 
				and im.main_id = m.main_id
				and im.color_id = c.color_id
				and p.Product_ID = '".$product_id."'
				order by c.color_id";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindproduct($result);
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
	private function bindproduct($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
					    <th width=\"100px\"><h3>Product Code</h3></th>
						<th width=\"100px\"><h3>Image</h3></th>
						<th width=\"100px\"><h3>Product Name</h3></th>
						<th width=\"100px\"><h3>Category</h3></th>
						<th width=\"100px\"><h3>Color</h3></th>
						<th width=\"100px\"><h3>Edit</h3></th>
						<th width=\"100px\"><h3>Delete</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $image = '../';
			 $file = $image.$row['Path'];
			 $dataset .= "<tr >";
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Product_Code'] . "</td>";
			 $dataset .= "<td height=\"25px\"><img src='".$file."' alt='' width='50' height='50'/></td>";
			 $dataset .= "<td height=\"25px\">" . $row['Pro_Name_En'] . "</td>";
			 $dataset .= "<td height=\"25px\">".$row['Category']."</td>";
			 $dataset .= "<td height=\"25px\">".$row['Name_En']."</td>";
			 
			 $dataset .= "<td height=\"25px\"><a href='Edit.php?id=" . $row['Image_ID'] . "'>Edit</a></td>";
			 $dataset .= "<td height=\"25px\"><a href='delete.php?id=" . $row['Image_ID'] . "'>Delete</a></td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllproduct($dataset);
			
	}
	public function Allproduct_cat()
	{
	    $strSQL="select p.Product_ID,p.Product_Code,im.Path,p.Pro_Name_En,m.Name_En Category,c.Name_En,im.Image_ID from products p,images im,main_menu m, color c
				where p.product_id = im.product_id 
				and im.main_id = m.main_id
				and im.color_id = c.color_id
				order by c.color_id";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindproduct_cat($result);
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
	private function bindproduct_cat($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
					    <th width=\"100px\"><h3>Product Code</h3></th>
						<th width=\"100px\"><h3>Image</h3></th>
						<th width=\"100px\"><h3>Product Name</h3></th>
						<th width=\"100px\"><h3>Category</h3></th>
						<th width=\"100px\"><h3>Color</h3></th>
						<th width=\"100px\"><h3>Edit</h3></th>
						<th width=\"100px\"><h3>Delete</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $image = '../';
			 $file = $image.$row['Path'];
			 $dataset .= "<tr >";
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Product_Code'] . "</td>";
			 $dataset .= "<td height=\"25px\"><img src='".$file."' alt='' width='50' height='50'/></td>";
			 $dataset .= "<td height=\"25px\">" . $row['Pro_Name_En'] . "</td>";
			 $dataset .= "<td height=\"25px\">".$row['Category']."</td>";
			 $dataset .= "<td height=\"25px\">".$row['Name_En']."</td>";
			 
			 $dataset .= "<td height=\"25px\"><a href='Edit.php?id=" . $row['Image_ID'] . "'>Edit</a></td>";
			 $dataset .= "<td height=\"25px\"><a href='delete.php?id=" . $row['Image_ID'] . "'>Delete</a></td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllproduct_cat($dataset);
			
	}
	public function Allproduct_c($product_id)
	{
	    $strSQL="select * from products p,images im,color c 
				where p.product_id = im.product_id
				and im.color_id = c.color_id
				and p.Product_ID = '".$product_id."' ";
		
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindproduct_c($result);
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
	private function bindproduct_c($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
						<th width=\"100px\"><h3>Color</h3></th>
						<th width=\"100px\"><h3>Picture</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $dataset .= "<tr >";
			 $image = '../';
			 $file = $image.$row['Path'];
			 //$dataset .="<td align=\"center\" height=\"25px\">" . $row['Product_Code'] . "</td>";
			 //$dataset .= "<td height=\"25px\">" . $row['Pro_Name_En'] . "</td>";
			 $dataset .= "<td height=\"25px\">" . $row['Name_EN'] . "</td>";
			 $dataset .= "<td height=\"25px\"><img src='".$file."' alt='' width='50' height='50'/></td>";
			 //$dataset .= "<td height=\"25px\">".$row['Price_sale']."</td>";
			 //$dataset .= "<td height=\"25px\">".$row['Qty']."</td>";
			 $dataset .= "<td height=\"25px\"><a href='Product_Change.php?Product_code=". $row['Product_Code'] ."'>Edit</a></td>";
			 $dataset .= "<td height=\"25px\"><a href='delete_product.php?id=". $row['Product_ID'] ."'>Delete</a></td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllproduct_c($dataset);
			
	}
//End Operation
}


?>