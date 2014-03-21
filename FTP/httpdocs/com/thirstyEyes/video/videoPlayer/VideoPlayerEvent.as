package com.thirstyEyes.video.videoPlayer 
{
	import flash.events.Event;
	
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class VideoPlayerEvent extends Event
	{
		public static const STATE_CHANGE:String = 'state_change';
		public static const NET_STATUS:String = 'net_status';
		public static const META_DATA:String = 'meta_data';
		public static const TEXT_DATA:String = 'text_data';
		public static const IMAGE_DATA:String = 'image_data';
		public static const XMP_DATA:String = 'image_data';
		
		public static const CUE_POINT:String = 'cue_point';
		public static const VOLUME_CHANGE:String = 'volume_change';
		public static const VIDEO_PROGRESS:String = 'video_progress';
		public static const DISPLAY_STATE_CHANGE:String = 'display_state_change';
		
		public var cuePoint:Object;
		public var metaData:Object;
		public var textData:Object;
		public var imageData:Object;
		public var XMPData:Object;
		
		public var volume:Number;
		public var muted:Boolean;
		
		public function VideoPlayerEvent(type:String, bubbles:Boolean = false, cancelable:Boolean = false,cuePoint:Object=null,metaData:Object=null,volume:Number=NaN,muted:Boolean=false,XMPData:Object=null,imageData:Object=null,textData:Object=null) 
		{
			super(type, bubbles, cancelable);
			
			this.cuePoint = cuePoint;
			this.metaData = metaData;
			this.volume = volume;
			this.muted = muted;
			this.imageData = imageData;
			this.XMPData = XMPData;
			this.textData = textData;
		}
		
		
		public override function clone():Event
		{
			return new VideoPlayerEvent(type, bubbles, cancelable,cuePoint,metaData,volume,muted,XMPData,imageData,textData);
		}
		
		public override function toString():String
		{
			return formatToString('VideoPlayerEvent', 'type', 'bubbles', 'cancelable', 'eventPhase','cuePoint','metaData','volume','muted','XMPData','imageData','textData');
		}
	}

}