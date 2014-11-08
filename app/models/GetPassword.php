<?php
    class GetPassword 
	{
		 //this field keeps the password generated
         private $password;	  	
    
		
        // this is the contructor 
        function __construct($number) 
		{
            $this->password = array();
			$this->setPassword($number);
        }

		//this is the setter
        public function setPassword($number) 
		{
			$words = array ('time','person','year','way','day','thing','man','world','life','hand','part','child','eye','woman','place','work','week','case','point','government','company',
							 'number','group','problem','fact','be','have','do','say','get','make','go','know','good','first','last','long','great','little','own','other');	
							 
		    for($j = 0; $j < $number; $j++) 
			{  
				$data = "";
				$data = $data.$words[rand (0, count($words) - 1)]." - ";	
				$this->password[] = $data;
			}
		}
		
		//this is the getter
        public function getPassword() 
		{
            return $this->password;
        }
		
		
	}
	
?>	