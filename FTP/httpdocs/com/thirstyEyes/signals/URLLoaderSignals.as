package com.thirstyeyes.signals 
{
	import com.thirstyeyes.interfaces.ISignalsDispatcher;
	import flash.events.Event;
	import flash.events.HTTPStatusEvent;
	import flash.events.IOErrorEvent;
	import flash.events.ProgressEvent;
	import flash.net.URLLoader;
	import org.osflash.signals.natives.NativeRelaySignal;
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class URLLoaderSignals implements ISignalsDispatcher
	{

		private var _complete:NativeRelaySignal;
		private var _httpStatus:NativeRelaySignal;
		private var _ioError:NativeRelaySignal;
		private var _open:NativeRelaySignal;
		private var _progress:NativeRelaySignal;
		
		public var target:URLLoader;
		
		public function URLLoaderSignals($target) 
		{
			target = $target
		}
		
		public function get complete():NativeRelaySignal
		{
			if (_complete == null) _complete = new NativeRelaySignal(target, Event.COMPLETE, Event);
	
			return _complete;
		}
		
		public function get httpStatus():NativeRelaySignal
		{
			if (_httpStatus == null) _httpStatus= new NativeRelaySignal(target, HTTPStatusEvent.HTTP_STATUS, HTTPStatusEvent);
	
			return _httpStatus;
		}
		
		public function get ioError():NativeRelaySignal
		{
			if (_ioError == null) _ioError = new NativeRelaySignal(target, IOErrorEvent.IO_ERROR, IOErrorEvent);

			return _ioError;
		}
		
		public function get open():NativeRelaySignal
		{
			if (_open == null) _open = new NativeRelaySignal(target, Event.OPEN, Event);
			
			return _open;
		}
		
		public function get progress():NativeRelaySignal
		{
			if (_progress == null) _progress = new NativeRelaySignal(target, ProgressEvent.PROGRESS, ProgressEvent);
			
			return _progress;
		}
		public function destroy():void
		{
			_complete.removeAll();
			_complete = null;
			
			_httpStatus.removeAll();
			_httpStatus = null;
			
			_ioError.removeAll();
			_ioError = null;
			
			_open.removeAll();
			_open = null;
			
			_progress.removeAll();
			_progress = null;
		
			target = null;
		}
		
	}

}