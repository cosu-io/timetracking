<?php

namespace App\View\Components;

use App\Http\Traits\DateHelpers;
use App\Models\Timer;
use Illuminate\View\Component;

class TrackerItem extends Component
{

    use DateHelpers;

    public Timer $item;
    public String $time;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Timer $data)
    {
        $this->item = $data;
        $this->time = $this->niceTimeDisplay($this->item->duration);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tracker-item');
    }
}
