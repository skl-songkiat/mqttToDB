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
require_once 'mqtt.php';
require_once 'handleDatabase.php';
use Mosquitto\Client;

$topic = "test/bulb1";
$host = "localhost";
$qos = 1;

$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');
$client->connect($host, 1883, 60);

$client->subscribe($topic, $qos);

while (true) {
    $client->loop();
}

$client->unsubscribe($topic);

function connect($r, $message) {
	echo "I got code {$r} and message {$message}\n";
}

function subscribe() {
	echo "Subscribed to a topic\n";
}

function unsubscribe() {
	echo "Unsubscribed from a topic\n";
}

function message($message) {
        
    $sql = new handleDatabase();
    $sql->setPayloadDB($message->payload);
    $sql->setTopicDB($message->topic);
    $sql->insert();
    $sql->closeDB();
    
    printf("Got a message on topic %s with payload:\n%s\n", $message->topic, $message->payload);
}

function disconnect(){
	echo "Disconnected cleanly\n";
}
