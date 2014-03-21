package com.thirstyEyes.video 
{
	import mu.utils.FlashVarsDynamic;
	
	/**
	 * ...
	 * @author Ivan Vlatkovic
	 */
	public class FlashVars extends FlashVarsDynamic 
	{

		public var xmlPath:String = 'video_playlist.xml';
		public var id:String = '-1';
		public function FlashVars(loaderInfo:Object) 
		{
			super(loaderInfo);
		}
		
	}

}