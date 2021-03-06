<?php

namespace App\Http\Requests\Customer\Novel;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DataExists;

class DetailNovelForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'novel_id'=>array(
                'bail',
                'required',
                'integer',
                new DataExists('novel','\App\Models\Novel','不存在该小说',true,function($query,$value){
                    $query->where('id',$value)
                            ->where('status',1);
                }),
            ),
            'novel_chapter_id'=>array(
                'bail',
                'nullable',
                'integer',
                new DataExists('novel_chapter','\App\Models\NovelChapter','不存在该小说章节',true,function($query,$value){
                    $query->where('id',$value)
                            ->where('status',1);
                }),
            ),
        ];
    }

    public function  messages(){
        return [
            'novel_id.*'=>'不存在该小说',
            'novel_chapter_id.*'=>'不存在该小说章节',
        ];
    }
}
