<?php

class Union
{
    const NEXT = "next";
    const PREVIOUS = "previous";

    protected $activities = [];

    /**
     * Union constructor.
     */
    public function __construct()
    {
        $methods = get_class_methods($this);
        $this->activities = array_filter($methods, function ($item) {
            return !in_array($item, [
                    "__construct", "start", "go", "next", "previous", "break", "comesFrom",
                ]) ?? $item;
        });
    }

    /**
     * start the process
     * @return bool
     */
    public function start(): bool
    {
        if (empty($this->activities)) {
            print_r("the activities variable is empty");
            return false;
        }

        $method = $this->activities[0];
        $this->$method();
        return true;
    }

    /**
     * go to previous or next method
     * @param $whereto
     * @param int $level
     */
    protected function go($whereto, $level = 1): void
    {
        $trace = debug_backtrace();
        $current_method = $trace[1]['function'];
        if ($current_method == self::NEXT || $current_method == self::PREVIOUS) {
            $current_method = $trace[2]['function'];
        }

        $key = array_search($current_method, $this->activities);
        if ($whereto == self::NEXT) {
            $key += $level;
        } else if ($whereto == self::PREVIOUS) {
            $key -= $level;
        }

        if (array_key_exists($key, $this->activities)) {
            $method = $this->activities[$key];
            if (!empty($method)){
                $this->$method();
                exit();
            }
        }
    }

    /**
     * go to next method
     * @param int $level
     */
    protected function next($level = 1): void
    {
        $this->go('next', $level);
    }

    /**
     * go to previous method
     * @param int $level
     */
    protected function previous($level = 1): void
    {
        $this->go('previous', $level);
    }

    /**
     * break process and end
     */
    protected function break(): void
    {
        exit();
    }

    /**
     * you can know what is previous method
     * @param $method
     * @return string
     */
    protected function comesFrom($method): string
    {
        $trace = debug_backtrace();
        $current_method = $trace[3]['function'];
        if ($current_method == self::NEXT || $current_method == self::PREVIOUS) {
            $current_method = $trace[4]['function'];
        }
        return $current_method == $method;
    }
}
