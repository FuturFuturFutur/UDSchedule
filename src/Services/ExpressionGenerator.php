<?php


namespace Futur\UDSchedule\Services;


class ExpressionGenerator
{
    private $templates = [
        'monthly' => [
            'value' => true,
            'temp' => '0 12 %d * *',
            'value_validation' => '1-31',
        ],
        'weekly' => [
            'value' => true,
            'temp' => '0 12 * * %d',
            'value_validation' => '0-6',
        ],
    ];

    public function generate($type, $value) : string
    {
        if($this->templates[$type]['value']) {
            $rules = explode('-', $this->templates[$type]['value_validation']);
            throw_if($value < $rules[0] || $value > $rules[1], new \Exception('Wrong value range'));
        }

        return
            $this->templates[$type]['value']
                ? sprintf($this->templates[$type]['temp'], $value)
                : $this->templates[$type]['temp'];
    }
}
