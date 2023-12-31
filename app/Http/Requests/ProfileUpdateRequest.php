<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // dd($this->all());
        // dd($this->user()->username);
        if($this->user()->username){
            return [
                'name' => ['string', 'max:255'],
                // 'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->email)],
                'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
                'ktp' => ['integer'],
                'telephone' => ['integer'],
                'birth' => ['date'],
                'gender' => ['string'],
                'avatar' => ['image','file','max:1024'],

                //Admin
                'username' => ['string'],
            ];

        }else{
            return [
                'name' => ['string', 'max:255'],
                // 'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->email)],
                'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
                'ktp' => ['integer'],
                'telephone' => ['integer'],
                'birth' => ['date'],
                'gender' => ['string'],
                'avatar' => ['image','file','max:1024'],

                //Admin
                'username' => ['string'],
            ];

        }
    }
}
