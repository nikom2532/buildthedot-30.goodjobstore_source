package
{
	import com.thirstyEyes.utils.NumberIterator;
	import com.thirstyEyes.utils.StringToBoolean;
	import com.thirstyEyes.utils.MathHelp;
	import com.thirstyEyes.video.FlashVars;
	import com.thirstyEyes.video.LocalVideo;
	import com.thirstyEyes.video.LocalVO;
	import com.thirstyEyes.Align;
	import com.thirstyEyes.video.videoPlayer.VideoPlayerEvent;
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.NetStatusEvent;
	import flash.external.ExternalInterface;
	import flash.geom.ColorTransform;
	import flash.media.SoundTransform;
	import flash.media.Video;
	import flash.net.navigateToURL;
	import flash.net.NetConnection;
	import flash.net.NetStream;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.display.*;
	import flash.utils.getDefinitionByName;
	import org.osflash.signals.events.GenericEvent;
	import org.osflash.signals.events.IEvent;
	
	public class Main_no_buttons extends MovieClip
	{
		public var xml:XML; // holds the xml 
		public var iterator:NumberIterator; // number that is used to go through the videos
		public var videoURL:String; // url for the video
		public var xmlLoader:URLLoader; // loader for xml
		public var random:Boolean; // if random video is going to be used (checks the xml)
		public var maxVideos:int; // how many videos there is 
		
		public var defaultSoundVolume:int = 1; // sound for the videos
		

		public var paused:Boolean = false; // toggle value for pausing the video
		public var mute:Boolean = false; // toggle value for muting the video.

		public var duration:Number; // duration for the video

		
		private var fullScreenBtn:MovieClip;
		private var fullScreenBtnPos:String;
		
		
		
		public var localVid:LocalVideo;
		public var showFullBtn:Boolean;
		public var fullBtnPos:String;
		
		
		public var flashVars:FlashVars

		public var autoStart:Boolean;
		public var appStarted:Boolean = false;
		public var localVO:LocalVO;
		public var loopList:Boolean;
		public var skipUrlButton:MovieClip;
		public var skipBtnText:String;
		private var yOffset:Number = 0;
		public var skipUrl:String;// skip to url variable.

		
		public function Main_no_buttons():void
		{
			if (stage == null)
			{
				addEventListener(Event.ADDED_TO_STAGE,_onAddedToStage)
			}
			else
			{
				init();
			}
		}
		
		private function _onAddedToStage(e:Event):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, _onAddedToStage);
			init();
		}
		
		private function init():void
		{
			
		
			//trace('------------------ FLASH VARS ' + this.loaderInfo.parameters);
			//for (var i:String in parameters) trace("key : " + i + ", value : " + parameters[i]);
			
			flashVars = new FlashVars(this.loaderInfo.parameters);
			stage.scaleMode = StageScaleMode.NO_SCALE;
			stage.align = StageAlign.TOP_LEFT;

			stage.addEventListener(Event.RESIZE, stageResize);
			
			xmlLoader = new URLLoader();
			xmlLoader.load(new URLRequest(flashVars.xmlPath)); // load the xml file.
			xmlLoader.addEventListener(Event.COMPLETE, xmlComplete);
			
			initExternalCommunication();
			
		}// end init
		
		private function stageResize(e:Event):void 
		{
			if (!appStarted) return;
			if (showFullBtn)
			{
				positionFullScreenButton();
			}
			if (skipUrlButton != null)
			{
				positionSkipUrlButton();
			}
		}
		

		

		/* This method is fired when xml file is loaded.
		 * it populates all the variables and starts the video.
		 * 
		 * */
		private function xmlComplete(e:Event):void
		{
			xml = new XML(e.target.data);
			var videoList:XMLList = xml.children();
			maxVideos = videoList.length() - 1;
			iterator = new NumberIterator(0, maxVideos);
			
			
			localVO = new LocalVO();// local VO is the object that holds initializing values for video background.
			localVO.showBars = StringToBoolean.convert(xml.@show_progress_bar);
			localVO.showBuffer = StringToBoolean.convert(xml.@show_buffer_indicator);
			
			autoStart = StringToBoolean.convert(xml.@auto_start);
			
			localVO.videoStretch =  xml.@video_stretch;
			
			localVO.progressColor = xml.@progress_bar_color;
			localVO.loadColor = xml.@loading_bar_color;

			
			random =  StringToBoolean.convert(xml.@random);// this method converts the strings "false" and "true" to Boolean values.
			showFullBtn= StringToBoolean.convert(xml.@full_screen_button)
			fullBtnPos = xml.@position;// position for the full screen button
			
			localVO.pattern = xml.@pattern;
			
			
			skipUrl = xml.@skip_url;
			skipBtnText = xml.@skip_btn_text;
			//trace("skipBtnText : " + skipBtnText);
			//trace("skipUrl : " + skipUrl);
			//trace("skipUrl length : " + skipUrl.length);
			
			loopList = StringToBoolean.convert(xml.@loop_list);
			//trace("loopList : " + loopList);

			if(localVO.showBars) yOffset = 4; // this is the height of the progress bars;
		
			// if the file should start automatically
			if (autoStart)
			{
				start();
			}

			if (ExternalInterface.available)
			{
				ExternalInterface.call('onReady',flashVars.id );
			}
			
		}// end xml complete
		
		
		public function start():void
		{
			appStarted = true;
			localVid = new LocalVideo(localVO);
			addChildAt(localVid,0);
			

			localVid.videoBackground.signal.netStatus.add(netStatusListener);
			
			localVid.videoBackground.signal.cuePoint.add(this.onCuePoint);
			
			
			localVid.videoBackground.signal.imageData.add(this.onImageData);
						
			localVid.videoBackground.signal.textData.add(this.onTextData);
			
			localVid.videoBackground.signal.XMPData.add(this.onXMPData);
			
			
			if (showFullBtn)// if the full screen button should be displayed.
			{
				initFullScreenButton();
			
			}
			if (skipUrl.length > 0 )
			{
				initSkipUrlButton();
			}
			
			
			if (random)
			{
				// play random videos
				playRandom();
			}
			else
			{
				playNext();
			}
		}
		

	
		// method for capturing cue point events from the video.
		// do not remove this method even if you dont use it.
		
		//  fired when cuepoint data has been dispatched.
		public function onCuePoint($e:IEvent,info:Object):void
		{
			/*			
			for(var data in info)
			{
				trace('OnCuePoint ' + data + ' value ' + info[data]);
			}
			*/
		}
		
		
		/*
		 * do not remove these methods ,they are required for HD content
		 * */
		
		public function onXMPData($e:IEvent,info:Object):void
		{
			
		}
		
		public function onImageData($e:IEvent,info:Object):void
		{
			
		}
		
		public function onTextData($e:IEvent,info:Object):void
		{
			
		}
		
		
		// play the next movie in line
		private function playNext():void 
		{
			videoURL = xml.*[iterator.getCurrent()].@url;// ok
			localVid.playMovie(videoURL);
			_checkForMute();
		}
		
		
		private function _checkForMute():void
		{
			// check to see if the video needs to be muted.
			var m:Boolean = StringToBoolean.convert(xml.*[iterator.getCurrent()].@mute_on_start);
			
			localVid.videoBackground.muteSound(m);
			mute = m;
		}
		
		
		// initialize full screen button
		private function initFullScreenButton():void
		{
			
			fullScreenBtn = new FullScreenButton();
			fullScreenBtn.cacheAsBitmap = true;
			this.addChild(fullScreenBtn);
			positionFullScreenButton();
			
			
		}
		
		private function positionFullScreenButton():void
		{

			switch (fullBtnPos) 
			{
				case 'top_left':
				Align.topLeft(fullScreenBtn);
				
				break;
				
				case 'top_right':
					Align.topRight(fullScreenBtn);
				
				break;
				
				case 'bottom_left':
					Align.bottomLeft(fullScreenBtn);
					fullScreenBtn.y -= yOffset;
				break;
				
				case 'bottom_right' :
					Align.bottomRight(fullScreenBtn);
					fullScreenBtn.y -= yOffset;
				break;
				
			}
		}
		
		private function initSkipUrlButton():void
		{
			skipUrlButton = new SkipUrlButton();
			skipUrlButton.setText(skipBtnText);
			
			this.addChild(skipUrlButton);
			skipUrlButton.cacheAsBitmap = true;
			skipUrlButton.targetUrl = skipUrl;
			positionSkipUrlButton();
		}
		
		private function positionSkipUrlButton():void
		{
			switch (fullBtnPos) 
			{
				case 'top_left':
					Align.topLeft(skipUrlButton);
					if (showFullBtn) skipUrlButton.x = fullScreenBtn.x +fullScreenBtn.width;
				
				break;
				
				case 'top_right':
					Align.topRight(skipUrlButton);
					if(showFullBtn) skipUrlButton.x = fullScreenBtn.x -skipUrlButton.width;
				break;
				
				case 'bottom_left':
					Align.bottomLeft(skipUrlButton);
					if (showFullBtn) skipUrlButton.x = fullScreenBtn.x +fullScreenBtn.width;
					skipUrlButton.y -= yOffset;
				
				break;
				
				case 'bottom_right' :
					Align.bottomRight(skipUrlButton);
					if(showFullBtn) skipUrlButton.x = fullScreenBtn.x -skipUrlButton.width;
					skipUrlButton.y -= yOffset; 
				break;
				
			}
		}

		/* This method is fired everytime there is a change in streaming the video.
		 * (paused , started ,stopped, buffer empty , buffer full etc...)
		 * */
		
		public function netStatusListener(e:NetStatusEvent):void
		{
			if (e.info.code == "NetStream.Play.Start") // check to see if the playback has started.
			{

			}
	
			if (e.info.code == "NetStream.Play.Stop") // fired when playback has stopped.
			{ // playback has stopped.

				
				if (iterator.getCurrent() == maxVideos)
				{
					if (!loopList)
					{
						if (skipUrlButton != null)
						{
							
						
							var request:URLRequest = new URLRequest(skipUrl);
							try
							{
								navigateToURL(request, '_self'); // second argument is target
							}
							catch (e:Error) 
							{
								//trace("Error occurred!");
							}	
						}		
						localVid.videoBackground.stop();
						return;
					}

				}
				if (random)
				{
					//play random movie
					playRandom();
				}
				else
				{
					
					//play in sequence
					playMovieByNum(iterator.increase());	

				}
				
				//videoObjectInstance.visible = false;
				//navigateToURL(new URLRequest('http://www.google.com'));
	
			}

			if (e.info.code == 'NetStream.Play.StreamNotFound') // if the video that we want to play doesn't exists (maybe wrong url);
			{
				trace('ERROR  stream not found!!!!');
			}
	
			// if the buffer is empty. show the buffering mc.
			if ( e.info.code == 'NetStream.Buffer.Empty')
			{

				
			}
			if (e.info.code == 'NetStream.Buffer.Full') // buffer is full and the video is about to start.
			{

				
			}
				
			if (e.info.code == 'NetStream.Buffer.Flush') // video is about to end, and the buffer is flushed.
			{
				
			}
			
		}


		
	// play random movie.
	public function playRandom():void
	{
		iterator.iterator = MathHelp.randomRange(maxVideos);
		
		videoURL = xml.*[iterator.getCurrent()].@url;
		localVid.playMovie(videoURL);
		_checkForMute();
	}

	// function to play the movie by the number
	// number 3 - plays the 4!! movie in the xml file.
	public function playMovieByNum(newNum:int):void
	{
		iterator.iterator = newNum;
		videoURL = xml.*[iterator.getCurrent()].@url;
	
		localVid.playMovie(videoURL);
		_checkForMute();

	}
	
	// toggle sound on - off for the video - by pressing the mute button.
	public function muteOnClick(e:MouseEvent=null):void
	{
		if (mute)
		{
			// unmute
			mute = false;
			e.target.gotoAndStop('onOver');
			localVid.videoBackground.muteSound(false);

		}
		else
		{
			// mute
			mute = true;
			localVid.videoBackground.muteSound(true);
			e.target.gotoAndStop('offOver');
		}	
	}
	
	//  START EXTERNAL INTERFACE CODE 
	
	// this code deals with JavaScript to Flash Communication.
	public function initExternalCommunication():void
	{
		if (ExternalInterface.available)
		{

			//trace("EXTERNA AVAILABLE !!!!!");
			ExternalInterface.addCallback("pause", EIPause);
			ExternalInterface.addCallback("resume", EIResume);
			ExternalInterface.addCallback("start", EIStart );
			ExternalInterface.addCallback("muteVideo", EIMuteVideo);

			ExternalInterface.addCallback("playMovieByNum", EIPlayMovieByNum);
			ExternalInterface.addCallback("nextMovie",EINext);
			ExternalInterface.addCallback("previousMovie", EIPrevious);
			ExternalInterface.addCallback("previousMovie", EIPrevious);
			
		}
	}
	

	// play movie by num
	public function EIPlayMovieByNum(value:int):void
	{		
		playMovieByNum(--value);
	}
	
	// pause the movie
	public function EIPause():void
	{		
		localVid.videoBackground.pauseStream(true);
	}
	
	// resume
	public function EIResume():void
	{
		localVid.videoBackground.pauseStream(false);
	}
	
	// next movie in line
	public function EINext():void
	{
		playMovieByNum(iterator.increase());	
	}
	
	//previous movie in line
	public function EIPrevious():void
	{
		playMovieByNum(iterator.decrease());	
		
	}
		
	// start the background
	public function EIStart():void
	{
		if (appStarted) return;
		start();
	}
	
	// mute video.
	public function EIMuteVideo(muteIt:Boolean):void
	{
		mute = muteIt;
		if (mute)
		{
			localVid.videoBackground.muteSound(true);
		}
		else
		{
			localVid.videoBackground.muteSound(false);
		}
	}
		
	// END EXTERNAL INTERFACE CODE
	
	
	}// end class
}// end package