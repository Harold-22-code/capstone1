<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public function SchedulingForm()
    {
        // This method will handle the logic for displaying the scheduler view
        return view('secretary.schedule.schedule-form');
    }

    public function saveSchedule(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => ['required', 'integer', 'min:1'],
            // Additional fields for specific events
            'groom_name' => 'required_if:event_id,' . $this->getEventIdByName('Wedding'),
            'bride_name' => 'required_if:event_id,' . $this->getEventIdByName('Wedding'),
            'deceased_name' => 'required_if:event_id,' . $this->getEventIdByName('Burial'),
            'child_name' => 'required_if:event_id,' . $this->getEventIdByName('Baptism'),
            'father_name' => 'required_if:event_id,' . $this->getEventIdByName('Baptism'),
            'mother_name' => 'required_if:event_id,' . $this->getEventIdByName('Baptism'),
            'confirmand_name' => 'required_if:event_id,' . $this->getEventIdByName('Confirmation'),
        ]);

        $user = auth()->user();
        $eventId = $request->event_id;
        $recordId = null;

        $event = \App\Models\Event::find($eventId);
        $recordType = strtolower($event->name);
        switch ($recordType) {
            case 'wedding':
                $record = \App\Models\WeddingRecord::create([
                    'year' => date('Y', strtotime($request->reservation_date)),
                    'date_of_marriage' => $request->reservation_date,
                    'husband_name' => $request->groom_name,
                    'wife_name' => $request->bride_name,
                    'husband_status' => 'Single',
                    'wife_status' => 'Single',
                    'husband_age' => 0,
                    'wife_age' => 0,
                    'municipality' => 'N/A',
                    'barangay' => 'N/A',
                    'husband_parents' => 'N/A',
                    'wife_parents' => 'N/A',
                    'sponsor1' => 'N/A',
                    'sponsor2' => 'N/A',
                    'place_of_sponsor' => 'N/A',
                    'presider' => 'N/A',
                ]);
                $recordId = $record->id;
                break;
            case 'burial':
                $record = \App\Models\BurialRecord::create([
                    'user_id' => $user->id,
                    'deceased_name' => $request->deceased_name,
                    'burial_date' => $request->reservation_date,
                    'number_of_people' => $request->number_of_people,
                ]);
                $recordId = $record->id;
                break;
            case 'baptism':
                $record = \App\Models\BaptismalRecord::create([
                    'user_id' => $user->id,
                    'child_name' => $request->child_name,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'baptismal_date' => $request->reservation_date,
                    'number_of_people' => $request->number_of_people,
                ]);
                $recordId = $record->id;
                break;
            case 'confirmation':
                $record = \App\Models\ConfirmationRecord::create([
                    'user_id' => $user->id,
                    'confirmand_name' => $request->confirmand_name,
                    'confirmation_date' => $request->reservation_date,
                    'number_of_people' => $request->number_of_people,
                ]);
                $recordId = $record->id;
                break;
        }

        // Save the schedule
        \App\Models\Schedule::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
            'reservation_id' => $recordId,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
            'status' => 'pending',
        ]);

        return redirect()->route('users.schedule-form')->with('success', 'Schedule saved successfully!');
    }

    // Helper to get event id by name
    private function getEventIdByName($name)
    {
        $event = \App\Models\Event::where('name', $name)->first();
        return $event ? $event->id : null;
    }
}
