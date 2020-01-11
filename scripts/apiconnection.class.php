<?php

    class apiConnection{
        private $ch;
        public function apiRequest($url){

            try{
                $this->ch = curl_init();
                curl_setopt_array($this->ch, [CURLOPT_URL => $url , CURLOPT_RETURNTRANSFER => true]);

                $response = curl_exec($this->ch);
                curl_close($this->ch);

            }catch(Exception $e){
                return $e->getMessage();
            }
            return $response; 
        }
    }
?>