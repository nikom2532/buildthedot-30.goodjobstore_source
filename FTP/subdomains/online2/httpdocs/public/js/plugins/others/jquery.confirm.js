
function conf(msg) 
{
	var answer = confirm(msg);
	if (answer) {
		return true;
	}
	return false;
}