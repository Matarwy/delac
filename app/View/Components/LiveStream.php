<?php

namespace App\View\Components;

use App\Models\Instructor;
use Illuminate\View\Component;

class LiveStream extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    
    public $stream;
    public function __construct(Instructor $stream)
    {
        //
        $this->stream = $stream;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.live-stream');
    }
}
