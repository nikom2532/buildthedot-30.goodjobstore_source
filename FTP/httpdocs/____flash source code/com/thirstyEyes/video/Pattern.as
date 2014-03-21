package com.thirstyEyes.video
{
	import flash.display.*;
	import flash.events.*;
	
	public class Pattern extends Sprite
	{
		public var libraryPattern:BitmapData; // object that will hold the pattern from the library
				
		public function Pattern()
		{
			
			this.addEventListener(Event.ADDED_TO_STAGE, onStage);
			
		}
		
		public function onStage(e:Event)
		{
			stage.addEventListener(Event.RESIZE, resize);
		}
		// create the pattern ("draws" the pattern inside the pattern variable).
		
		
		public function loadPattern(libPattern:BitmapData)
		{
			libraryPattern = libPattern;
			
			createPattern();
		}
		private function createPattern():void
		{
			
			if (libraryPattern != null)
			{
				graphics.clear();
				//graphics.beginBitmapFill(libraryPattern,null,true,true);
				graphics.beginBitmapFill(libraryPattern);
				graphics.drawRect(0, 0, stage.stageWidth, stage.stageHeight);
			
				this.cacheAsBitmap = true;
			}
		}
		
		// fired when the stage reiszes.
		private function resize(e:Event):void
		{
			// re-create the pattern.
			createPattern();
		}
		
		
		public function clearPattern()
		{
			graphics.clear();
			
			if (libraryPattern)
			{
				libraryPattern.dispose();
				libraryPattern = null;
			}
			
		}
		
	}
	
}