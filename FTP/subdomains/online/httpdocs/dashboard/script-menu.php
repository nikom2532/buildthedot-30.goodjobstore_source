<script language="javascript"> 
    function toggle() {
    	var ele = document.getElementById("toggleText");
    	var text = document.getElementById("displayText");
     	if(ele.style.display == "block") {
        	ele.style.display = "none";
        	text.innerHTML = "<img src='images/cart.jpg' align='absmiddle' />Shopping Cart";
        }
      	else {
        	ele.style.display = "block";
        	text.innerHTML = "<img src='images/cart.jpg' align='absmiddle' />Shopping Cart";
      	}
      	
      	var vCover = document.getElementById("cover");
      	 
      	//var vCoverText = document.getElementById("coverText");
      	if(vCover.style.display == "block") {
        	vCover.style.display = "none";
    		//vCoverText.innerHTML = "show";
   		}
  		
    }
</script>
