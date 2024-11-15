<?php

namespace App\Livewire\Front\Dashboard\UploadJob;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StepTwo extends Component
{

    public $items = [''];

    #[Validate(onUpdate: false)]
    public $skills = [''];
    #[Validate(onUpdate: false)]
    public $ideal_answer = [''];

    #[Validate(onUpdate: false)]
    public $required = [true];


    public function rules()
    {
        return   [
            'skills.*' => 'required|string|min:2|max:191',
            'ideal_answer.*' => 'numeric|between:1,100',
            'required.*' => 'boolean',
        ];
    }
    public function messages()
    {
        return   [
            'skills.*.required' => 'Skill is required',
            'skills.*.min' => 'Skill must be at least 2 characters',
            'skills.*.max' => 'Skill must not exceed 191 characters',
            'ideal_answer.*.numeric' => 'Ideal answer must be a number',
            'ideal_answer.*.between' => 'Ideal answer must be between 1 and 100',
        ];
    }
    #[On('step_next')]
    public function next()
    {
        $this->dispatch('status',false);
        $validate =  $this->validate( );
        $this->dispatch('step_2',$validate);
        $this->dispatch('status',true);
    }
    public function add_item()
    {
        $this->items[] = '';
        $this->skills[] = '';
        $this->ideal_answer[] = '';
        $this->required[] = true;
    }
    public function remove_item($index)
    {
        unset($this->items[$index]);
        unset($this->skills[$index]);
        unset($this->ideal_answer[$index]);
        unset($this->required[$index]);


    }
    public function render()
    {
        return view('livewire.front.dashboard.upload-job.step-two');
    }
}
