<?php
// app/Services/ZKTecoService.php

namespace App\Services;

use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoService
{
    protected $zk;
    protected $ip;
    protected $port;

    public function __construct($ip, $port)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->zk = new ZKTeco($this->ip, $this->port);
    }

    public function connect()
    {
        return $this->zk->connect();
    }

    public function disconnect()
    {
        return $this->zk->disconnect();
    }

    public function getAttendance()
    {
        if (!$this->connect()) {
            return ['status' => false, 'message' => 'Connection failed'];
        }

        $attendance = $this->zk->getAttendance(); 
        $this->disconnect();

        return ['status' => true, 'data' => $attendance];
    }


    public function deviceName()
    {
        if (!$this->connect()) {
            return ['status' => false, 'message' => 'Connection failed'];
        }

        $attendance = $this->zk->deviceName();
        $this->disconnect();

        return ['status' => true, 'data' => $attendance];
    }

    public function getTime()
    {
        if (!$this->connect()) {
            return ['status' => false, 'message' => 'Connection failed'];
        }

        $time = $this->zk->getTime();
        $this->disconnect();

        return ['status' => true, 'data' => $time];
    }

    public function clearAttendance()
    {
        if (!$this->connect()) {
            return ['status' => false, 'message' => 'Connection failed'];
        }

        $this->zk->clearAttendance();
        $this->disconnect();

        return ['status' => true, 'message' => 'Attendance logs cleared'];
    }

    public function syncUser()
    {
        if (!$this->connect()) {
            return ['status' => false, 'message' => 'Connection failed'];
        }

        $userList = $this->zk->getUser(); 
        $this->disconnect();

        return ['status' => true, 'data' => $userList];
    }
}
