<?php
    class GetUser {

        // we have two properties here. One for the library and one for the data
	    private $library; //faker
        private $info;	  //data generated for a user	
    
        // this is the contructor 
        function __construct($users) 
		{
            $this->info = array();
            $this->library = Faker\Factory::create();
            $this->setInfo($users, $this->library);
        }

		//this is the getter
        public function setInfo($users, $library) 
		{
            for ($i = 0; $i < $users; $i++) 
			{
                $data = '';
                $data .= $library->firstName . ' ' . $library->lastName . '<br />';
                $data .= $library->email . '<br />';
                $data .= $library->phoneNumber . '<br />';
                $data .= $library->city . ', ' . $library->state . '<br />'.'<br />';
                $this->info[] = $data;
            }
        }
		
		//this is the setter
        public function getInfo() {
            return $this->info;
        }
    }
?>	
	