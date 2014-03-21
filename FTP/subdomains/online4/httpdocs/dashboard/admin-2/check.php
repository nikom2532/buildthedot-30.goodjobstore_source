<html>
<head>
<title></title>
<script language="javascript">
function fncShowHideInput(value) {
var input1 = document.getElementById('txtName1');
var input2 = document.getElementById('txtName2');
if(value.checked) {
input1.style.display='';
input2.style.display='';
}else{
input1.style.display='none';
input2.style.display='none';
}
}

function fncShowHideTable(value) {
var idTb = document.getElementById('tbMain');
if(value.checked){
idTb.style.display='';
}else{
idTb.style.display='none';
}
}

function hide() {
var input1 = document.getElementById('txtName1');
var input2 = document.getElementById('txtName2');
var idTb = document.getElementById('tbMain');
input1.style.display='none';
input2.style.display='none';
idTb.style.display='none';
}
</script>
</head>
<body onLoad="hide();">


<form name="form1" method="post" action="">
<input type="checkbox" name="chkShowInput" value="Y" OnClick="JavaScript:fncShowHideInput(this);">
<input type="checkbox" name="txtName" id="txtName1" value="">

<tr>
<td></td>
</tr>
</table>
</form>
</body>
</html>