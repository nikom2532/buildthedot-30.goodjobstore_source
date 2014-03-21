package com.thirstyEyes.signals 
{
	import com.ericfeminella.collections.HashMap;
	import flash.display.DisplayObject;
	import flash.events.Event;
	import flash.events.FocusEvent;
	import flash.events.MouseEvent;
	import org.osflash.signals.natives.NativeRelaySignal;
	import org.osflash.signals.natives.NativeSignal;
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class MovieClipSignals 
	{

	
		private var _click:NativeRelaySignal;
		private var _doubleClick:NativeRelaySignal;
		
		private var _mouseMove:NativeRelaySignal;
		private var _mouseOver:NativeRelaySignal;
		private var _mouseOut:NativeRelaySignal;
		
		private var _mouseWheel:NativeRelaySignal;
		
		private var _mouseDown:NativeRelaySignal;
		private var _mouseUp:NativeRelaySignal;
		
		
		private var _rollOver:NativeRelaySignal;
		private var _rollOut:NativeRelaySignal;
		
		private var _mouseFocusChange:NativeRelaySignal;
		
		private var _enterFrame:NativeRelaySignal;
		
		public var target:DisplayObject;
		
		//protected var signalsMap:HashMap;
		
		public function MovieClipSignals($target:DisplayObject) 
		{
			target = $target;	
		}
		public function get click():NativeRelaySignal
		{
			if (_click == null)
			{
				_click = new NativeRelaySignal(target, MouseEvent.CLICK, MouseEvent);
			}
			return _click;
		}
		//
		//private function testOnClick(e:MouseEvent):void 
		//{
			//trace('[ MovieClipSignals ] ' + ' [ testOnClick ] ');
			//trace('target ' + e.target);
			//trace('current target 'e.currentTarget);
			//_onClick.target = 
		//}
		//
		public function get doubleClick():NativeRelaySignal
		{
			if (_doubleClick == null)
			{
				_doubleClick = new NativeRelaySignal(target, MouseEvent.DOUBLE_CLICK, MouseEvent);
			}
			return _doubleClick;
		}
		
		public function get mouseMove():NativeRelaySignal
		{
			if (_mouseMove == null)
			{
				_mouseMove = new NativeRelaySignal(target, MouseEvent.MOUSE_MOVE, MouseEvent);
			}
			
			return _mouseMove;	
		}
		
		public function get mouseOver():NativeRelaySignal
		{
			if (_mouseOver == null)
			{
				_mouseOver = new NativeRelaySignal(target, MouseEvent.MOUSE_OVER, MouseEvent);
			}
			return _mouseOver;
		}
		
		public function get mouseOut():NativeRelaySignal
		{
			if (_mouseOut == null)
			{
				_mouseOut = new NativeRelaySignal(target, MouseEvent.MOUSE_OUT, MouseEvent);
			}		
			return _mouseOut;
		}
		
		public function get mouseWheel():NativeRelaySignal
		{
			if (_mouseWheel == null)
			{
				_mouseWheel = new NativeRelaySignal(target, MouseEvent.MOUSE_WHEEL, MouseEvent);
			}	
			return _mouseWheel;
		}
		
		public function get mouseDown():NativeRelaySignal
		{
			if (_mouseDown == null)
			{
				_mouseDown = new NativeRelaySignal(target, MouseEvent.MOUSE_DOWN, MouseEvent);
			}
			
			return _mouseDown;
		}
		
		public function get mouseUp():NativeRelaySignal
		{
			if (_mouseUp == null)
			{
				_mouseUp = new NativeRelaySignal(target, MouseEvent.MOUSE_UP, MouseEvent);
			}
			return _mouseUp;
		}
		
		public function get rollOver():NativeRelaySignal
		{
			if (_rollOver == null)
			{
				_rollOver = new NativeRelaySignal(target, MouseEvent.MOUSE_OVER, MouseEvent);
			}
			return _rollOver;
		}
		
		public function get rollOut():NativeRelaySignal
		{
			if (_rollOut == null)
			{
				_rollOut = new NativeRelaySignal(target, MouseEvent.ROLL_OUT, MouseEvent);
			}	
			return _rollOut;
		}
		
		public function get mouseFocusChange():NativeRelaySignal
		{
			if (_mouseFocusChange == null)
			{
				_mouseFocusChange = new NativeRelaySignal(target, FocusEvent.MOUSE_FOCUS_CHANGE, FocusEvent);
			}
			return _mouseFocusChange;
		}
		
		public function get enterFrame():NativeRelaySignal
		{
			if (_enterFrame == null)
			{
				_enterFrame = new NativeRelaySignal(target, Event.ENTER_FRAME, Event);
			}
			return _enterFrame;
		}
		
		
		public function destroy():void
		{
			
			if (_click != null)
			{
				_click.removeAll();
				_click = null;
			}
			if (_doubleClick != null)
			{
				_doubleClick.removeAll();
				_doubleClick = null;				
			}

			if (_mouseDown != null)
			{
				_mouseDown.removeAll();
				_mouseDown = null;
			}
			if (_mouseFocusChange != null)
			{
				_mouseFocusChange.removeAll();
				_mouseFocusChange = null;
			}
			
			if (_mouseMove != null)
			{
				_mouseMove.removeAll();
				_mouseMove = null;				
			}

			if (_mouseOut != null)
			{
				_mouseOut.removeAll();
				_mouseOut = null;
			}
			
			if (_mouseOver != null)
			{
				_mouseOver.removeAll();
				_mouseOver = null;				
			}
			
			if (_mouseUp != null)
			{
				_mouseUp.removeAll();
				_mouseUp = null;
			}
			if (_mouseWheel!= null)
			{
				_mouseWheel.removeAll();
				_mouseWheel = null;
			}
			if (_rollOut != null)
			{
				_rollOut.removeAll();
				_rollOut = null;	
			}
			
			if (_enterFrame != null)
			{
				_enterFrame.removeAll();
				_enterFrame = null;
			}
			target = null;
		}
	}

}