<?php

namespace App\View\Components;

use App\Models\Instructor;
use Illuminate\View\Component;

class SqaureInstructors extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $ins;
    public function __construct(Instructor $ins)
    {
        $this->ins = $ins;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sqaure-instructors');
    }
}
