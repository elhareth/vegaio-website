<?php

namespace App\Support\Traits;

trait Conditionable
{
    /**
     * Run a callable on condition
     *
     * @param  mixed    $condition
     * @param  callable $callable
     * @return static
     */
    public function when($condition, $callable)
    {
        if ($condition) {
            $callable($this, $condition);
        }

        return $this;
    }

    /**
     * Run a callable on condition failur
     *
     * @param  mixed    $condition
     * @param  callable $callable
     * @return static
     */
    public function unless($condition, $callable)
    {
        return $this->when(!$condition, $callable);
    }
}
