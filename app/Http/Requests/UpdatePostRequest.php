<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * กำหนดสิทธิ์การเข้าถึง (ให้ return true ไปก่อนหากยังไม่มีระบบสิทธิ์ที่ซับซ้อน)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * กำหนดกฎการตรวจสอบข้อมูล
     */
    public function rules(): array
    {
        return [
            // ต้องมีข้อมูล, เป็นข้อความ, ความยาวไม่เกิน 255 ตัวอักษร
            'title' => ['required', 'string', 'max:255'],

            // ต้องมีข้อมูล, เป็นข้อความ
            'text' => ['required', 'string'],

            // ต้องมีข้อมูล และ ค่าที่ส่งมาต้องมีอยู่จริงในคอลัมน์ id ของตาราง categories
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    /**
     * (Optional) สามารถ Custom ข้อความแจ้งเตือนเองได้ หากผู้ใช้กรอกผิด
     */
    public function messages(): array
    {
        return [
            'category_id.exists' => 'ไม่พบหมวดหมู่นี้ในระบบ กรุณาเลือกใหม่',
        ];
    }
}
