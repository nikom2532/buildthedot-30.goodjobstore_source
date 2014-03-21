package com.thirstyEyes.video
{
	import com.thirstyEyes.utils.NumberIterator;
	import com.thirstyEyes.utils.StringToBoolean;
	import com.thirstyEyes.utils.MathHelp;
	import com.thirstyEyes.video.LocalVO;
	import com.thirstyEyes.Align;
	import com.thirstyEyes.video.videoPlayer.VideoDisplay;
	import com.thirstyEyes.video.videoPlayer.VideoPlayerEvent;
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.NetStatusEvent;
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
	
	public class LocalVideo extends MovieClip
	{
		private var _showBars:Boolean;
		private var _progressColor:Number;
		private var _loadColor:Number;
		private var _showBuffer:Boolean=true;
		private var _showFullBtn:Boolean=true;
		public var iterator:NumberIterator; // number that is used to go through the videos
		//public var folderPath:String; // folder path to the videos
		public var videoURL:String; // url for the video
		public var xmlLoader:URLLoader; // loader for xml
		public var random:Boolean; // if random video is going to be used (checks the xml)
		public var maxVideos:int; // how many videos there is 
		public var smoothVideo:Boolean = true; // should the video be smoothed
		
		public var pattern:Pattern; // holder for the pattern
		public var scanLinePattern:BitmapData; // holder for the bitmap
		public var defaultSoundVolume:int = 1; // sound for the videos
		
		public var bufferTime:int = 7; // buffer time for the videos, how many seconds of the video need to be downloaded before the video plays.

		public var paused:Boolean = false; // toggle value for pausing the video
		public var mute:Boolean = false; // toggle value for muting the video.
		
		public var progressBarScale:Number;
		public var loadBarScale:Number;
		public var loadScaleCheck:Number;
		
		public var duration:Number;
		
		public var videoStretch:String;
				
		public var videoBackground:VideoDisplay;
	
		public var showProgressBar:Boolean;
		
		
		//public var videoBackground:Video;
		
		
		public var progressBar:MovieClip;
		public var loadBar:MovieClip;
		public var buffer_mc:MovieClip;
		
		public var vo:LocalVO ; 
		public var scanLinesHolder_mc:Sprite;
		
		//when the video starts playing this will toggle if the metadata has been receive for the first time for that video.
        public var firstMetaData:Boolean = true;
		
		public function LocalVideo(VO:LocalVO):void
		{

			vo = VO; // object that holds the values for initialization.
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

			
			stage.addEventListener(Event.RESIZE, stageResize);

			
			videoBackground = new VideoDisplay();
			addChild(videoBackground);
			videoBackground.videoHolder.width = stage.stageWidth;
			videoBackground.videoHolder.height = stage.stageHeight;
			
			videoBackground.signal.netStatus.add(netStatusListener);
			videoBackground.signal.metaData.add(onMetaData);	
			// set the initial volume.
			if (mute)
			{
				//setVolume(0);
				videoBackground.setVolume(0);

			}
			else
			{
				videoBackground.setVolume(defaultSoundVolume);
			}
			
			
			//should the video be smoothed
			videoBackground.smoothing = vo.smoothVideo;
			
			// set the size of the video object.
			//setBgSize(videoBackground);
		
			// create the pattern object.
			pattern = new Pattern();
			
			scanLinesHolder_mc = new Sprite();
			scanLinesHolder_mc.addChild(pattern);

			addChild(scanLinesHolder_mc);
			
			initPattern();

			
			
			// ig the progress bars should be displayed.
			if (vo.showBars)
			{
				// initialize load and progress bars.
				loadBar = new MovieClip();
				addChild(loadBar);
				
				progressBar = new MovieClip();
				addChild(progressBar);
				
				progressBar.graphics.beginFill(vo.progressColor)
				progressBar.graphics.drawRect(0, y, stage.stageWidth, 4);
				progressBar.graphics.endFill();
				
				loadBar.graphics.beginFill(vo.loadColor);
				loadBar.graphics.drawRect(0, y, stage.stageWidth, 4);
				loadBar.graphics.endFill();

				
				progressBar.width = stage.stageWidth;
				progressBarScale = progressBar.scaleX;
			
				loadBar.width = stage.stageWidth;
				loadBarScale = loadBar.scaleX;
				loadScaleCheck = loadBar.scaleX;// zasto imam ovu varijablu?
				videoBackground.signal.videoProgress.add(onVideoProgress);

			}
			

		
			// if the buffer movieclip should be shown
			if (vo.showBuffer)
			{
				buffer_mc = new BufferIndicator();
				addChild(buffer_mc);
			}

			positionElements();
	
			
		}// end init
		
		private function onMetaData($e:IEvent, o:Object):void 
		{
			if (firstMetaData)
			{
				try
				{
				
					videoBackground.videoHolder.width = o.width;
					videoBackground.videoHolder.height = o.height;
					setBgSize(videoBackground);
					firstMetaData = false;


				}
				catch ($e:Error)
				{
				
				}	
			}


		}
		

		
		public function positionElements():void
		{
			// align elements on stage
			if (vo.showBars)
			{
				//trace('aligning  progress bars ');
				Align.bottomLeft(progressBar);
				Align.bottomLeft(loadBar);
			}
	
			if (vo.showBuffer)// if there is buffer
			{
				buffer_mc.x = 0;
				buffer_mc.y = stage.stageHeight - buffer_mc.height;
			}
		}
		
	
		// dispatched while the video is playing.
		private function onVideoProgress($e:IEvent):void 
		{
			if (progressBar == null) return;
			progressBar.scaleX = ((videoBackground.getTime() / videoBackground.getDuration()) * progressBarScale);
			if (loadBar.scaleX == loadScaleCheck) return;
			loadBar.scaleX = (videoBackground.getBytesLoaded()/ videoBackground.getBytesTotal()) * loadBarScale;
			
		}
		
		
		
		// this method plays the movie
		// url to the movie neeeds to be passed (folder path is auto added inside the method).
		public function playMovie(movieURL:String):void
		{

			videoBackground.play(movieURL);
		}
		
		/* This method is fired everytime there is a change in streaming the video.
		 * (paused , started ,stopped, buffer empty , buffer full etc...)
		 * */
		
		public function netStatusListener(e:NetStatusEvent):void
		{
			if (e.info.code == "NetStream.Play.Start") // check to see if the playback has started.
			{
				if(vo.showBuffer)
				buffer_mc.visible = true;
			}
	
			if (e.info.code == "NetStream.Play.Stop") // fired when playback has stopped.
			{ // playback has stopped.
				firstMetaData = true;
	
			}

			if (e.info.code == 'NetStream.Play.StreamNotFound') // if the video that we want to play doesn't exists (maybe wron url);
			{
				trace('ERROR  stream not found!!!!');
			}
	
			// if the buffer is empty. show the buffering mc.
			if ( e.info.code == 'NetStream.Buffer.Empty')
			{
				if(vo.showBuffer)
				buffer_mc.visible = true;
				
			}
			if (e.info.code == 'NetStream.Buffer.Full') // buffer is full and the video is about to start.
			{
				if(vo.showBuffer)
				buffer_mc.visible = false;
				
			}
				
			if (e.info.code == 'NetStream.Buffer.Flush') // video is about to end, and the buffer is flushed.
			{
				buffer_mc.visible = false;
				
			}
			
		}
		

		// fired everytime the stage is resized.
		public function stageResize(e:Event):void
		{
			
				
			setBgSize(videoBackground);
			positionElements();

			if (progressBar == null) return;
			progressBar.width = stage.stageWidth;
			loadBar.width = stage.stageWidth;
			
			loadScaleCheck = loadBar.scaleX;
			loadBarScale= loadBar.scaleX;
			progressBarScale = progressBar.scaleX;
			
		}
		
		
	//FUNCITON TO SCALE ANY MOVIE CLIP TO FIT THE WHOLE SCREEN
	// scales the mc proportionally to fit full screen 
	private function setBgSize(mc:DisplayObject):void 
	{               
		var imageRatio:Number = mc.width / mc.height;
		//trace("imageRatio : " + imageRatio);
		var stageRatio:Number = stage.stageWidth / stage.stageHeight;
		//trace("stageRatio : " + stageRatio);
		
		if (vo.videoStretch== 'fill')
		{
			if (stageRatio>=imageRatio) {
				// match image width and adjust height to fit
				mc.width = stage.stageWidth;
				mc.height = stage.stageWidth / imageRatio;
			}
			else
			{
				 //match image height and adjust width to fit
				mc.height = stage.stageHeight;
				mc.width = stage.stageHeight * imageRatio;
			}
		}
		else
		{
		
			if (stageRatio>=imageRatio) {
				// match image width and adjust height to fit
				//trace(" stageRatio > match image width and adjust height to fit");
				mc.height = stage.stageHeight;
				mc.width = stage.stageHeight * imageRatio;
			}
			else
			{
				// match image height and adjust width to fit
				//trace(" imageRatio  > match image height and adjust width to fit - ELSE ");
				mc.height = stage.stageWidth / imageRatio;
				mc.width = stage.stageWidth;
			}		
		
		}
		positionVideoPlayerObject(stage.stageWidth, stage.stageHeight);

	}
	
	// positions the video object after it has been resized.
	private function positionVideoPlayerObject(availableW:Number,availableH:Number):void
	{
		videoBackground.x =(availableW-videoBackground.width)/2;
		videoBackground.y = (availableH - videoBackground.height) / 2;
	}
	
	// color transform properties 
	public function changeBarColors($target:MovieClip, red:Number,green:Number,blue:Number):void
	{
		var testClipTransform:ColorTransform = new ColorTransform(0, 0, 0, 1, red, green, blue);
			$target.transform.colorTransform = testClipTransform; 

		
	}

	private function initPattern():void
	{
		 //LOADING THE PATTERN 
		var patternNum:String = vo.pattern;

		if (patternNum == 'none') return;
		// there are other patterns in the library, from Pattern_1  to Pattern_9;
		// check out the "pattern bitmaps" folder and look for the linkage value for every bitmap.		
		var patternClass:Object = getDefinitionByName("Pattern_" + patternNum);
		pattern.loadPattern(new patternClass(0, 0));
	}
		

	}// end class
}// end package