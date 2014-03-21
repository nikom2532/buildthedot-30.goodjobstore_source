package com.thirstyEyes.utils
{
	
	public class StringToBoolean
	{
		
		
		public function StringToBoolean():void
		{

		}
		
		
		
		public static function convert(text:String):Boolean
		{
			if (text.toLowerCase() == 'true')
			{
				return true;
			}
		
			else
			{
				return false;
			}	
		}
		
	}
	
}