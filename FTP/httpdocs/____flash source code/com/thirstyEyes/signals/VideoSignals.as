package com.thirstyEyes.signals 
{

	import flash.events.NetStatusEvent;
	import flash.net.NetStream;
	import org.osflash.signals.DeluxeSignal;
	import org.osflash.signals.events.IEvent;
	import org.osflash.signals.natives.NativeRelaySignal;
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class VideoSignals
	{

		private var _netStatus:NativeRelaySignal;

		private var _textData:DeluxeSignal;
		private var _imageData:DeluxeSignal;
		private var _XMPData:DeluxeSignal;
		private var _metaData:DeluxeSignal;
		
		private var _cuePoint:DeluxeSignal;
		private var _volumeChange:DeluxeSignal;
		private var _videoProgress:DeluxeSignal;
		
		private var _displayChange:DeluxeSignal;
		private var _stateChange:DeluxeSignal;
		
		private var _playStatus:DeluxeSignal;
		
		
		private var _timeChange:DeluxeSignal;
		
		
		
		public var target:*;
		public var netStreamTarget:NetStream;
		
		
		public function VideoSignals($target:*,$netStreamTarget:NetStream) 
		{
			target = $target
			netStreamTarget = $netStreamTarget;
		}
		
		public function get netStatus():NativeRelaySignal
		{
			if (_netStatus == null)
				_netStatus = new NativeRelaySignal(netStreamTarget, NetStatusEvent.NET_STATUS, NetStatusEvent);
			
			return _netStatus;
		}
		
		public function get textData():DeluxeSignal
		{
			if ( _textData == null)
				_textData =new DeluxeSignal(target,IEvent,Object);
				
				return _textData;
		}
		
		public function get imageData():DeluxeSignal
		{
			if ( _imageData== null)
				_imageData = new DeluxeSignal(target,IEvent,Object);
				return _imageData;
		}
		
		public function get XMPData():DeluxeSignal
		{
			if ( _XMPData == null)
				_XMPData = new DeluxeSignal(target,IEvent,Object);
				
			return _XMPData;
		}
		
		public function get metaData():DeluxeSignal
		{
			if ( _metaData == null)
				_metaData = new DeluxeSignal(target,IEvent,Object);
				
			return _metaData;
		}
		
		public function get cuePoint():DeluxeSignal
		{
			if ( _cuePoint == null)
				_cuePoint = new DeluxeSignal(target,IEvent,Object);
				
			return _cuePoint;
		}
		
		public function get volumeChange():DeluxeSignal
		{
			if ( _volumeChange == null)
				_volumeChange = new DeluxeSignal(target);
				
			return _volumeChange;
		}
		
		public function get videoProgress():DeluxeSignal
		{
			if ( _videoProgress == null)
				_videoProgress = new DeluxeSignal(target);
				
			return _videoProgress;
		}
		
		public function get displayChange():DeluxeSignal
		{
			if ( _displayChange == null)
				_displayChange = new DeluxeSignal(target);
				
			return _displayChange;
		}
		
		public function get stateChange():DeluxeSignal
		{
			if ( _stateChange == null)
				_stateChange = new DeluxeSignal(target);
				
			return _stateChange;
		}
		
		public function get playStatus():DeluxeSignal
		{
			if ( _playStatus == null)
				_playStatus =  new DeluxeSignal(target);
				
			return _playStatus;
		}
		
		public function get timeChange():DeluxeSignal
		{
			if ( _timeChange == null)
				_timeChange = new DeluxeSignal(target);
				
			return _timeChange;
		}

		public function destroy():void
		{
			
			if (_netStatus != null)
			{
				_netStatus.removeAll();
				_netStatus = null;
			}
			
			if (_textData != null)
			{
				_textData.removeAll();
				_textData = null;
			}
			if (_XMPData != null)
			{
				_XMPData.removeAll();
				_XMPData = null;
			}
			
			if (_metaData != null)
			{
				_metaData.removeAll();
				_metaData = null;
			}
			
			if (_imageData != null)
			{
				_imageData.removeAll();
				_imageData = null;
			}
			
			if (_cuePoint != null)
			{
				_cuePoint.removeAll();
				_cuePoint = null;
			}
			
			
			if (_volumeChange != null)
			{
				_volumeChange.removeAll();
				_volumeChange = null;
			}
			
			if (_videoProgress != null)
			{
				_videoProgress.removeAll();
				_videoProgress = null;
			}
			
			if (_displayChange != null)
			{
				_displayChange.removeAll();
				_displayChange = null;
			}
			
			if (_stateChange != null)
			{
				_stateChange.removeAll();
				_stateChange = null;
				
			}
			if (_playStatus != null)
			{
				_playStatus.removeAll();
				_playStatus = null;
			}
			if (_timeChange != null)
			{
				_timeChange.removeAll();
				_timeChange = null;
			}
		}	
	}
}