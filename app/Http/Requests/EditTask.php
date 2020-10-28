<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        // 許可リストの作成 (規定の状態の値 )
        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
            // status のルールは 'required|in(1, 2, 3)'
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        
        return $attributes + [
            'status' => '状態',
        ];
    }
 
    public function messages()
    {
        $messages = parent::messages();

        // Task::STATUS に対して label キーの値を取り出す
        $status_labels = array_map(function($item){
            return $item['label'];
        }, Task::STATUS );

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
