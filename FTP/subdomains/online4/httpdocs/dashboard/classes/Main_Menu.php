<?php
include_once("Connection.php");
include_once("ConnectException.php");
class Main_Menu
{
	private $Level;
	private $Linked;
	private $main_ID;
	private $Name_En;
	private $Name_Th;
	private $Sub_Flag;
	private $Target;
	private $AllMainmenu;
	private $menu;
	private $menus;
//Construct
	function __construct()
	{
	}

	function __destruct()
	{
	  $this->main_ID="";
	  $this->Name_Th="";
	  $this->Name_En="";
	  $this->Linked="";
	  $this->Target="";
	  $this->Level="";
	  $this->Sub_Flag=""; 
	  $this->AllMainMenu="";
	  $this->menu="";
	  $this->menus="";	  
	}
//End Construct

//Properties
	public function getmenus()
	{
		return $this->menus;
	}
	public function getmenu()
	{
		return $this->menu;
	}
	public function getAllMainmenu()
	{
		return $this->AllMainmenu;
	}
	public function getLevel()
	{
		return $this->Level;
	}

	public function getLinked()
	{
		return $this->Linked;
	}

	public function getmain_ID()
	{
		return $this->main_ID;
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

	public function getTarget()
	{
		return $this->Target;
	}
	
	/**
	 * 
	 * @param newVal
	 */
	public function setmenus($newVal)
	{
		$this->menus = $newVal;
	} 
	/**
	 * 
	 * @param newVal
	 */
	public function setmenu($newVal)
	{
		$this->menu = $newVal;
	} 
	/**
	 * 
	 * @param newVal
	 */
	public function setAllMainmenu($newVal)
	{
		$this->AllMainmenu = $newVal;
	} 
	 /*
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
	public function setmain_ID($newVal)
	{
		$this->main_ID = $newVal;
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
			$this->main_ID=$row['main_ID'];
			$this->Name_Th=$row['Name_Th'];
			$this->Name_En=$row['Name_En'];
			$this->Linked=$row['Linked'];
			$this->Target=$row['Target'];
			$this->Level=$row['Level'];
			$this->Sub_Flag=$row['Sub_Flag'];
	}
	/**
	 * 
	 * @param Id
	 */
	public function selectAll($main_ID)
	{
	    $strSQL="SELECT  *  FROM main_menu WHERE main_ID=".$main_ID;
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

	public function insertAll($Name_Th,$Name_En,$Linked,$Target,$Level,$Sub_Flag)
	{
	    $strSQL="INSERT INTO main_menu (Name_Th,Name_En,Linked,Target,Level,Sub_Flag) VALUES ('".$Name_Th."','".$Name_En."','".$Linked."','".$Target."',".$Level.",".$Sub_Flag.")";
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
	public function Dbdelete($main_ID)
	{
	    $strSQL="DELETE FROM main_menu WHERE main_ID=".$main_ID;
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
	public function allMainmenu()
	{
	    $strSQL="select * from main_menu";
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
			$dataset="<li>";
			while($row=mysql_fetch_array($ResultSet))
			{
			 $dataset .="<a href=\"#\" title=\"\">" . $row['Name_En'] . "</a>";
			}
			$dataset .="</li>";
			$this->setAllMainmenu($dataset);
			
	}
	
	public function selectmenu()
	{
	    $strSQL="SELECT  m.Main_ID main_id, s.Main_ID sub_id, m.Name_EN main_name, s.Name_EN sub_name, m.Sub_Flag,s.Sub_Flag  
				 FROM  main_menu m,sub_menu s
				 WHERE m.Sub_Flag = s.Sub_Flag";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindmenu($result);
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
	private function bindmenu($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset= null;
			while($row=mysql_fetch_array($ResultSet))
			{
			/*$tag = "--";
			$dataset .= "<option value='".$row['main_id']."'>".$row['main_name']."</option>";
			$dataset .= "<option value='".$row['sub_id']."'>&nbsp;&nbsp;&nbsp;&nbsp;--".$row['sub_name']."</option>";
			$i = 0;*/
			/*$dataset .= "<Input type = 'Checkbox' Name = '".$row['main_id']."' value = '".$row['main_id']."' onClick='this.form.submit()';> ".$row['main_name']." ";
				if($_POST[$row['main_id']] == $row['main_id'])
				{
					$dataset .= "<Input type = 'Checkbox' Name = '".$row['sub_id']."' value = '".$row['sub_id']."'> ".$row['sub_name']." ";
				
				}
				*/
				/*if(isset ('check[$i]') == 'true')
				{
					while($row=mysql_fetch_array($ResultSet))
					{	
						$dataset .= "<Input type = 'Checkbox' Name ='check[$i]' value = '".$row['sub_id']."' > ".$row['sub_name']." ";
					}
				}*/
			$dataset .= "<input type='checkbox' name='chkShowInput' value='' '>".$row['main_name']." ";
						
			$dataset .= "<input type='checkbox' name='' id='' value='value = '".$row['sub_id']."''>".$row['sub_name']." ";					
					
				$this->setmenu($dataset);
			}
	}
		public function selectmenus()
	{
	    $strSQL="SELECT * FROM main_menu WHERE sub_flag =0";
	    $Dbcon= new Connection();
		$code=0;
		try
		{
		  $con = $Dbcon->Dbconnect();
		  $result = $Dbcon->Dbquery($strSQL);
          $this->bindmenus($result);
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
	private function bindmenus($ResultSet)
	{
			if (mysql_num_rows($ResultSet)==0)
			{ 
				throw new Exception('Query not executed.'); 
			}
			$dataset= null;
			while($row=mysql_fetch_array($ResultSet))
			{
			$dataset .= "<option value='".$row['main_ID']."'>".$row['Name_En']."</option>";
			}
				$this->setmenus($dataset);
	}
//End Operation

}
?>