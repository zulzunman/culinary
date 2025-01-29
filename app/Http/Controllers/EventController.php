<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('admin.event.list_event', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create_event');
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required',
                'proposal' => 'required|file|mimes:pdf',
            ]);
            $name = $request->input('name');

            $proposal_file = $request->file('proposal');
            $filename = 'file' . '-' . str_replace(' ', '_', $name) . '.' . $proposal_file->getClientOriginalExtension();
            $destinationPath = 'assets/file/event/' . $filename;
            $proposal_file->move(public_path('assets/file/event'), $filename);

            $event = new Event();
            $event->name = $request->input('name');
            $event->proposal = $destinationPath;
            $event->save();

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create payment: ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit_event', compact('event'));
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required',
                'proposal' => 'nullable|file|mimes:pdf',
            ]);

            $event = Event::findOrFail($request->event_id);
            $event->name = $request->input('name');

            // Handle proposal file if uploaded
            if ($request->hasFile('proposal')) {
                // Delete old file if exists
                if ($event->proposal && file_exists(public_path($event->proposal))) {
                    unlink(public_path($event->proposal));
                }

                $proposal_file = $request->file('proposal');
                $filename = 'file' . '-' . str_replace(' ', '_', $request->input('name')) . '.' . $proposal_file->getClientOriginalExtension();
                $destinationPath = 'assets/file/event/' . $filename;
                $proposal_file->move(public_path('assets/file/event'), $filename);
                $event->proposal = $destinationPath;
            }

            $event->save();
            DB::commit();

            return redirect()->route('event.index')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update event: ' . $e->getMessage());
        }
    }
}
