package com.thirstyEyes.utils
{
	
	public class MathHelp
	{
		public function MathHelp()
		{
			trace('MathHelp is a static class');
		}
		
		public static function randomRange(max:Number,min:Number=0,roundNumber:Boolean=true):Number
		{
			var randomNum:Number = Math.random() * ((max+1) - min) + min;
			if (roundNumber) return Math.floor(randomNum);
			return randomNum;
		}
		
	}// end class
	
}// end package