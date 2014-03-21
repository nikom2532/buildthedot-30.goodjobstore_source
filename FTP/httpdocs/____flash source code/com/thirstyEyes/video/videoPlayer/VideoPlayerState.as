package com.thirstyEyes.video.videoPlayer 
{
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class VideoPlayerState
	{
		public static const STOPPED:String = 'stopped';
		public static const PAUSED:String = 'paused';
		public static const PLAYING:String = 'playing';
		public static const BUFFERING:String = 'buffering';// da li ovo ikada bude aktivirano?
		public static const BUFFER_FULL:String = 'bufferFull';
	}
}