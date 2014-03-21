package
{

	import flash.display.MovieClip;
	import flash.display.Stage;
	import flash.display.StageDisplayState;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.net.navigateToURL;
	import flash.net.URLRequest;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	/**
	 * ...
	 * This is a class for a full screen button.
	 * 
	 */
	public class SkipUrlButton extends MovieClip
	{
		private var _over:Boolean = false;

		public var targetUrl:String; 
		public var skipText:TextField;
		public var text:String;
		public var background:MovieClip;
		
		public function SkipUrlButton() 
		{
			this.buttonMode = true;
			this.mouseChildren = false;
			skipText = this.skip_txt;
			skipText.autoSize = TextFieldAutoSize.LEFT;
			background = this.back_mc;
			addEventListener(MouseEvent.MOUSE_OVER, onOverHandler);
			addEventListener(MouseEvent.MOUSE_OUT, onOutHandler);
			addEventListener(MouseEvent.CLICK, onClickHandler);
		}
		
		public function setText($t:String):void
		{
			skipText.text = $t;
			text = $t;
			
			background.width = Math.round(skipText.width + 2);
			
		}
		public function onClickHandler(e:MouseEvent):void
		{
		
			var request:URLRequest = new URLRequest(targetUrl);
			try
			{
				navigateToURL(request, '_self'); // second argument is target
			}
			catch (e:Error) 
			{
				//trace("Error occurred!");
			}
		}
		
		
		public function onOverHandler(e:MouseEvent):void
		{
			_over = true;
			
			//this.gotoAndStop('on');

		}
		
		public function onOutHandler(e:MouseEvent):void
		{
			_over = false;
			//this.gotoAndStop('off');
		}
		public function destroy():void
		{
			removeEventListener(MouseEvent.MOUSE_OVER, onOverHandler);
			removeEventListener(MouseEvent.MOUSE_OUT, onOutHandler);
			removeEventListener(MouseEvent.CLICK, onClickHandler);
		}
	}

}