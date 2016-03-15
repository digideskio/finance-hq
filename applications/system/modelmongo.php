<?php

class ModelMongo{
    
    public static $db = false;
    
    // function __construct(){
    //     global $config;
    //     if( $this->db === false ){
            
    //         $mongo = new MongoClient($config['mongo_host'].':'.$config['mongo_port']);
    //         $mongo->$config['mongo_dbname'];

    //         $this->db = $mongo->users->findOne(array('username' => 'admin'));
    //         var_dump($this->db);
    //     }
        
    //     return $this->db;
    // }
    
    public static function getMongo(){
        global $config;
        
        $mongo = new MongoClient($config['mongo_host'].':'.$config['mongo_port']);
        self::$db = $mongo->$config['mongo_dbname'];
        
        return self::$db;
    }
    
}