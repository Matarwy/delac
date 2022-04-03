<?php

namespace App\View\Components;

use App\Models\Course;
use Illuminate\View\Component;

class HorizontalCourses extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $course;
    public function __construct(Course $course)
    {

        $this->course = $course;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.horizontal-courses');
    }
}
