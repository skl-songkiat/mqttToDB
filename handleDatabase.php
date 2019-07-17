<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of handleDatabase
 *
 * @author songkiat lowmunkhong
 * https://web.facebook.com/SKLSongkiatDev/
 * https://www.sklsongkiat.com/home/
 * 
 * ref: https://mosquitto-php.readthedocs.io/en/latest/
 */
class handleDatabase {
    //put your code here
    
    public $servername = "localhost";
    public $database = "mqttToDB";
    public $username = "sklsongkiat";
    public $password = "12345678";
    
    public $conn;
    public $stmt;
    public $topic;
    public $payload;

    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    }
    
    public function setTopicDB($topic){
        $this->topic = $topic;
    }
    
    public function setPayloadDB($payload){
        $this->payload = $payload;
    }
    
    public function insert(){
        // prepare and bind
        
        $topic = $this->topic;
        $payload = $this->payload;
        $sql = "INSERT INTO `subscribe` (`topic`, `payload`) VALUES ('$topic', '$payload')";
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }

    }
    
    public function closeDB(){
        $this->conn->close();
    }

}
