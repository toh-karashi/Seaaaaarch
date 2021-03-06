<?php
namespace Search\Filter;

use Illuminate\Database\Eloquent\Builder;

class Callback extends Filter implements FilterInterface {
    protected $defaultOptions = [
        'field' => '',
        'method' => ''
    ];

    public function process(Builder $builder, $field, $value)
    {
        $method = $this->options['method'];

        if (is_callable($method)) {
            $method($builder, $field, $value);
        } elseif (is_array($method)) {
            call_user_func_array($method, [$builder, $field, $value]);
        }
    }
}
