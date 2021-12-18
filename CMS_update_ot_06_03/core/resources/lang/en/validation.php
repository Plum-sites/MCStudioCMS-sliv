<?php

return [

    'accepted'             => ':attribute должен быть принят.',
    'active_url'           => ':attribute недействительный URL.',
    'after'                => ':attribute должен быть датой после :date.',
    'after_or_equal'       => ':attribute должен быть датой после или равен :date',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должен быть массивом.',
    'before'               => ':attribute должен быть датой до :date',
    'before_or_equal'      => ':attribute должен быть датой до или равен :date.',
    'between'              => [
        'numeric' => ':attribute должно быть между :min и :max',
        'file'    => ':attribute должно быть между :min и :max',
        'string'  => ':attribute должно быть между :min и :max',
        'array'   => ':attribute должно быть между :min и :max',
    ],
    'boolean'              => ':attribute должно быть истинным или ложным.',
    'confirmed'            => ':attribute подтверждение не совпадает.',
    'date'                 => ':attribute не является датой.',
    'date_format'          => ':attribute не соответствует формату :format.',
    'different'            => ':attribute и :other должены быть другими.',
    'digits'               => ':attribute должен быть :digits цифры.',
    'digits_between'       => ':attribute должен быть между :min и :max digits.',
    'dimensions'           => ':attribute недопустимые размеры изображения.',
    'distinct'             => ':attribute имеет повторяющееся значение.',
    'email'                => ':attribute e-mail должен быть верным.',
    'exists'               => ':attribute является неправильным.',
    'file'                 => ':attribute должен быть файлом.',
    'filled'               => ':attribute должно иметь значение.',
    'gt'                   => [
        'numeric' => ':attribute должно быть больше чем :value',
        'file'    => ':attribute должно быть больше чем :value',
        'string'  => ':attribute должно быть больше чем :value',
        'array'   => ':attribute должно иметь больше, чем :value',
    ],
    'gte'                  => [
        'numeric' => ':attribute должно быть больше или равно :value',
        'file'    => ':attribute должно быть больше или равно :value',
        'string'  => ':attribute должно быть больше или равно :value',
        'array'   => ':attribute должен иметь :value',
    ],
    'image'                => ':attribute должно быть изображением.',
    'in'                   => ':attribute является недействительным.',
    'in_array'             => ':attribute поле не существует в :other.',
    'integer'              => ':attribute должно быть целым числом.',
    'ip'                   => ':attribute должен быть верный IP-адрес.',
    'ipv4'                 => ':attribute должен быть верный IPv4-адрес.',
    'ipv6'                 => ':attribute должен быть верный IPv6-адрес.',
    'json'                 => ':attribute должен быть строкой JSON.',
    'lt'                   => [
        'numeric' => ':attribute должно быть меньше чем :value.',
        'file'    => ':attribute должно быть меньше чем :value',
        'string'  => ':attribute должно быть меньше чем :value',
        'array'   => ':attribute должно быть меньше чем :value',
    ],
    'lte'                  => [
        'numeric' => ':attribute должно быть меньше или равно :value',
        'file'    => ':attribute должно быть меньше или равно :value',
        'string'  => ':attribute должно быть меньше или равно :value',
        'array'   => ':attribute должно быть меньше или равно :value',
    ],
    'max'                  => [
        'numeric' => ':attribute не может быть больше чем :max',
        'file'    => ':attribute не может быть больше чем :max',
        'string'  => ':attribute не может быть больше чем :max',
        'array'   => ':attribute не может быть больше чем :max',
    ],
    'mimes'                => ':attribute должен быть файл типа: :values',
    'mimetypes'            => ':attribute должен быть файл типа: :values',
    'min'                  => [
        'numeric' => ':attribute должен быть не менее :min',
        'file'    => ':attribute должен быть не менее :min',
        'string'  => ':attribute должен быть не менее :min',
        'array'   => ':attribute должен быть не менее :min',
    ],
    'not_in'               => ':attribute недействительно.',
    'not_regex'            => ':attribute неверный формат.',
    'numeric'              => ':attribute должен быть числом.',
    'present'              => ':attribute должно присутствовать.',
    'regex'                => ':attribute неверный формат.',
    'required'             => ':attribute обязательно для заполнения.',
    'required_if'          => ':attribute обязательно :other - :value',
    'required_unless'      => ':attribute обязательно если :other - in :values.',
    'required_with'        => ':attribute обязательно когда :values - present.',
    'required_with_all'    => ':attribute обязательно когда :values - present.',
    'required_without'     => ':attribute обязательно когда :values - not present.',
    'required_without_all' => ':attribute обязательно когда один из :values присутствуют.',
    'same'                 => ':attribute и :other должены совпадать.',
    'size'                 => [
        'numeric' => ':attribute должно быть :size',
        'file'    => ':attribute должно быть :size',
        'string'  => ':attribute должно быть :size',
        'array'   => ':attribute должен содержать :size',
    ],
    'string'               => ':attribute должен быть строкой.',
    'timezone'             => ':attribute должен быть зоной.',
    'unique'               => ':attribute уже используется.',
    'uploaded'             => ':attribute не удалось загрузить.',
    'url'                  => ':attribute неверный формат.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
