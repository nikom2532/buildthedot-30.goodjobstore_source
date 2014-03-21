package
{

	import flash.display.MovieClip;
	import flash.display.Stage;
	import flash.display.StageDisplayState;
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * This is a class for a full screen button.
	 * 
	 */
	public class FullScreenButton extends MovieClip
	{
		private var _over:Boolean = false;

		public function FullScreenButton() 
		{
			this.buttonMode = true;
			addEventListener(MouseEvent.MOUSE_OVER, onOverHandler);
			addEventListener(MouseEvent.MOUSE_OUT, onOutHandler);
			addEventListener(MouseEvent.CLICK, onClickHandler);
		}
		public function onClickHandler(e:MouseEvent):void
		{

			if (stage.displayState == StageDisplayState.FULL_SCREEN)
			{
				stage.displayState = StageDisplayState.NORMAL;
				this.gotoAndStop('offOver');
				
			}
			else // we are in normal mode, go to full screen 
			{

				stage.displayState = StageDisplayState.FULL_SCREEN;
				this.gotoAndStop('onOver');
			}

			

		}
		
		
		public function onOverHandler(e:MouseEvent):void
		{
			_over = true;
			if (stage.displayState == StageDisplayState.FULL_SCREEN)
			{
				this.gotoAndStop('onOver');
			}
			else
			{
				this.gotoAndStop('offOver');
			}

		}
		
		public function onOutHandler(e:MouseEvent):void
		{
			_over = false;
			
			if (stage.displayState == StageDisplayState.FULL_SCREEN)
			{
				this.gotoAndStop('on');
			}
			else
			{
				this.gotoAndStop('off');
			}
			
		}
		
		public function destroy():void
		{
			removeEventListener(MouseEvent.MOUSE_OVER, onOverHandler);
			removeEventListener(MouseEvent.MOUSE_OUT, onOutHandler);
			removeEventListener(MouseEvent.CLICK, onClickHandler);
		}		
		
	}// end class
}// end package