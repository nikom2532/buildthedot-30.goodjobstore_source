package com.thirstyEyes.video.videoPlayer
{
	import com.thirstyEyes.signals.VideoSignals;
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.NetStatusEvent;
	import flash.media.SoundTransform;
	import flash.media.Video;
	import flash.net.NetConnection;
	import flash.net.NetStream;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.display.*;
	import com.thirstyEyes.video.videoPlayer.VideoPlayerEvent;
	import org.osflash.signals.events.GenericEvent;
	
	// TODO video background, preimenovati u VideoDisplay
	public class VideoDisplay extends Sprite
	{
		
		public var signal:VideoSignals;
		public var videoURL:String;// url for the video
		public var volume:Number = 1; // default sound volume
		
		
		//public var defaultSoundVolume:int = 1; // sound for the videos
		
		public var netConnection:NetConnection; 
		public var netStream:NetStream;
		private var netStreamClient:Object;
		public var bufferTime:int = 5; // buffer time for the videos, how many seconds of the video need to be downloaded before the video plays.

		public var paused:Boolean = true; // toggle value for pausing the video
		//public var mute:Boolean = false; // toggle value for muting the video.
	
		public var duration:Number;
		
		public var soundMuted:Boolean = false;
		private var _lastVolVal:Number;
		
		private var enterFrameBeacon:Shape;
		public var currentState:String;
		
		public var buffering:Boolean = false;
		private var _bufferFlushed:Boolean = false;
		
		private var _firstTime:Boolean = true;
		
		
		public var videoHolder:Video;
		
		
		public function VideoDisplay()
		{
			if (this.stage != null)
			{
				_init();
			}
			else
			{
				this.addEventListener(Event.ADDED_TO_STAGE, _onAddeToStage);
			}
		}
		
		private function _onAddeToStage(e:Event=null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, _onAddeToStage);
			_init();
		}
		

		
		private function _init():void
		{		
			videoHolder = new Video();
			this.addChild(videoHolder);
			netConnection = new NetConnection();
			netConnection.connect(null);
			
			netStreamClient = new Object();
			netStream = new NetStream(netConnection);
			
			videoHolder.attachNetStream(netStream);
			videoHolder.smoothing = true;
			
			signal = new VideoSignals(this, netStream);
			
			netStream.client = netStreamClient;
			
			netStreamClient.onMetaData = onMetaData;
			netStreamClient.onCuePoint = onCuePoint;
			netStreamClient.onImageData = onImageData;
			netStreamClient.onTextData = onTextData;
			netStreamClient.onXMPData = onXMPData;
			
			netStream.bufferTime = this.bufferTime;
			netStream.addEventListener(NetStatusEvent.NET_STATUS, netStatusListener);
			setVolume(volume);
			
			enterFrameBeacon = new Shape();
			
			currentState = VideoPlayerState.STOPPED;
		}// end init
		
		private function enableEnterFrame():void
		{
			enterFrameBeacon.addEventListener(Event.ENTER_FRAME, onEnterFrameHandler);
		}
		
		private function disableEnterFrame():void
		{
			enterFrameBeacon.removeEventListener(Event.ENTER_FRAME, onEnterFrameHandler);
		}
		
		private function onEnterFrameHandler(e:Event):void 
		{

			if (currentState == VideoPlayerState.BUFFERING &&paused==true)
			{
				var perc:Number = getBufferPercent();
				var calcBuffer:Number = Math.ceil(Math.min(perc, 100)) ;
				if (calcBuffer == 100)
				{
					currentState = VideoPlayerState.PAUSED;
					//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE));
					signal.stateChange.dispatch(new GenericEvent());
				}

			}
			
			signal.videoProgress.dispatch(new GenericEvent());
			
			
		}
		
			
		public function disableProgressTracking():void
		{
			disableEnterFrame();
		}
		
		public function pauseStream(pauseIt:Boolean):void
		{
			if (pauseIt)
			{
				// pause the stream
				netStream.pause();
				paused = true;
				if (currentState != VideoPlayerState.BUFFERING)
				{
					//trace('pausing stream');
					currentState = VideoPlayerState.PAUSED;
					//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE, false, false, null, null, volume, soundMuted));
					signal.stateChange.dispatch(new GenericEvent());
					
				}
				
			}
			else
			{
				// resume the stream
				//trace('resuming stream');
				netStream.resume();
				paused = false;
				if (currentState != VideoPlayerState.BUFFERING)
				{
					currentState = VideoPlayerState.PLAYING;
					//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE, false, false, null, null, volume, soundMuted));
					signal.stateChange.dispatch(new GenericEvent());
				}
			
			}

		}
		
		
		//////////////////  START SOUND CODE  ///////////////////////////////
		
		// method to set the volume.
		public function setVolume(newVol:Number):void
		{
			volume = newVol;
			netStream.soundTransform = new SoundTransform(volume);
			if (!soundMuted) _lastVolVal = volume;
			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.VOLUME_CHANGE,false,false,null,null,volume,soundMuted));
			signal.volumeChange.dispatch(new GenericEvent());
			
		}
		
		
	/**
	 * Returns the current value of the sound
	 * @return		Number	-	Number from 1 to 100
	 */
	public function getVolume():Number
	{
		return volume
	}	
		
		/**
		 * 
		 * @param		muteIt	-	Boolean	-	pass true if you want to mute the volume , otherwise false.
		 */
		public function  muteSound(muteIt:Boolean)
		{
			if (muteIt)
			{
				soundOff();
			}
			else
			{
				soundOn();
			}

			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE));
			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.VOLUME_CHANGE,false,false,null,null,volume,soundMuted));
			signal.volumeChange.dispatch(new GenericEvent());

		}
		private function soundOff()
		{
			soundMuted = true;
			this.setVolume(0);
		}
		
		private function soundOn()
		{
			soundMuted = false;
			this.setVolume(_lastVolVal);
		}
		
		////////////////////   END SOUND CODE //////////////////////////////////
		
		
		// this method plays the movie
		// url to the movie neeeds to be passed 
		public function play(url:String=null):void
		{
			//trace('movie to play'  + movieURL);
			if (url == null)
			{
				// check default url
				if (videoURL == null)
				{
					trace('url not provided and there is no default value');
					return;
				}
			}
			else
			{
				videoURL = url;
			}
			paused = false;
			netStream.play(videoURL);
			
			signal.stateChange.dispatch(new GenericEvent());
			enableEnterFrame();
			

		}
		
		/* This method is fired everytime there is a change in streaming the video.
		 * (paused , started ,stopped, buffer empty , buffer full etc...)
		 * */
		
		private function netStatusListener(e:NetStatusEvent):void
		{
			//trace("VideoBackground.netStatusListener > e : " + e);
			//trace('---- ' + e.info.code);
			if (e.info.code == "NetStream.Play.Start") // check to see if the playback has started.
			{
				//trace('stream started');
				if (!_firstTime)
				{
					currentState = VideoPlayerState.PLAYING;
					
				}
				else
				{
					currentState = VideoPlayerState.BUFFERING;
					_firstTime = false;
					_bufferFlushed = false;
				}
			}
	
			if (e.info.code == "NetStream.Play.Stop") // fired when playback has stopped.
			{ 
				// playback has stopped.
				//trace('stream stopped');
				disableEnterFrame();
				currentState = VideoPlayerState.STOPPED;
				_bufferFlushed = false;
				videoHolder.clear(); // there is a flash player bug with the clear();
				// so turn off the visibility of the Video object instance
				videoHolder.visible = false;
				
			
			}

			if (e.info.code == 'NetStream.Play.StreamNotFound') // if the video that we want to play doesn't exists (maybe wron url);
			{
				trace('ERROR  stream not found!!!!');
			}
	
			// if the buffer is empty. show the buffering mc.
			if ( e.info.code == 'NetStream.Buffer.Empty')
			{
				if (!_bufferFlushed)
				{
					//trace('class : '+'[ Model ] method : +[ netStatusListener ]'+'buffer empty ');
					currentState = VideoPlayerState.BUFFERING;
					buffering = true;
				}
				
				
			}
			if (e.info.code == 'NetStream.Buffer.Full') // buffer is full and the video is about to start.
			{
				//trace('stream buffer full');
				currentState = VideoPlayerState.BUFFER_FULL;
				buffering = false;
				//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE));
				videoHolder.visible = true;
				signal.stateChange.dispatch(new GenericEvent());
				
				if (paused)
				{
					currentState = VideoPlayerState.PAUSED;
				}
				else
				{
					currentState = VideoPlayerState.PLAYING;// ovde ide promena state-a , ako je paused ostaje pause ako je playe nastavlja PLAY .

				}
				
			}
				
			if (e.info.code == 'NetStream.Buffer.Flush') // video is about to end, and the buffer is flushed.
			{
				//trace('stream buffer flush');
				_bufferFlushed = true;
			}

			if (e.info.code ==  'NetStream.Seek.InvalidTime')
			{
				trace('invalid time');
				seek(e.info.details);
			}
		
			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE));
			signal.stateChange.dispatch(new GenericEvent());
		}
		
		
		public function stop()
		{
			netStream.close();
			currentState = VideoPlayerState.STOPPED;
			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.STATE_CHANGE));
			signal.stateChange.dispatch(new GenericEvent());
			disableEnterFrame();
		}
		
		
		// method for capturing meta data from the video.
		// do not remove this method.
		private function onMetaData(info:Object):void
		{
			
			duration = info.duration;
			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.META_DATA, false, false, null, info));
			signal.metaData.dispatch(new GenericEvent(),info);
		}
	
		// method for capturing cue point events from the video.
		// do not remove this method even if you dont use it.
		private function onCuePoint(info:Object):void
		{
			//dispatchEvent(new VideoPlayerEvent(VideoPlayerEvent.CUE_POINT, false, false, info, null));
			signal.cuePoint.dispatch(new GenericEvent(),info);
			/*
			for(var data in info)
			{
				trace('OnCuePoint ' + data + ' value ' + info[data]);
			}
			*/
		}
		
		
		private function onXMPData(info:Object):void
		{
			signal.XMPData.dispatch(new GenericEvent(),info);
		}
		
		private function onImageData(info:Object):void
		{
			signal.imageData.dispatch(new GenericEvent(),info);
		}
		
		private function onTextData(info:Object):void
		{
			signal.textData.dispatch(new GenericEvent(),info);
		}
		
		
	/**
	 * Wrapper method for the NetStream.time property.
	 * 
	 * @return		Number	-	The position of the playhead in seconds.
	 */
	public function getTime():Number
	{
		return netStream.time;
	}
	/**
	 * Returns the duration (total time) of the currently played video. 
	 * Duration is avaiable after the onMetaData event is fired from the Netstream class.
	 * 
	 * @return		Number		Total time in seconds.
	 */
	public function getDuration():Number
	{
		return duration;
	}	
	
	
	/**
	 * Wrapper method for the NetStream.bytesLoaded class property. 
	 * Returns the number of bytes currently loaded.
	 * @return		Number		Number is bytes.
	 */
	public function getBytesLoaded():Number
	{
		return netStream.bytesLoaded;
	}
	
	
	/**
	 * Wrapper for the NetStream.bytesTotal class property.
	 * Returns The total size in bytes of the file being loaded into the player.
	 * 
	 * @return		Number	-	Number in bytes
	 */
	public function getBytesTotal():Number
	{
		return netStream.bytesTotal;
	}
	

	/**
	 * Wrapper method for the NetStream.seek() .
	 * Seeks the keyframe closest to the specified number of seconds from the beginning of the stream. 
	 * The stream resumes playing when it reaches the specified location in the stream.
	 * 
	 * @param		timeTo	-	Number in seconds from the beginning of the stream.
	 */
	public function seek(timeTo:Number)
	{
		netStream.seek(timeTo);
	}
	

	
	private function calculateBuffer():Number
	{
		var totalTime:Number=getBufferTime() // The number of seconds assigned to the buffer by __netStream.setBufferTime().
		var loadedTime:Number=getBufferLength() //The number of seconds of data currently in the buffer.
		var percentage:Number = (loadedTime / totalTime) * 100;
		
		return percentage;

	}
	
	/**
	 * Calculates and returns how much of the buffer is currently filled
	 * it returns the number as a percentage from 1 to 100.
	 * If the number is 100 that means that the buffer is full and the video playback can resume playing.
	 * @return
	 */
	public function getBufferPercent():Number
	{
		return calculateBuffer();
	
	}
	
	public function getBufferTime():Number
	{
		return netStream.bufferTime;
			
	}
	
	public function getBufferLength():Number
	{
		return netStream.bufferLength;
	}
	
	public function set smoothing(value:Boolean):void
	{
		videoHolder.smoothing = value;
	}
	
	public function get smoothing():Boolean
	{
		return videoHolder.smoothing;
	}
	
	public function clear():void
	{
		videoHolder.clear();
	}

	}// end class
}// end package