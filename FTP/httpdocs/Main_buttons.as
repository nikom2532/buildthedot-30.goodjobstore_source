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
	
	public class Main_buttons extends MovieClip
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
		
		public var duration:Number;

		private var fullScreenBtn:MovieClip;
		private var fullScreenBtnPos:String;
		
		public var localVid:LocalVideo;
		public var showFullBtn:Boolean;
		public var fullBtnPos:String;
		
		public var flashVars:FlashVars
		public var autoStart:Boolean = true;
		public var appStarted:Boolean = false;
		public var localVO:LocalVO;
		public var loopList:Boolean;
		public var skipUrlButton:MovieClip;
		public var skipBtnText:String;
		private var yOffset:Number = 0;
		public var skipUrl:String;// skip to url variable.

		
				
		public function Main_buttons():void
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
			
			flashVars = new FlashVars(stage.loaderInfo.parameters);
			stage.scaleMode = StageScaleMode.NO_SCALE;
			stage.align = StageAlign.TOP_LEFT;

			stage.addEventListener(Event.RESIZE, stageResize);
			
			xmlLoader = new URLLoader();
			xmlLoader.load(new URLRequest(flashVars.xmlPath)); // load the xml file.
			xmlLoader.addEventListener(Event.COMPLETE, xmlComplete);

			
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
			
			localVO = new LocalVO();
			localVO.showBars = StringToBoolean.convert(xml.@show_progress_bar);
			localVO.showBuffer = StringToBoolean.convert(xml.@show_buffer_indicator);

			localVO.videoStretch =  xml.@video_stretch;

			localVO.progressColor = xml.@progress_bar_color;
			localVO.loadColor = xml.@loading_bar_color;

			random =  StringToBoolean.convert(xml.@random);// this method converts the strings "false" and "true" to Boolean values.
			var random =  StringToBoolean.convert(xml.@random);// this method converts the strings "false" and "true" to Boolean values.
			showFullBtn= StringToBoolean.convert(xml.@full_screen_button)
			fullBtnPos = xml.@position;

			localVO.pattern = xml.@pattern;
			skipUrl = xml.@skip_url;
			skipBtnText = xml.@skip_btn_text;
			//trace("skipBtnText : " + skipBtnText);
			//trace("skipUrl : " + skipUrl);
			//trace("skipUrl length : " + skipUrl.length);
			
			loopList = StringToBoolean.convert(xml.@loop_list);
			//trace("loopList : " + loopList);
			if (autoStart)
			{
				start();
			}

			// check to see if the external interface is available.
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
			
			if (showFullBtn)
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
			
			initDemoButtons();

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
		private function playNext():void 
		{
			videoURL = xml.*[iterator.getCurrent()].@url;// ok
			
			localVid.playMovie(videoURL);
			_checkForMute();
			
		}
		
		// check for mute on start
		private function _checkForMute():void
		{
			// check to see if the video needs to be muted immediately after it starts playing.
			var m:Boolean = StringToBoolean.convert(xml.*[iterator.getCurrent()].@mute_on_start);
			
			localVid.videoBackground.muteSound(true);
			mute = m;
		}	
		
		// initialize the full screen button
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
				break;
				
				case 'bottom_right' :
					Align.bottomRight(fullScreenBtn);
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
			{ 
				// playback has stopped.
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
				
				//navigateToURL(new URLRequest('http://www.google.com'));
	
			}

			if (e.info.code == 'NetStream.Play.StreamNotFound') // if the video that we want to play doesn't exists (maybe wron url);
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
		//trace('videoURL ' + videoURL);
		
		localVid.playMovie(videoURL);
		_checkForMute();
	}

	// function to play the movie by the number
	// number 3 - plays the  4!! movie in the xml file !
	public function playMovieByNum(newNum:int):void
	{
		iterator.iterator = newNum;
		videoURL = xml.*[iterator.getCurrent()].@url;

		localVid.playMovie(videoURL);
		_checkForMute();

	}
	
	
	
	//// --------------------- START BUTTON CODE -------------------------------------
	
	// this code wraps up demo buttons functionality.
	
	private function initDemoButtons():void
	{
		
			// assign methods for the lef and right arrows -CLICK
			arrowsHolder.arrowLeft.addEventListener(MouseEvent.CLICK, arrowLeftClick);
			arrowsHolder.arrowRight.addEventListener(MouseEvent.CLICK, arrowRightClick);
			
			arrowsHolder.arrowLeft.buttonMode = true;
			arrowsHolder.arrowRight.buttonMode = true;
			
			// Movie buttons 
			playSpecHolder.play_1.buttonMode = true;
			playSpecHolder.play_2.buttonMode = true;
			playSpecHolder.play_3.buttonMode = true;
			playSpecHolder.play_4.buttonMode = true;
			playSpecHolder.play_5.buttonMode = true;
			
			// assign method for changing the videos, when the buttons are clicked.
			playSpecHolder.addEventListener(MouseEvent.CLICK, numButtonClick);

			
			// Play - pause button.
			playSpecHolder.playPause_btn.buttonMode = true;
			playSpecHolder.playPause_btn.gotoAndStop('pause');
			
			// assign the method for roll-over
			playSpecHolder.playPause_btn.addEventListener(MouseEvent.ROLL_OVER, playPauseOnRollOver);
			//assign the method for roll-out
			playSpecHolder.playPause_btn.addEventListener(MouseEvent.ROLL_OUT, playPauseOnRollOut);
			// assign the method for click
			playSpecHolder.playPause_btn.addEventListener(MouseEvent.CLICK, playPauseOnClick);
			
			// mute button
			playSpecHolder.mute_btn.buttonMode = true;
			playSpecHolder.mute_btn.gotoAndStop('on');
			// mute button on roll over
			playSpecHolder.mute_btn.addEventListener(MouseEvent.ROLL_OVER, muteOnRollOver);
			// mute button on roll out
			playSpecHolder.mute_btn.addEventListener(MouseEvent.ROLL_OUT, muteOnRollOut);
			// mute button on click
			playSpecHolder.mute_btn.addEventListener(MouseEvent.CLICK, muteOnClick);
			
						
			moreDemos_mc.cacheAsBitmap = true;
			moreDemos_mc.link_1_mc.mouseChildren = false;
			moreDemos_mc.link_1_mc.buttonMode = true;
			
			moreDemos_mc.link_2_mc.mouseChildren = false;
			moreDemos_mc.link_2_mc.buttonMode = true;
			
			moreDemos_mc.link_1_mc.addEventListener(MouseEvent.CLICK, _onLinkOneClick);
			moreDemos_mc.link_1_mc.addEventListener(MouseEvent.MOUSE_OVER, _onLinkOver);
			moreDemos_mc.link_1_mc.addEventListener(MouseEvent.MOUSE_OUT, _onLinkOut);
			
			
			
			moreDemos_mc.link_2_mc.addEventListener(MouseEvent.CLICK, _onLinkTwoClick);
			moreDemos_mc.link_2_mc.addEventListener(MouseEvent.MOUSE_OVER, _onLinkOver);
			moreDemos_mc.link_2_mc.addEventListener(MouseEvent.MOUSE_OUT, _onLinkOut);
			
			// assign the method for  changing the scan lines.
			chooseScanLines_mc.addEventListener(MouseEvent.CLICK, chooseScanLinesClick);
			
			chooseScanLines_mc.butt_1.buttonMode = true;
			chooseScanLines_mc.butt_2.buttonMode = true;
			chooseScanLines_mc.butt_3.buttonMode = true;
			chooseScanLines_mc.butt_4.buttonMode = true;
			chooseScanLines_mc.butt_5.buttonMode = true;
			chooseScanLines_mc.butt_6.buttonMode = true;
			chooseScanLines_mc.butt_7.buttonMode = true;
			chooseScanLines_mc.butt_8.buttonMode = true;
			chooseScanLines_mc.butt_9.buttonMode = true;
			
			chooseScanLines_mc.no_scan.buttonMode = true;
			
			chooseScanLines_mc.goFull.buttonMode = true;
			
			// assign the method to button to go full screen.
			chooseScanLines_mc.goFull.addEventListener(MouseEvent.CLICK, goFullOnClick);
			
			chooseScanLines_mc.cacheAsBitmap = true;
			arrowsHolder.cacheAsBitmap = true;
			playSpecHolder.cacheAsBitmap = true;
			
			
			this.addChild(chooseScanLines_mc);
			this.addChild(playSpecHolder);
			
			this.addChild(arrowsHolder);
			
			this.addChild(moreDemos_mc);

			this.addChild(movieName_mc);
			
			positionDemoButtons();
			
			stage.addEventListener(Event.RESIZE, positionDemoButtons);
			// initialize movie names
			localVid.videoBackground.signal.netStatus.add(_changeMovieName);
	}
	
	private function _changeMovieName($e:NetStatusEvent):void 
	{
		if ($e.info.code == "NetStream.Play.Start") // check to see if the playback has started.
		{
			movieName_mc.info_txt.text = "Movie name : " + xml.*[iterator.getCurrent()].@name;
		}
	}
	
	private function _onLinkOut(e:MouseEvent):void 
	{
		e.target.back_mc.alpha = 0;
	}
	
	private function _onLinkOver(e:MouseEvent):void 
	{
		e.target.back_mc.alpha = 1;
	}
	
	private function _onLinkOneClick(e:MouseEvent):void 
	{
		navigateToURL(new URLRequest('http://www.wpvideobackground.com'), '_blank');
	}
	private function _onLinkTwoClick(e:MouseEvent):void 
	{
		navigateToURL(new URLRequest('../Background with Overlay and JavaScript/html_overlay.html'), '_blank');
	}
		
	private function positionDemoButtons($e:Event=null):void
	{
			Align.topMiddle(chooseScanLines_mc);

			Align.center(arrowsHolder);
			arrowsHolder.y = chooseScanLines_mc.height + chooseScanLines_mc.y + 30;
	
			Align.center(playSpecHolder);
			
			playSpecHolder.x += 57;
			playSpecHolder.y = arrowsHolder.y + arrowsHolder.height + 20;
			
			Align.center(movieName_mc);

			movieName_mc.y = playSpecHolder.y + playSpecHolder.height + 20;

			Align.center(moreDemos_mc);
			moreDemos_mc.y = movieName_mc.y + movieName_mc.height + 20;
	}

	
	// choose what movie to play by checking which movie button was clicked.
	public function numButtonClick(e:MouseEvent):void
	{
		var targetName:String = e.target.name;
		switch(targetName)
		{
			case 'play_1':
				playMovieByNum(iterator.iterator = 0);
				paused = false;
				playSpecHolder.playPause_btn.gotoAndStop('pause');
				break;
			case 'play_2':
				playMovieByNum(iterator.iterator = 1);
				paused = false;
				playSpecHolder.playPause_btn.gotoAndStop('pause');
				break;
			case 'play_3':
				playMovieByNum(iterator.iterator = 2);
				paused = false;
				playSpecHolder.playPause_btn.gotoAndStop('pause');
				break;
			case 'play_4':
				playMovieByNum(iterator.iterator = 3);
				paused = false;
				playSpecHolder.playPause_btn.gotoAndStop('pause');
				break;
			case 'play_5':
				playMovieByNum(iterator.iterator = 4);
				paused = false;
				playSpecHolder.playPause_btn.gotoAndStop('pause');
				break;
				
			default:

		}
	}
	

	// choose what pattern to use by checking which button was clicked.
	public function chooseScanLinesClick(e:MouseEvent):void
	{	
		var targetName:String = e.target.name;

		switch(targetName)
		{
			case 'butt_1':
				localVid.pattern.loadPattern( new Pattern_1(0, 0))
			break;

			case 'butt_2':
				localVid.pattern.loadPattern( new Pattern_2(0, 0))

			break;
			case 'butt_3':
				localVid.pattern.loadPattern( new Pattern_3(0, 0))

			break;
			case 'butt_4':
				localVid.pattern.loadPattern( new Pattern_4(0, 0))

			break;
			case 'butt_5':
				localVid.pattern.loadPattern( new Pattern_5(0, 0))

			break;
			case 'butt_6':
				localVid.pattern.loadPattern( new Pattern_6(0, 0))

			break;
			case 'butt_7':
				localVid.pattern.loadPattern( new Pattern_7(0, 0))

			break;
			case 'butt_8':
				localVid.pattern.loadPattern( new Pattern_8(0, 0))

			break;
			case 'butt_9':
				localVid.pattern.loadPattern( new Pattern_9(0, 0))

			break;
			case 'no_scan':
				
				localVid.pattern.clearPattern();
				trace('no scan');
			break;

			break;
			default:	
		}
	}
	
	// play or pause the movie when the play-pause button is clicked.
	public function playPauseOnClick(e:MouseEvent):void
	{
		if (paused)
		{
			//trace("paused : " + paused);
			localVid.videoBackground.pauseStream(false);
			paused = false;
			playSpecHolder.playPause_btn.gotoAndStop('pauseOver');
		}
		else
		{
			//netStream.pause();
			paused = true;
			//player.pauseVideo();
			localVid.videoBackground.pauseStream(true);
			playSpecHolder.playPause_btn.gotoAndStop('playOver');
		}
	}
	
	// on roll over method.
	public function playPauseOnRollOver(e:MouseEvent):void
	{
		if (paused)
		{
			e.target.gotoAndStop('playOver');
		}
		else
		{
			e.target.gotoAndStop('pauseOver');
		}
	}
	
	// on roll out method
	public function playPauseOnRollOut(e:MouseEvent):void
	{
		if (paused)
		{
			e.target.gotoAndStop('play');
		}
		else
		{
			e.target.gotoAndStop('pause');
		}
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
	
	// mute on roll over.
	public function muteOnRollOver(e:MouseEvent):void
	{
		if (mute)
		{
			e.target.gotoAndStop('offOver');

		}
		else
		{
			e.target.gotoAndStop('onOver');
		}	
	}
	
	// mute on roll-out.
	public function muteOnRollOut(e:MouseEvent):void
	{
		if (mute)
		{
			e.target.gotoAndStop('off');

		}
		else
		{
			e.target.gotoAndStop('on');
		}	
	}	
	
	
	// go full screen method when the full screen button is clicked.
	public function goFullOnClick(e:MouseEvent):void
	{
		if (stage.displayState == StageDisplayState.FULL_SCREEN)
		{
			// go to normal mode
			stage.displayState = StageDisplayState.NORMAL;
		}
		else
		{
			stage.displayState = StageDisplayState.FULL_SCREEN;
		}
	}
	
	// left arrow method.
	// plays previous  movie
	public function arrowLeftClick(e:MouseEvent):void
	{
		if (random)
		{
			// play random movie
			playRandom();
		}
		else
		{
			// play in sequence
			playMovieByNum(iterator.decrease());	

		}
		paused = false;
		playSpecHolder.playPause_btn.gotoAndStop('pause');
	}
	
	// right arrow method
	// plays the next movie.
	public function arrowRightClick(e:MouseEvent):void
	{
		if (random)
		{
			// play random movie
			playRandom();
		}
		else
		{
		// play in sequence
		playMovieByNum(iterator.increase());	

		}
		paused = false;
		playSpecHolder.playPause_btn.gotoAndStop('pause');
	}

	//// END BUTTON CODE
	
		
	
	////  START EXTERNAL INTERFACE CODE 
	
	
	
	// check to see if the external interface is available.
	public function initExternalCommunication():void
	{
		if (ExternalInterface.available)
		{

			ExternalInterface.addCallback("pause", EIPause);
			ExternalInterface.addCallback("resume", EIResume);
			ExternalInterface.addCallback("muteVideo", EIMuteVideo);
			
			ExternalInterface.addCallback("playMovieByNum", EIPlayMovieByNum);
			ExternalInterface.addCallback("nextMovie",EINext);
			ExternalInterface.addCallback("previousMovie",EIPrevious);	
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
		if (!mute)
		{
			playSpecHolder.mute_btn.gotoAndStop('onOver');
			localVid.videoBackground.muteSound(false);

		}
		else
		{
			// mute
			playSpecHolder.mute_btn.gotoAndStop('offOver');
			localVid.videoBackground.muteSound(true);
		}
	}
	
	// END EXTERNAL INTERFACE CODE
	
	}// end class
}// end package