<?php
/**
 * RouterOS API class by Ben Menking (https://github.com/BenMenking/RouterOS)
 */
class RouterosAPI {
    var $debug = false;
    var $port = 8728;
    var $timeout = 3;
    var $attempts = 5;
    var $delay = 3;
    var $socket;
    var $connected = false;
    var $error_no;
    var $error_str;

    function debug($text) {
        if ($this->debug) {
            echo $text . "\n";
        }
    }

    function connect($ip, $login, $password) {
        $this->connected = false;

        for ($i = 1; $i <= $this->attempts; $i++) {
            $this->debug("Connection attempt $i of {$this->attempts}...");
            $this->socket = @fsockopen($ip, $this->port, $this->error_no, $this->error_str, $this->timeout);
            if ($this->socket) break;
            sleep($this->delay);
        }

        if (!$this->socket) {
            $this->debug("Connection failed.");
            return false;
        }

        stream_set_timeout($this->socket, $this->timeout);
        $this->write('/login', false);
        $this->write('=name=' . $login, false);
        $this->write('=password=' . $password);
        $response = $this->read();

        foreach ($response as $line) {
            if (isset($line['!trap'])) return false;
        }

        $this->connected = true;
        return true;
    }

    function disconnect() {
        fclose($this->socket);
        $this->connected = false;
    }

    function write($command, $param = true) {
        $command = trim($command);
        if ($command == '') return false;

        $length = strlen($command);
        fwrite($this->socket, chr($length) . $command);
        if ($param) fwrite($this->socket, chr(0));
    }

    function read() {
        $response = [];
        while (true) {
            $byte = ord(fgetc($this->socket));
            if ($byte == 0) break;
            $length = $byte;
            $response[] = fread($this->socket, $length);
        }
        return $response;
    }
}
?>