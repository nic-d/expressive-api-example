<?php

declare(strict_types=1);

namespace User\Filter;

use Zend\Filter;
use Zend\Validator;
use Zend\InputFilter\InputFilter;

/**
 * Class UserFilter
 * @package User\Filter
 */
class UserFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'email',
            'required' => true,

            'filters' => [
                ['name' => Filter\StringTrim::class],
                ['name' => Filter\StripNewlines::class],
                ['name' => Filter\StripTags::class],
            ],

            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => [
                        'min' => 3,
                        'max' => 250,
                    ],
                ],
                [
                    'name'    => Validator\EmailAddress::class,
                    'options' => [],
                ],
                [
                    'name'    => Validator\NotEmpty::class,
                    'options' => [],
                ],
            ],
        ]);

        $this->add([
            'name' => 'password',
            'required' => true,

            'filters' => [
                ['name' => Filter\StripNewlines::class],
                ['name' => Filter\StripTags::class],
            ],

            'validators' => [
                [
                    'name'    => Validator\StringLength::class,
                    'options' => [
                        'min' => 3,
                        'max' => 250,
                    ],
                ],
                [
                    'name'    => Validator\NotEmpty::class,
                    'options' => [],
                ],
            ],
        ]);
    }
}
