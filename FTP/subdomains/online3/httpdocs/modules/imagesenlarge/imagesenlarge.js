/**
 * image enlarge
 * @name imagesenlarge.js
 * @author Marghoob Suleman - http://www.marghoobsuleman.com
 * @version 1.3
 * @date January 18, 2009
 * @date updated: February 05, 2009
 * @copyright (c) 2009 Marghoob Suleman (http://www.giftlelo.com)
 */
 
//To do after loading HTML
$(document).ready(function(){
	ImagesEnlarge.setAnimationStatus(setAnimationStatus);
	ImagesEnlarge.setExtendZoomStatus(extendedZoomSatus);
	ImagesEnlarge.init();
});

ImagesEnlarge = {
	settings: {
		useExtendedZoom:0,
		interval:0,
		shadowDistance:5,
		shadowTransparency:.5,
		allImageHolder:'featured-products_block_center',
		loaderImage:'modules/imagesenlarge/loader.gif',
		useAnimation:1,//make it zero if you dont want to animate
		imageArray:[],
		hrefHolder:{index:'a.product_image', otherpages:'a.product_img_link', indexBlock:'#featured-products_block_center .ajax_block_product', otherBlock:'#product_list div.center_block'}
	},
	imgHolderDiv:"<div id='msImageShadow' onmouseover='ImagesEnlarge.hideDivs();'></div><div id='msBigImageHolder' class='border' style='display:none' onmouseover='ImagesEnlarge.hideDivs();'></div>",
	init: function() {
		$('body').append(this.imgHolderDiv);
		//set div style
		this.alterAttributes();
	},
	getCurrentSourceID: function() {
		var currentpage = $('body').attr('id');
		var pageid;
		var srcBlock;
		if(currentpage=='index') {
			pageid = this.settings.hrefHolder.index;
			srcBlock = this.settings.hrefHolder.indexBlock;
		} else {
			pageid = this.settings.hrefHolder.otherpages;
			srcBlock = this.settings.hrefHolder.otherBlock;
		}
		return {aBlock:pageid, sourceBlock:srcBlock};
	},
	getImagePath: function(path) {
		var extract = path.split("/");
		var sPath = "";
		for(var i=0;i<extract.length-1;i++) {
			sPath+=extract[i]+"/";
		}
		return sPath;
	},
	setID: function(id, path) {
		var sID = id;
		var sPath = path;
		var imgPath = this.getImagePath(sPath);
		var extract = sPath.split("/");
		var imgName = extract[extract.length-1];
		var largeImg = imgPath+imgName.substr(0, imgName.length-9)+"-large.jpg";
		var thickImg = imgPath+imgName.substr(0, imgName.length-9)+"-thickbox.jpg";
		var homeImg = imgPath+imgName.substr(0, imgName.length-9)+"-home.jpg";
		var smallImg = imgPath+imgName.substr(0, imgName.length-9)+"-small.jpg";
		ImagesEnlarge.settings.imageArray[sID] = {small:smallImg, home:homeImg, large:largeImg, thickbox:thickImg};
		//console.debug("ImagesEnlarge.settings.imageArray[sID] " + ImagesEnlarge.settings.imageArray[sID].large);
	},
	getID:function(id) {
		return ImagesEnlarge.settings.imageArray[id];
	},
	alterAttributes: function() {
		//var blocks = $('');
		var sourceBlock = this.getCurrentSourceID();
		var blocks = $(sourceBlock.sourceBlock);
		var total = blocks.length;
		if(total>0) {
			if(ImagesEnlarge.settings.useAnimation==1) {
				$("#msBigImageHolder").css({position:'absolute', float:'right', top:'30%', left:'50%'});
				$("#msImageShadow").css({position:'absolute', float:'right', top:'30%', left:'50%'});
			}	
			var sourceA = sourceBlock.aBlock;
			for(var iCount=0;iCount<total;iCount++) {
				var currentBlock = blocks[iCount];
				var id = "product_list_"+iCount;
				currentBlock.id = id;
				var currentA = $("#"+id+ " "+sourceA)[0];
				var aID = "zoomer_"+iCount;
				currentA.id = aID;
				var imgTag = currentA.firstChild;
				var imgName = $(imgTag).attr("src");
				this.setID(aID, imgName);
				
				//set clip
				//var sClipDiv = "<div id='clip_'"+iCount+" class='msClip'></div>";
				//$(aID).before(sClipDiv);
				
			//set method
			$("#"+aID).bind('mouseenter', this.showSmallImage);
			if(ImagesEnlarge.settings.useExtendedZoom==1) {
				$("#"+aID).bind('mousemove', this.showClipedImage);
			}
			
			$("#"+aID).bind('mouseleave',function() {
												 ImagesEnlarge.hideDivs();
						});

			}
			
		}
	},
	hideDivs: function() {
		$("#msImageShadow").hide("fast");												  
		$("#msBigImageHolder").hide("fast");	
	},
	hideOtherPluginDivs: function() {
		//this section hides other divs if you've already used suleman's modules.
		//Add to cart extended : http://www.marghoobsuleman.com/node/75
		if($('#moreTags').length>0)
			$('#moreTags').hide("fast");
	},
	showClipedImage: function(e) {
		var targetHolder  = "#"+this.id;
		var src = "#msBigImageHolder";
		var imgHolder = "#imgHolder";
		var tagerHolderPosition = $(targetHolder).position();
		var posCliper = {left:tagerHolderPosition.left - e.pageX, top:tagerHolderPosition.top - e.pageY}
		//console.debug("posCliper " + posCliper.left + " clientY " + posCliper.top)
	  	var ratio = 232.5581395;
	  	var xPos = ((posCliper.left) * ratio) / 100;
	  	var yPos = ((posCliper.top) * ratio) / 100;
	  	$(imgHolder).css({left:xPos+'px', top:yPos+'px'});	
	},
	getImageName: function(id) {
		var oImgNames = ImagesEnlarge.getID(id);
		var imgName = oImgNames.large
		if(ImagesEnlarge.settings.useExtendedZoom==1) {
			imgName = oImgNames.thickbox;
		}
		return imgName;
	},
	showSmallImage: function() {
							//hides other divs if you've already used suleman's modules.
							ImagesEnlarge.hideOtherPluginDivs();
							//start code
							var imgHTML = "<div class='border' style='position:absolute; background-color:#ffffff' id='imgLoader'><img src='"+ImagesEnlarge.settings.loaderImage+"' border='0' /></div>";
							$("#msBigImageHolder").html(imgHTML);
							
							var getImage = ImagesEnlarge.getImageName(this.id);
							imgHTML += "<div id='imgHolder'><img id='bigImg' src='"+getImage+"' border='0' class='border' hspace='10' vspace='10' /></div>";
							$("#msBigImageHolder").html(imgHTML);
							ImagesEnlarge.checkImageLoad();
							var xy = $(this).offset();
							var height = 0;
							var width = $(this).width();
							$("#msBigImageHolder").css({'position':'absolute'})
							if(ImagesEnlarge.settings.useAnimation==1) {
								if($('body').attr('id')=='index'){
									$("#msBigImageHolder").css( {'left':(xy.left+width+width)+'px', 'top':(xy.top-height)+'px'})
									$("#msImageShadow").css( {'left':(xy.left+width+width)+'px', 'top':(xy.top-height)+'px'})
								}
								$("#msBigImageHolder").show("fast", function(e) {
																	$("#msBigImageHolder").animate( {'left':(xy.left+width)+'px', 'top':(xy.top+height)+'px'}, { queue:false, duration:500}, 'slow');
																	/*
																	var topPos = xy.top+height;
																	var leftPos = xy.left+width;
																	 if(($("#msBigImageHolder").width()+leftPos)>$(window).width()) {leftPos = leftPos - width - $("#msBigImageHolder").width() - 20;}
																	   $("#msBigImageHolder").animate( {'left':(leftPos)+'px', 'top':(topPos)+'px'}, { queue:false, duration:500 } )
																		*/   
																		   });
									$("#msImageShadow").show("fast", function(e) {
																		$("#msImageShadow").css({'opacity':ImagesEnlarge.settings.shadowTransparency});
																		$("#msImageShadow").animate( {'left':(xy.left+width+ImagesEnlarge.settings.shadowDistance)+'px', 'top':(xy.top+height+ImagesEnlarge.settings.shadowDistance)+'px'}, { queue:false, duration:500} )																			  
																			  });

							} else {
								$("#msBigImageHolder").css({'left':(xy.left+width)+'px', 'top':(xy.top+height)+'px'});
								$("#msBigImageHolder").show("fast");
								$("#msImageShadow").css({'opacity':ImagesEnlarge.settings.shadowTransparency,'left':(xy.left+width+ImagesEnlarge.settings.shadowDistance)+'px', 'top':(xy.top+height+ImagesEnlarge.settings.shadowDistance)+'px'});
								$("#msImageShadow").show("fast");
							}
	},
	getImageStatus: function() {
		var img = $("#msBigImageHolder #bigImg")[0];
		if(img.complete==true) {
			$('#imgLoader').hide();
			clearInterval(ImagesEnlarge.settings.interval);
		} else {
			//console.debug("2 " + img.complete)
		}
	},
	checkImageLoad: function() {
		ImagesEnlarge.settings.interval = setInterval(ImagesEnlarge.getImageStatus, 500);
		
	},
	setAnimationStatus: function(status) {
		ImagesEnlarge.settings.useAnimation = parseInt(status);
	},
	setExtendZoomStatus: function(extendedZoom) {
		ImagesEnlarge.settings.useExtendedZoom = parseInt(extendedZoom);
	}
}
