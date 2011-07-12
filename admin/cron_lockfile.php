<?php

/**
 *
 * Class that performs effective OS portable script lock
 * Ideal for locking scripts executed from command line
 * @author Darko Miletic <darko.miletic@totaralms.com>
 *
 */
class cron_lockfile {
    /**
     *
     * Enter description here ...
     * @var resource
     */
    private $handle = null;

    /**
     *
     * Class CTOR - specify file to lock
     *
     * @param string $filename - lock filename
     */
    public function __construct($filename) {
        $handle = fopen($filename, 'r');
        if ($handle !== false) {
            $result = flock($handle, LOCK_EX | LOCK_NB);
            if ($result) {
                $this->handle = $handle;
            } else {
                fclose($handle);
            }
        }
    }

    public function __destruct(){
        if ($this->handle !== null) {
            flock($this->handle, LOCK_UN | LOCK_NB);
            fclose($this->handle);
            $this->handle = null;
        }
    }

    /**
     *
     * Helper that checks whether the file was
     * locked by us or not
     * @return bool
     */
    public function locked() {
        return ($this->handle !== null);
    }
}
