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

    'accepted' => ':attribute  phải được chấp nhận.',
    'accepted_if' => ':attribute  phải được chấp nhận khi :other là :value.',
    'active_url' => ':attribute  không phải là URL hợp lệ.',
    'after' => ':attribute phải là ngày sau :date.',
    'after_or_equal' => ':attribute  phải là ngày sau hoặc bằng :date.',
    'alpha' => ':attribute  chỉ được chứa các chữ cái.',
    'alpha_dash' => ':attribute  chỉ được chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute  chỉ được chứa các chữ cái và số.',
    'array' => ':attribute  phải là một mảng.',
    'before' => ':attribute phải là ngày trước :date.',
    'before_or_equal' => ' :attribute phải là ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute  phải nằm giữa :min và :max.',
        'file' => ':attribute phải nằm giữa :min và :max kilobyte.',
        'string' => ':attribute phải nằm giữa :min và :max ký tự.',
        'array' => 'Các mục :attribute phải có từ :min đến :max.',
    ],

    'boolean' => 'Trường :attribute phải đúng hoặc sai.',
    'confirmed' => 'Xác nhận :attribute  không khớp.',
    'current_password' => 'Mật khẩu không đúng.',
    'date' => ':attribute  không phải là ngày hợp lệ.',
    'date_equals' => ':attribute  phải là ngày bằng :date.',
    'date_format' => ':attribute  không khớp với định dạng :format.',
    'declined' => ':attribute  phải bị từ chối.',
    'declined_if' => ':attribute  phải bị từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác nhau.',
    'chữ số' => 'Thuộc tính : phải là :chữ số chữ số.',
    'digits_between' => ':attribute  phải nằm giữa :min và :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute  phải kết thúc bằng một trong những điều sau: :values.',
    'enum' => 'Thuộc tính :đã chọn không hợp lệ.',
    'exists' => 'Thuộc tính :đã chọn không hợp lệ.',
    'file' => ':attribute  phải là một tập tin.',
    'filling' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'numeric' => ':attribute  phải lớn hơn :giá trị.',
        'file' => ':attribute  phải lớn hơn :giá trị kilobyte.',
        'string' => 'Ký tự :attribute phải lớn hơn :value ký tự.',
        'array' => 'Các mục :attribute phải có nhiều hơn :value.',
    ],
    'gte' => [
        'numeric' => ':attribute  phải lớn hơn hoặc bằng :giá trị.',
        'file' => ':attribute  phải lớn hơn hoặc bằng :giá trị kilobyte.',
        'string' => 'Các ký tự :attribute phải lớn hơn hoặc bằng :value.',
        'array' => ':attribute phải có :value item trở lên.',
    ],
    'image' => ':attribute  phải là một hình ảnh.',
    'in' => 'Thuộc tính :đã chọn không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => ':attribute  phải là số nguyên.',
    'ip' => ':attribute  phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute  phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute  phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute  phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute  phải nhỏ hơn :giá trị.',
        'file' => ':attribute  phải nhỏ hơn :giá trị kilobyte.',
        'string' => 'Ký tự :attribute phải nhỏ hơn :value.',
        'array' => 'Các mục :attribute phải có ít hơn :value.',
    ],
    'lte' => [
        'numeric' => ':attribute  phải nhỏ hơn hoặc bằng :giá trị.',
        'file' => ':attribute  phải nhỏ hơn hoặc bằng :giá trị kilobyte.',
        'string' => 'Ký tự :attribute phải nhỏ hơn hoặc bằng :value.',
        'array' => 'Các mục :attribute không được có nhiều hơn :value.',
    ],
    'mac_address' => ':attribute  phải là địa chỉ MAC hợp lệ.',
    'max' => [
        'numeric' => ':attribute  không được lớn hơn :max.',
        'file' => ':attribute  không được lớn hơn :kilobyte tối đa.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max item.',
    ],
    'mimes' => ':attribute phải là một tập tin kiểu: :values.',
    'mimetypes' => ':attribute phải là một tập tin kiểu: :values.',
    'min' => [
        'numeric' => ':attribute  ít nhất phải là :min.',
        'file' => ':attribute ít nhất phải là :min kilobyte.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'array' => ':attribute phải có ít nhất :min item.',
    ],
    'multiple_of' => ':attribute  phải là bội số của :giá trị.',
    'not_in' => 'Thuộc tính :đã chọn không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute  phải là số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => 'Trường :attribute phải có.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường :attribute cấm :other xuất hiện.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục cho: :values.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi có :values.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi có :values.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values ​​không có.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có :value nào hiện diện.',
    'same' => ':attribute và :other phải khớp.',
    'size' => [
        'numeric' => ':attribute  phải là :size.',
        'file' => ':attribute  phải là :size kilobyte.',
        'string' => ':attribute phải là :size ký tự.',
        'array' => ':attribute  phải chứa các mục :size.',
    ],
    'starts_with' => ':attribute  phải bắt đầu bằng một trong những điều sau: :values.',
    'string' => ':attribute  phải là một chuỗi.',
    'timezone' => ':attribute  phải là múi giờ hợp lệ.',
    'unique' => ':attribute  đã được sử dụng.',
    'uploaded' => 'Không thể tải lên :attribute.',
    'url' => ':attribute  phải là một URL hợp lệ.',
    'uuid' => ':attribute  phải là UUID hợp lệ.',

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
