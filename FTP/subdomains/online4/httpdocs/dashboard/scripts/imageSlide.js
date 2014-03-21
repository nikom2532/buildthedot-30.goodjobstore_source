$(function(){  
        var box_w=80;  
        var box_h=80;  
        var box_show=5;  
        var nav_w=30;  
        var marGL=5;   

        var slide_w=(box_show*(marGL+box_w))+(nav_w*2)+marGL  
        var content_w=(box_show*(marGL+box_w));  
        var nol_nav_l,new_nev_l=null;  
        $("span#slide_box_sp").width(slide_w);  
        $("a.list_nav").width(box_w).css("marginLeft",marGL);  
        $("span#slide_box_sp,span#slide_box_sp *").height(box_h);  
        $("div.go_l_nav,div.go_r_nav").width(nav_w);  
        $("div.go_r_nav").css("marginLeft",marGL);  
        $("div.content_slide").width(content_w);  
        $("div#content_slide_in").css("marginLeft","0px");  
        $("div.go_r_nav").click(function(){  
            var numA=$("div#content_slide_in > a").length-box_show;  
            numA=numA*(box_w+marGL);  
            var charA="-"+numA+"px";  
            now_nav_l=$("div#content_slide_in").css("marginLeft");  
            if(now_nav_l!=charA){  
                now_nav_l=now_nav_l.replace("px","");  
                new_nav_l=now_nav_l-box_w-marGL;  
                $("div#content_slide_in").animate({  
                    marginLeft:new_nav_l  
                },100);  
            }  
        });  
        $("div.go_l_nav").click(function(){  
            now_nav_l=$("div#content_slide_in").css("marginLeft");  
            if(now_nav_l!="0px"){  
                now_nav_l=now_nav_l.replace("px","");  
                now_nav_l=parseInt(now_nav_l);  
                new_nav_l=now_nav_l+box_w+marGL;  
                $("div#content_slide_in").animate({  
                    marginLeft:new_nav_l  
                },100);  
            }  
        });           
    });  