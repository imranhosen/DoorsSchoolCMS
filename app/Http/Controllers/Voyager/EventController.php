<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class EventController extends VoyagerBaseController
{

    public function active(){
        $event = Event::where('id', \request("id"))->first();
        $event->status = $event->status==1?0:1;
        $event->save();
        return redirect(route('voyager.events.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $event = Event::withTrashed()->findorfail($id);
        if ($event->event_image != null) {
            $oldFileExists = Storage::disk('public')->exists($event->event_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($event->event_image);
            }
        }
        if ($event->featured_image != null) {
            $oldFileExists = Storage::disk('public')->exists($event->featured_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($event->featured_image);
            }
        }
        $event->forceDelete();

        return redirect(route('voyager.events.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }


}

