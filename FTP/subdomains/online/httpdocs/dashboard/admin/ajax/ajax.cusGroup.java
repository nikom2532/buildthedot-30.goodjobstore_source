function viewGroupTable()
{
	var req;
	if (window.XMLHttpRequest)
		req = new XMLHttpRequest();
	else if (window.ActiveXObject)
		req = new ActiveXObject("Microsoft.XMLHTTP");
	else
	{
		alert("Browser error");
		return false;
	}

	req.onreadystatechange = function()
	{
		var area = document.getElementById('group_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/cusGroup_table.php"+pmeters,true);
	req.send(null);
}

function addGroup()
{
	var groupName = document.frmAddGroup.group_name.value;
	if (groupName==""){
		alert("Please insert group name.");
	}
	else
	{
		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				viewGroupTable();
				$("#group_name").val("");
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'groupName='+groupName;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/cusGroup_insert.php"+pmeters,true);
		req.send(null);
	}
}

function deleteGroup(groupID)
{
		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				alert("Done.");
				viewGroupTable();
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'groupID='+groupID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/cusGroup_delete.php"+pmeters,true);
		req.send(null);
}

function editGroup(groupID)
{
		var groupName = document.frmEditGroup.group_name.value;

		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4){
				alert("Done.");
				window.location.href='cusGroup.php'}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'groupID='+groupID;
		pmeters += '&groupName='+groupName;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/cusGroup_edit.php"+pmeters,true);
		req.send(null);
}

//-------------- member ------------------
function viewMemberTable(groupID)
{	
	var req;
	if (window.XMLHttpRequest)
		req = new XMLHttpRequest();
	else if (window.ActiveXObject)
		req = new ActiveXObject("Microsoft.XMLHTTP");
	else
	{
		alert("Browser error");
		return false;
	}

	req.onreadystatechange = function()
	{
		var area = document.getElementById('member_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&groupID='+groupID;
	
	req.open("GET","connectDB/cusGroupMember_table.php"+pmeters,true);
	req.send(null);
}

function addCustomer(groupID)
{
	var cusID = $("#addMember").val();
	if (cusID==""){
		alert("Please select customer name.");
	}
	else
	{
		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				viewMemberTable(groupID);
				$("#addMember").val("");
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'groupID='+groupID;
		pmeters += '&cusID='+cusID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/cusGroupMember_insert.php"+pmeters,true);
		req.send(null);
	}
}

function deleteMember(groupID,cusID)
{
		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				alert("Done.");
				viewMemberTable(groupID);
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'cusID='+cusID;
		pmeters += '&groupID='+groupID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/cusGroupMember_delete.php"+pmeters,true);
		req.send(null);
}