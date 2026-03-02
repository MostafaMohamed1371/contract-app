<?php

return [
    'required' => 'حقل :attribute مطلوب.',
    'string' => 'حقل :attribute يجب أن يكون نصاً.',
    'max' => [
        'string' => 'حقل :attribute يجب ألا يزيد عن :max حرفاً.',
        'file' => 'حقل :attribute يجب ألا يزيد حجمه عن :max كيلوبايت.',
    ],
    'unique' => 'قيمة :attribute مستخدمة من قبل.',
    'numeric' => 'حقل :attribute يجب أن يكون رقماً.',
    'date' => 'حقل :attribute ليس تاريخاً صالحاً.',
    'mimes' => 'حقل :attribute يجب أن يكون ملفاً من النوع: :values.',
    'file' => 'حقل :attribute يجب أن يكون ملفاً.',
    'exists' => 'القيمة المحددة في :attribute غير صحيحة.',
    'integer' => 'حقل :attribute يجب أن يكون عدداً صحيحاً.',

    'attributes' => [
        'contract_number' => 'رقم العقد',
        'entity_name' => 'اسم الجهة',
        'contract_type' => 'نوع العقد',
        'signed_at' => 'تاريخ التوقيع',
        'duration' => 'مدة العقد',
        'end_date' => 'تاريخ الانتهاء',
        'amount' => 'قيمة العقد',
        'status' => 'حالة العقد',
        'signed_pdf' => 'ملف العقد (PDF)',
        'notify_before_days' => 'عدد أيام التنبيه قبل الانتهاء',

        'case_number' => 'رقم الدعوى',
        'file_number' => 'رقم القضية',
        'court' => 'المحكمة',
        'case_type' => 'نوع الدعوى',
        'parties' => 'المدعي / المدعى عليه',
        'responsible_lawyer' => 'المحامي المسؤول',
        'next_hearing_at' => 'تاريخ الجلسة القادمة',

        'type' => 'نوع الإشعار',
        'subject' => 'عنوان الإشعار',
        'content' => 'نص الإشعار',
        'contract_id' => 'العقد',
        'legal_case_id' => 'القضية',
        'sent_at' => 'تاريخ الإرسال',
        'recipient' => 'المستلم / الجهة',
        'attachment' => 'المرفق',
    ],
];

