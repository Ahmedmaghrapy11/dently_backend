<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            return [
                'lab_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ];
        }
        else {
            return [
                'lab_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ];
        }
    }

    /**
     * custom massages for validation.
     *
     * @return array
     */

     public function message() {
        if (request()->isMethod('post')) {
            return [
                'lab_id.required' => 'Name is required',
                'image.required' => 'Image is required'
            ];
        }
     }
}
