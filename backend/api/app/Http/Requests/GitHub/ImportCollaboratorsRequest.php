<?php

namespace App\Http\Requests\GitHub;

use Illuminate\Foundation\Http\FormRequest;

class ImportCollaboratorsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'owner' => 'required|string|max:100',
            'repository' => 'required|string|max:100',
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->all(), [
            'owner' => $this->route('owner'),
            'repository' => $this->route('repository'),
        ]);
    }
}
