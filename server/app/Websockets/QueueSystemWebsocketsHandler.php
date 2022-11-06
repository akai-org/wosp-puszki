<?php

namespace App\Websockets;
use BeyondCode\LaravelWebSockets\Apps\App;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class QueueSystemWebsocketsHandler implements MessageComponentInterface
{

    const STATUS_UNKNOWN = 0;
    const STATUS_READY = 1;
    const STATUS_BUSY = 2;
    const STALE_TIMEOUT_IN_SECONDS = 300;

    protected $clients;
    private $stations = [];

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->stations = [
            'wosp01' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp02' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp03' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp04' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp05' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp06' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp07' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp08' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp09' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp10' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp11' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp12' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp13' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp14' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp15' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp16' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp17' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp18' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp19' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp20' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp21' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp22' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp23' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp24' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
            'wosp25' => [
                'st' => self::STATUS_UNKNOWN,
                't' => 0
            ],
        ];
    }

    public function onOpen(ConnectionInterface $connection)
    {
        // Store the new connection to send messages to later
        $socketId = sprintf('%d.%d', random_int(1, 1000000000), random_int(1, 1000000000));
        $connection->socketId = $socketId;
        $connection->app = App::findById('wosppuszkiid');
        $this->clients->attach($connection);
    }

    public function onClose(ConnectionInterface $connection)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($connection);
        $connection->close();

        echo "Connection {$connection->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()} {$e->getFile()}:{$e->getLine()}\n";
        $this->clients->detach($connection);
        $connection->close();
    }

    public function onMessage(ConnectionInterface $from, MessageInterface $msg)
    {
        $message = json_decode($msg, true);
        //s is the status, st is station, t is current timestamp
        $numRecv = count($this->clients) - 1;

        switch ($message['s']){
            case 'READY':
                $this->markStationReady($message['st'], $message['t']);
                $from->send('Got it! Ready!');
                break;
            case 'BUSY':
                $this->markStationBusy($message['st'], $message['t']);
                $from->send('Got it! Busy!');
                break;
            case 'STATUS':
                //Set unknown status for stale stations (no info for the last STALE_TIMEOUT_IN_SECONDS)
                $this->purgeStaleStations();
                //Return the list of stations
                $from->send($this->getStations());
                break;
            default:
                break;
        }
    }

    private function purgeStaleStations() {
        $now = time();
        foreach ($this->stations as $station => $properties) {
            //Only ready or busy stations can become stale
            if($properties['st'] === self::STATUS_READY
                || $properties['st'] === self::STATUS_BUSY) {
                if($now - (int)$properties['t'] > self::STALE_TIMEOUT_IN_SECONDS) {
                    $this->markStationUnknown($station, $now);
                }
            }
        }
    }

    private function markStationReady($station, $timestamp) {
        $this->stations[$station]['st'] = self::STATUS_READY;
        $this->stations[$station]['t'] = $timestamp;
    }

    private function markStationBusy($station, $timestamp) {
        $this->stations[$station]['st'] = self::STATUS_BUSY;
        $this->stations[$station]['t'] = $timestamp;
    }

    private function markStationUnknown($station, $timestamp) {
        $this->stations[$station]['st'] = self::STATUS_UNKNOWN;
        $this->stations[$station]['t'] = $timestamp;
    }

    private function getStations() {
        return json_encode($this->stations);
    }

}
