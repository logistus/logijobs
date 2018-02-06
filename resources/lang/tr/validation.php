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

    'accepted'             => ':attribute kabul edilmeli.',
    'active_url'           => ':attribute geçerli bir URL değil.',
    'after'                => ':attribute :date tarihinden sonraki bir tarih olmalı.',
    'after_or_equal'       => ':attribute :date tarihine eşit veya ondan sonraki bir tarih olmalı.',
    'alpha'                => ':attribute sadece harf içerebilir.',
    'alpha_dash'           => ':attribute sadece harf, rakam ve çizgi içerebilir.',
    'alpha_num'            => ':attribute sadece harf ve rakam içerebilir.',
    'array'                => ':attribute bir dizi olmalıd.',
    'before'               => ':attribute :date tarihinden önceki bir tarih olmalı.',
    'before_or_equal'      => ':attribute :date tarihine eşit veya ondan önceki bir bir tarih olmalı.',
    'between'              => [
        'numeric' => ':attribute :min ve :max değerleri arasında olmalıdır.',
        'file'    => ':attribute boyutu :min be :max KB arasında olmalıdır.',
        'string'  => ':attribute :min ve :max karakter arasında olmalıdır.',
        'array'   => ':attribute :min ve :max arasında eleman içermelidir.',
    ],
    'boolean'              => ':attribute doğru veya yanlış değerleri olmalıdır.',
    'confirmed'            => ':attribute değeri uyuşmuyor.',
    'date'                 => ':attribute geçerli bir tarih değil.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => ':attribute zorunlu alan.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => ':attribute geçerli bir yazı değeri olmalı.',
    'timezone'             => ':attribute geçerli bir zaman formatı olmalı.',
    'unique'               => ':attribute zaten kullanımda.',
    'uploaded'             => ':attribute karşıya yüklenemedi.',
    'url'                  => ':attribute hatalı formatta.',

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
        'name' => [
            'required' => 'Ad Soyad boş bırakılamaz.',
        ],
        'email' => [
            'required' => 'Eposta boş bırakılamaz.',
            'email' => 'Geçerli bir eposta adresi yazınız.',
            'unique' => 'Bu eposta adresi kullanımda',
        ],
        'current_password' => [
            'required' => 'Lütfen geçerli parolanızı yazın.',
            'min' => 'Geçerli parolanız en az :min karakter olmalıdır.',
        ],
        'new_password' => [
            'required' => 'Lütfen yeni parolanızı yazın.',
            'min' => 'Yeni parolanız en az :min karakter olmalıdır.',
            'confirmed' => 'Yazdığınız yeni parolalar uyuşmuyor.'
        ]
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
