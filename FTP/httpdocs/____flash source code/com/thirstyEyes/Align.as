package com.thirstyEyes
{
	import flash.display.DisplayObject
	import flash.display.Stage
	public class Align
	{
		
		public function Align()
		{
			
		}
		
		/*
		|---------------|
		|[]             |
		|               | 
		|               |  
		|---------------|
		*/
		// align element to top left of the stage.
		public static function topLeft(mc:DisplayObject):void
		{
			var x:Number = 0;
			var y:Number = 0;
			mc.x = x;
			mc.y = y;
		}
		
		/*
		|---------------|
		|               |
		|               | 
		| []            |  
		|---------------|
		*/
		// align element to bottom left of the stage.
		public static function bottomLeft(mc:DisplayObject):void
		{
			var x:Number =0;
			var y:Number = mc.stage.stageHeight - mc.height;
			mc.x = x;
			mc.y = y
		}
		/*
		|---------------|
		|             []|
		|               | 
		|               |  
		|---------------|
		*/
		// align element to top right of the stage.
		public static function topRight(mc:DisplayObject)
		{
			var x:Number = mc.stage.stageWidth -mc.width;
			var y:Number = 0;
			mc.x = x;
			mc.y = y
		}
		
		/*
		|---------------|
		|               |
		|               | 
		|             []|  
		|---------------|
		*/
		// align element to bottom right of the stage.
		public static function bottomRight(mc:DisplayObject)
		{
			var x:Number =mc.stage.stageWidth -mc.width;
			var y:Number =mc.stage.stageHeight-mc.height;
			mc.x = x;
			mc.y = y
		}
		
		// align element to middle of the Stage horizontally all the way to the left.
		/*
		|---------------|
		|               |
		|[]             | 
		|               |  
		|---------------|
		*/
		public static function middleLeft(mc:DisplayObject)
		{
			var x:Number =0;
			var y:Number =(mc.stage.stageHeight/2)-(mc.height/2);
			mc.x = x;
			mc.y = y
		}
		
		
		// align element to middle of the Stage horizontally all the way to the right.
		/*
		|---------------|
		|               |
		|             []| 
		|               |  
		|---------------|
		*/
		public static function middleRight(mc:DisplayObject) 
		{
			var x:Number = mc.stage.stageWidth - mc.width;
			var y:Number = (mc.stage.stageHeight / 2) - (mc.height / 2);
			mc.x = x;
			mc.y = y
		}
		
	
	
		// align element to middle of the Stage vertically all the way to the top.
		/*
		|---------------|
		|      []       |
		|               | 
		|               |  
		|---------------|
		*/
		public static function topMiddle(mc:DisplayObject):void
		{
			var x:Number = (mc.stage.stageWidth/2)-(mc.width/2);
			var y:Number =0
			mc.x = x;
			mc.y = y;
		}
	
		// align element to middle of the Stage vertically all the way to the bottm.
		/*
		|---------------|
		|               |
		|               | 
		|       []      |  
		|---------------|
		*/
		public static function bottomMiddle(mc:DisplayObject):void
		{
			var x:Number = (mc.stage.stageWidth/2)-(mc.width/2);
			var y:Number =(mc.stage.stageHeight)-mc.height;
			mc.x = x;
			mc.y = y;
		}
	
		// align element to the center of the stage.
		public static function center(mc:DisplayObject):void
		{
			var x:Number = (mc.stage.stageWidth / 2) - (mc.width / 2);
			var y:Number = (mc.stage.stageHeight / 2) - (mc.height / 2);
			mc.x = x;
			mc.y = y;
		}
		
		
	}// end class
	
}// end package