<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una dirección URL válida.',
    'after'                => ':attribute debe ser una fecha posterior al :date.',
    'after_or_equal'       => ':attribute debe ser una fecha igual o posterior al :date.',
    'alpha'                => ':attribute sólo puede contener letras.',
    'alpha_dash'           => ':attribute sólo puede contener números, letras y el caracter «-».',
    'alpha_num'            => ':attribute sólo puede contener caracteres alfanuméricos.',
    'array'                => ':attribute debe ser una lista.',
    'before'               => ':attribute debe ser una fecha anterior al :date.',
    'before_or_equal'      => ':attribute debe ser una fecha anterior o igual al :date.',
    'between'              => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file'    => 'El tamaño de :attribute debe estar entre :min y :max Kilybytes.',
        'string'  => ':attribute debe tener una longitud entre :min y :max.',
        'array'   => ':attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => ':attribute debe ser verdadero o falso.',
    'confirmed'            => 'Los campos de :attribute no coinciden.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_format'          => ':attribute no está en el formato requerido «:format».',
    'different'            => ':attribute y :other deben ser distintos.',
    'digits'               => ':attribute debe tener :digits cifras.',
    'digits_between'       => ':attribute debe tener entre :min y :max cifras.',
    'dimensions'           => 'Las dimensiones de :attribute no son válidas.',
    'distinct'             => 'El valor de :attribute ya existe.',
    'email'                => ':attribute debe ser una dirección de correo-e válida.',
    'exists'               => 'El valor seleccionado para :attribute no es válido.',
    'file'                 => ':attribute debe ser un archivo.',
    'filled'               => ':attribute es un campo obligatorio.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => 'El valor especificado para :attribute no es válido.',
    'in_array'             => 'El valor de :attribute no se encuentra en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'json'                 => ':attribute debe ser una cadena JSON válida.',
    'max'                  => [
        'numeric' => ':attribute no puede ser mayor de :max.',
        'file'    => 'El tamaño de :attribute no puede exceder los :max Kilobytes.',
        'string'  => ':attribute no puede una longitud mayor de :max caracteres.',
        'array'   => ':attribute no puede contener más de :max elementos.',
    ],
    'mimes'                => ':attribute debe ser un tipo de contenido MIME válido: :values.',
    'mimetypes'            => ':attribute debe ser un tipo de contenido MIME: :values.',
    'min'                  => [
        'numeric' => ':attribute debe ser al menos :min.',
        'file'    => 'El tamaño de :attribute debe ser al menos de :min Kilobytes.',
        'string'  => ':attribute debe tener una longitud mayor de :min caracteres.',
        'array'   => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => 'El valor especificado para :attribute no es válido.',
    'numeric'              => ':attribute debe ser un número.',
    'present'              => ':attribute debe ser especificado.',
    'regex'                => ':attribute debe ser una expresión regular válida.',
    'required'             => ':attribute es un campo requerido.',
    'required_if'          => 'Se requiere un valor para :attribute cuando :other es :value.',
    'required_unless'      => 'Se requiere un valor para :attribute a menos que :other sea uno de :values.',
    'required_with'        => 'Se requiere un valor para :attribute cuando se especifica alguno de :values.',
    'required_with_all'    => 'Se requiere un valor para :attribute cuando se especifica los campos :values.',
    'required_without'     => 'Se requiere un valor para :attribute cuando no se especifica los campos :values.',
    'required_without_all' => 'Se requiere un valor para :attribute cuando no se especifica ninguno de los campos :values.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => ':attribute debe ser :size.',
        'file'    => 'El tamaño de :attribute debe ser de :size Kilobytes exactamente.',
        'string'  => ':attribute debe tener una longitud de :size caracteres.',
        'array'   => ':attribute debe contener :size elementos.',
    ],
    'string'               => ':attribute debe ser una cadena.',
    'timezone'             => ':attribute debe ser una zona horaria válida.',
    'unique'               => ':attribute ya existe.',
    'uploaded'             => 'El proceso de carga de :attribute ha fallado.',
    'url'                  => ':attribute no es una dirección URL válida.',

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
