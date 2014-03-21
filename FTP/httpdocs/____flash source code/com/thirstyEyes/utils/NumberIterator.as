package com.thirstyEyes.utils
{
	public class NumberIterator
	{
		
		
		private var min:int;
		private var max:int;
		private var _iterator:int;
		public function NumberIterator(minimum:int,maximum:int):void
		{
			min = minimum;
			max = maximum;
		}
		
		
		public function get iterator():int
		{
			return _iterator;
		}
		
		public function set iterator(num:int):void
		{
			_iterator = num;
			if (_iterator > max || _iterator < min) trace('Error - iterator out of bounds : ' + '\n' + ' min :' + min + ' max : ' + max); 
		}
		
		public function getNext():int
		{
			return tempIncrease();
		}
		
		public function getPrevious():int
		{
			return tempDecrease();
		}
		
		public function getCurrent():int
		{
			return _iterator;	
		}
		

		
		private function tempIncrease():int
		{
			var tempIter:int = _iterator;
			tempIter++
			if (tempIter > max)
			{
				tempIter = min;
			}
			//trace('iterator increase ' + tempIter);
			return tempIter;
			
		}
		
		private function tempDecrease():int
		{
			var tempIter:int = _iterator;
			tempIter--
			if (tempIter < min)
			{
				tempIter = max;
			}
			return tempIter;
		}
		
		
		public function increase():int
		{
		
			return _iterator = tempIncrease();
			
		}
		public function decrease():int
		{
			return _iterator = tempDecrease();
		}
		
		public function set minimum(min:int):void
		{
			this.min = min;
		}
		
		public function get minimum():int
		{
			return this.min;
		}
		
		
		public function set maximum(max:int):void
		{
			this.max = max;
		}
		
		public function get maximum():int
		{
			return this.max;
		}

		
	}// end class	
}// end package