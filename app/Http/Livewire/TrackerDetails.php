<?php

namespace App\Http\Livewire;

use App\Models\Timer;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Tracker as TrackerModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TrackerDetails extends Component
{
    public bool $editTitle = false;
    public TrackerModel $tracker;

    protected $listeners = ['refreshTracker' => '$refresh'];

    protected $rules = [
        'tracker.title' => 'nullable|string|max:250',
    ];

    public function saveTitle() {
        $this->validate();
        $this->tracker->save();
        $this->editTitle = false;
    }

    public function downloadQrCode() {
        return response()->streamDownload( function () {
            echo QrCode::format('png')->size(1000)->generate(url('/t/'.$this->tracker->identifier));
        }, 'cosu-timetracker-'.$this->tracker->identifier.'.png');
    }

    public function startTimer() {
        Timer::create([
            'tracker_id' => $this->tracker->id,
            'start' => Carbon::now(),
        ]);
        $this->emit('refreshTracker');
    }
    public function createManualTimer() {
        // TODO: Create function
    }

    public function render()
    {
        return view('livewire.tracker-details');
    }
}
