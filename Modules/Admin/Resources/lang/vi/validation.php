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

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'active_url' => 'Trường :attribute không phải là một URL hợp lệ.',
    'after' => 'Giá trị :attribute phải là ngày sau :date.',
    'after_or_equal' => 'Giá trị :attribute phải là ngày sau hoặc bằng :date.',
    'alpha' => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ có thể chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ có thể chứa các chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => 'Giá trị :attribute phải là một ngày trước :date.',
    'before_or_equal' => 'Giá trị :attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => 'Giá trị :attribute phải nằm giữa :min and :max.',
        'file' => ':attribute phải nằm trong khoảng :min and :max kilobytes.',
        'string' => 'Giá trị :attribute phải nằm giữa các ký tự :min and :max.',
        'array' => ':attribute phải có giữa các mục :min and :max items.',
    ],
    'boolean' => 'Trường :attribute phải true hoặc false.',
    'confirmed' => 'Giá trị :attribute xác nhận không khớp.',
    'date' => ':attribute không phải ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => 'Giá trị :attribute phải nằm giữa chữ số :min and :max .',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong các giá trị: :values.',
    'exists' => 'Giá trị đã chọn :attribute không hợp lệ.',
    'file' => 'Trường :attribute phải là một file.',
    'filled' => 'Trường :attribute phải có một giá trị.',
    'gt' => [
        'numeric' => 'Giá trị :attribute phải lớn hơn :value.',
        'file' => 'File :attribute phải lớn hơn :value kilobytes.',
        'string' => 'Giá trị :attribute phải lớn :value .',
        'array' => ':attribute phải có nhiều hơn mục :value .',
    ],
    'gte' => [
        'numeric' => 'Giá trị :attribute phải lớn hơn hoặc bằng :value.',
        'file' => 'File :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => 'Giá trị :attribute phải lớn hơn hoặc bằng :value .',
        'array' => ':attribute phải có :value mục hoặc hơn nữa.',
    ],
    'image' => 'Trường :attribute phải là một ảnh.',
    'in' => 'Giá trị đã chọn :attribute không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => 'Giá trị :attribute phải là một số nguyên.',
    'ip' => 'Giá trị :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Giá trị :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Giá trị :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Giá trị :attribute phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => 'Giá trị :attribute phải nhỏ hơn :value.',
        'file' => 'File :attribute phải nhỏ hơn :value kilobytes.',
        'string' => 'Giá trị :attribute phải ít hơn :value ký tự.',
        'array' => ':attribute phải có ít hơn :value mục.',
    ],
    'lte' => [
        'numeric' => 'Giá trị :attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => 'File :attribute phải nhỉ hơn hoặc bằng :value kilobytes.',
        'string' => 'Giá trị :attribute phải nhỏ hơn hoặc bằng :value ký tự.',
        'array' => ':attribute không được có nhiều hơn :value mục.',
    ],
    'max' => [
        'numeric' => 'Giá trị :attribute không được lớn hơn :max.',
        'file' => 'File :attribute không được lớn hơn :max kilobytes.',
        'string' => 'Giá trị :attribute không được lớn hơn :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max mục.',
    ],
    'mimes' => 'File :attribute phải là một file của kiểu: :values.',
    'mimetypes' => 'File :attribute phải là một file của kiểu: :values.',
    'min' => [
        'numeric' => 'Giá trị :attribute tối thiểu phải là :min.',
        'file' => 'File :attribute phải có ít nhất :min kilobytes.',
        'string' => 'The :attribute phải có ít nhất :min characters.',
        'array' => 'The :attribute phải có ít nhất :min items.',
    ],
    'multiple_of' => 'Giá trị :attribute phải là bội số của :value',
    'not_in' => 'Giá trị :attribute đã chọn không hợp lệ.',
    'not_regex' => 'Giá trị :attribute không đúng định dạng.',
    'numeric' => 'Giá trị :attribute phải là một số.',
    'password' => 'Mật khẩu không chính xác.',
    'present' => 'Trường :attribute phải có.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other là trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi có :values .',
    'required_with_all' => 'Trường :attribute là bắt buộc khi có :values .',
    'required_without' => 'Trường :attribute là bắt buộc khi không có :values .',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có giá trị nào trong :values .',
    'same' => 'Giá trị :attribute và :other phải khớp.',
    'size' => [
        'numeric' => 'Giá trị :attribute phải là :size.',
        'file' => 'File :attribute phải là :size kilobytes.',
        'string' => 'Giá trị :attribute phải là :size ký tự.',
        'array' => ':attribute phải chứa :size mục.',
    ],
    'starts_with' => 'Giá trị :attribute phải bắt đầu với một trong những: :values.',
    'string' => 'Giá trị :attribute phải là một string.',
    'timezone' => 'Giá trị :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Giá trị :attribute đã được sử dụng.',
    'uploaded' => ':attribute không tải lên được.',
    'url' => 'Url :attribute không đúng định dạng.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
