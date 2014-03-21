<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Images
{
	private $Create_Date;
	private $Image_ID;
	private $Mode;
	private $Path;
	private $Product_ID;
	private $Status;
	private $Thumbnail_path;
	private $SlideShow;
	private $ShowBanner;
	private $Color_ID;
	private $Property_ID;
	private $AllSlide;
	private $AllBanner;
	private $Level;

//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->Create_Date="";
	  $this->Image_ID="";
	  $this->Mode="";
	  $this->Path="";
	  $this->Product_ID="";
	  $this->Status="";
	  $this->Thumbnail_path="";
	  $this->SlideShow="";
	  $this->ShowBanner="";
	  $this->Property_ID="";
	  $this->Color_ID="";
	  $this->AllSlide="";
	  $this->AllBanner="";
	  $this->Level=""; 
	}
//End Construct

//Properties
	public function getProperty_ID()
	{
		return $this->Property_ID;
	}
	public function getAllBanner()
	{
		return $this->AllBanner;
	}
	public function getLevel()
	{
		return $this->Level;
	}
	public function getAllSlide()
	{
		return $this->AllSlide;
	}
	public function getColor_ID()
	{
		return $this->Color_ID;
	}
	public function getSlideShow()
	{
		return $this->SlideShow;
	}
	public function getBanner()
	{
		return $this->ShowBanner;
	}

	public function getCreate_Date()
	{
		return $this->Create_Date;
	}

	public function getImage_ID()
	{
		return $this->Image_ID;
	}

	public function getMode()
	{
		return $this->Mode;
	}

	public function getPath()
	{
		return $this->Path;
	}

	public function getProduct_ID()
	{
		return $this->Product_ID;
	}

	public function getStatus()
	{
		return $this->Status;
	}

	public function getThumbnail_path()
	{
		return $this->Thumbnail_path;
	}
	/**
		Set Backoffice
	**/
	public function setAllBanner($newVal)
	{
		$this->AllBanner = $newVal;
	}
	public function setAllSlide($newVal)
	{
		$this->AllSlide = $newVal;
	}
	
	/**
	
	**/
	public function setProperty_ID($newVal)
	{
		$this->Property_ID = $newVal;
	}
	/**
	
	**/
	public function setColor_ID($newVal)
	{
		$this->Color_ID = $newVal;
	}
	public function setSlideShow($newVal)
	{
		$this->SlideShow = $newVal;
	}
	public function setBanner($newVal)
	{
		$this->ShowBanner = $newVal;
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
	public function setImage_ID($newVal)
	{
		$this->Image_ID = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setLevel($newVal)
	{
		$this->Level = $newVal;
	}
	 
	public function setMode($newVal)
	{
		$this->Mode = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPath($newVal)
	{
		$this->Path = $newVal;
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
	public function setStatus($newVal)
	{
		$this->Status = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setThumbnail_path($newVal)
	{
		$this->Thumbnail_path = $newVal;
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
			$this->Image_ID=$row['Image_ID'];
			$this->Product_ID=$row['Product_ID'];
			$this->Mode=$row['Mode'];
			$this->Status=$row['Status'];
			$this->Path=$row['Path'];
			$this->Thumbnail_path=$row['Thumbnail_path'];
			$this->Create_Date=$row['Create_Date'];
			$this->Color_ID=$row['Color_ID'];
			$this->Level=$row['Level'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($Image_ID)
	{
	    $strSQL="SELECT  *  FROM images WHERE Image_ID=".$Image_ID;
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
	public function insertAll($Product_ID,$Mode,$Status,$Path,$Thumbnail_path,$Create_Date)
	{
	    $strSQL="INSERT INTO images (Product_ID,Mode,Status,Path,Thumbnail_path,Create_Date) VALUES ('".$Product_ID."','".$Mode."',".$Status.",'".$Path."','".$Thumbnail_path."','".$Create_Date."')";
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
	public function Dbdelete($Image_ID)
	{
	    $strSQL="DELETE FROM images WHERE Image_ID=".$Image_ID;
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
	
	public function selectSlide()
	{
	    $strSQL="SELECT  *  FROM images WHERE Mode = 'SlideShow' and Status = 'Active' order by Level ";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindSlide($result);
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
	private function bindSlide($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$images = null;
			while($row=mysql_fetch_array($ResultSet))
			{
				$images .= "<a href= '#'><img src='".$row['Path']."' alt='' /></a>";
			}
			$this->SlideShow = $images;
	}
	
	public function selectBanner()
	{
	    $strSQL="SELECT  *  FROM images WHERE Mode = 'Fixed' and Status = 'Active' order by Level ";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindBanner($result);
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
	private function bindBanner($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$first = 0;
			$image_Banner = null;
			while($row=mysql_fetch_array($ResultSet))
			{
				if($first == 0)
				{
					$image_Banner .= "<li class='boarder_img'><img src='".$row['Thumbnail_path']."' class='center' />";
					$first = 1;
				}
				else
				{
					$image_Banner .= "<li><img src='".$row['Thumbnail_path']."' class='center' /></li>";
				}
			}
			$this->ShowBanner = $image_Banner;
	}
	
	//Backoffice
	
	//upload slide & banner
		public function uploadslide($picture,$status,$mode,$sequence)
	{	
		
		$strSQL="INSERT INTO images (Path,Status,Mode,Level) VALUES ('".$picture."','".$status."','".$mode."','".$sequence."')";  
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindBanner($result);
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
	
		
	public function AllSlide()
	{
	    $strSQL="select * from images where Mode = 'SlideShow' order by Level";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindimages($result);
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
	private function bindimages($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
					    <th width=\"100px\"><h3>Status</h3></th>
						<th width=\"100px\"><h3>Sequence</h3></th>
						<th width=\"100px\"><h3>Image</h3></th>
						<th width=\"100px\"><h3>Path</h3></th>
						<th width=\"100px\"><h3>Edit</h3></th>
						<th width=\"100px\"><h3>Delete</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $image = '../';
			 $file = $image.$row['Path'];
			 $dataset .= "<tr >";
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Status'] . "</td>";
             $dataset .= "<td height=\"25px\">" . $row['Level'] . "</td>";
			 $dataset .= "<td height=\"25px\"><img src='".$file."' alt='' width='80' height='50'/></td>";
			 $dataset .= "<td height=\"25px\">".$row['Path']."</td>";
			 $dataset .= "<td height=\"25px\"><a href='Edit.php?id=" . $row['Image_ID'] . "'>Edit</a></td>";
			 $dataset .= "<td height=\"25px\"><a href='delete.php?id=" . $row['Image_ID'] . "'>Delete</a></td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllSlide($dataset);
			
	}
		public function update_data($image_id,$Status,$Level)
	{
	    $strSQL="UPDATE images set Status = '".$Status."',Level = '".$Level."' where Image_ID = '".$image_id."' ";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindimages($result);
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
	
	
	public function uploadBanner($picture,$status,$mode,$sequence)
	{	
		
		$strSQL="INSERT INTO images (Thumbnail_path,Status,Mode,Level) VALUES ('".$picture."','".$status."','".$mode."','".$sequence."')";  
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindBanner($result);
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
	
	
		public function AllBanner()
	{
	    $strSQL="select * from images where Mode = 'Fixed' order by Level";
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
			$dataset="<table border='10' cellpadding='10'>";
            $dataset .= "<tr>
					    <th width=\"100px\"><h3>Status</h3></th>
						<th width=\"100px\"><h3>Sequence</h3></th>
						<th width=\"100px\"><h3>Image</h3></th>
						<th width=\"100px\"><h3>Path</h3></th>
						<th width=\"100px\"><h3>Edit</h3></th>
						<th width=\"100px\"><h3>Delete</h3></th>
						</tr>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $image = '../';
			 $file = $image.$row['Thumbnail_path'];
			 $dataset .= "<tr >";
			 $dataset .="<td align=\"center\" height=\"25px\">" . $row['Status'] . "</td>";
             $dataset .= "<td height=\"25px\">" . $row['Level'] . "</td>";
			 $dataset .= "<td height=\"25px\"><img src='".$file."' alt='' width='50' height='50'/></td>";
			 $dataset .= "<td height=\"25px\">".$row['Thumbnail_path']."</td>";
			 $dataset .= "<td height=\"25px\"><a href='Edit.php?id=" . $row['Image_ID'] . "'>Edit</a></td>";
			 $dataset .= "<td height=\"25px\"><a href='delete.php?id=" . $row['Image_ID'] . "'>Delete</a></td>";
			 $dataset .="</tr>";
			}
			$dataset .="</table>";
			$this->setAllBanner($dataset);
			
	}
	//Update Picture
	public function updateslide($mode,$image_id)
	{
	    $strSQL="UPDATE images set Mode = '".$mode."' where Image_ID = '".$image_id."' ";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindimages($result);
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
	
	
	
	//upload picture products
	public function uploadfull($product_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID)
	{	
		
		$strSQL="INSERT INTO images (Product_ID,Path,Status,Mode,Level,Color_ID,Property_ID) VALUES ('".$product_id."','".$picture."','".$status."','".$mode."','".$sequence."','".$Color_ID."','".$Property_ID."')";  
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindBanner($result);
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
	
	public function uploadsmall($product_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID)
	{	
		
		//$strSQL="INSERT INTO images (Product_ID,Path_Small,Status,Mode,Level) VALUES ('".$product_id."','".$picture."','".$status."','".$mode."','".$sequence."')";  
	    $strSQL="UPDATE images set Path_Small = '".$picture."' where Product_ID = '".$product_id."' and Mode = '".$mode."' and Color_ID = '".$Color_ID."' and Property_ID = '".$Property_ID."' ";
		$Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindBanner($result);
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

		public function uploadtumb($pro_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID)
	{	
		
		//$strSQL="INSERT INTO images (Product_ID,Thumbnail_path,Status,Mode,Level) VALUES ('".$product_id."','".$picture."','".$status."','".$mode."','".$sequence."')";    
		// $strSQL="UPDATE images set Status = '9999',Level = '2',Thumbnail_path = '".$picture."' where Product_ID = 'PR000019' ";
		$strSQL="UPDATE images set Thumbnail_path = '".$picture."' where Product_ID = '".$pro_id."' and Mode = '".$mode."' and Color_ID = '".$Color_ID."' and Property_ID = '".$Property_ID."' ";
		$Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindBanner($result);
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
		
	public function delete($Product_ID)
	{
	    $strSQL="DELETE FROM images WHERE Product_ID= '".$Product_ID."' ";
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