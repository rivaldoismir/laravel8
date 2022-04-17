<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // jika true maka semua user bisa menggunakan request ini
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Kondisi jika unique pada edit
        $rule_task_unique = Rule::unique('tasks', 'task');
        if ($this->method() !== 'POST') {
            // rule apabila ada kesamaan di field task yang ternyata memiliki kesamaan di field id maka di bolehkan untuk unik
            $rule_task_unique->ignore($this->route()->parameter('id'));
        }

        // Available Validation Rules
        return [
            'task' => ['required', $rule_task_unique],
            'user' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'isian :attribute harus diisi',
            'user.required' => 'nama pengguna harus diisi',
        ];
    }
}
