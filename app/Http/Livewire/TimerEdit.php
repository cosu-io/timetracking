<?php

namespace App\Http\Livewire;

use App\Http\Traits\DateHelpers;
use App\Models\Timer;
use Livewire\Component;

class TimerEdit extends Component
{
    use DateHelpers;

    public Timer $item;
    public String $time;
    public Bool $showDetails = false;
    public String $detailsOpenedTab = 'edit';

    protected $listeners = ['openEditor'];

    protected $rules = [
        'item.title' => 'nullable|string|max:250',
        'item.notes' => 'nullable|string|max:1000',
        'item.start' => 'required|date|before_or_equal:item.end',
        'item.end' => 'required|date|after_or_equal:item.start',
    ];

    public function mount() {
        if ($this->item->deleted) {
            $this->detailsOpenedTab = 'history';
        }
    }

    public function openEditor($item) {
        $this->item = Timer::find($item['id']);
        if ($this->item->deleted) {
            $this->detailsOpenedTab = 'history';
        } else {
            $this->detailsOpenedTab = 'edit';
        }
        $this->showDetails = true;
    }

    public function updateTimer() {
        $this->validate();
        $this->item->save();
        $this->closeTimerDetails();
    }

    public function deleteTimer() {
        $this->item->update([
            'deleted' => true,
        ]);
        $this->closeTimerDetails();
    }

    public function closeTimerDetails() {
        $this->showDetails = false;
        $this->emit('refreshTracker');
        $this->emit('updateStats');
    }

    public function render()
    {
        return view('livewire.timer-edit');
    }
}
