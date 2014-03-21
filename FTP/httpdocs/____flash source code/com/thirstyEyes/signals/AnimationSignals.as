package com.thirstyeyes.signals 
{
	import com.thirstyeyes.interfaces.ISignalsDispatcher;
	import org.osflash.signals.DeluxeSignal;
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class AnimationSignals //implements ISignalsDispatcher
	{
		private var _outComplete:DeluxeSignal;
		private var _inComplete:DeluxeSignal;
		private var _inStart:DeluxeSignal;
		private var _outStart:DeluxeSignal;
		
		public var init:DeluxeSignal
		
		// ubaciti init signal
		
		public var target:*;
		
		public function AnimationSignals($target:*)
		{
			target = $target;
		}

		public function get outComplete():DeluxeSignal
		{
			if (_outComplete == null) _outComplete = new DeluxeSignal(target);
			
			return _outComplete;
		}
		
		public function get inComplete():DeluxeSignal
		{
			if (_inComplete == null) _inComplete = new DeluxeSignal(target);
			
			return _inComplete;
		}
		
		public function get inStart():DeluxeSignal
		{
			if (_inStart == null) _inStart= new DeluxeSignal(target);

			return _inStart;
		}
		
		public function get outStart():DeluxeSignal
		{
			if (_outStart == null) _outStart = new DeluxeSignal(target);

			return _outStart;
		}
		
		public function destroy():void 
		{
			if (_inComplete != null)
			{
				_inComplete.removeAll();
				_inComplete = null;
			}
			
			if (_outComplete != null)
			{
				_outComplete.removeAll();
				_outComplete = null;
			}
			
			if (_inStart != null)
			{
				_inStart.removeAll();
				_inStart = null;
			}
			
			if (_outStart != null)
			{
				_outStart.removeAll();
				_outStart = null;				
			}
			
			target = null;
		}
		
	}

}