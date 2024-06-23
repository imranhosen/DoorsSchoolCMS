<?php
namespace App\Http\Controllers\backEnd\item_issue;

use App\Http\Controllers\Controller;
use App\Models\ItemIssue;
use App\Models\Sms;
use App\Models\Staff;
use App\Notifications\WelcomeSmsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;





class ItemIssueController extends Controller
{

    public function index(){
            $sms = Sms::first();
            $project = [
                'greeting' => 'Hi '.$sms->name.',',
                'body' => 'This is the project assigned to you.',
                'thanks' => 'Thank you this is from codeanddeploy.com',
                'actionText' => 'View Project',
                'actionURL' => url('/'),
                'id' => 57
            ];
            $sms->notify(new WelcomeSmsNotification());

            Notification::send($sms, new WelcomeSmsNotification($project));

            dd('Notification sent!');

        /*$sms = Sms::first();
        $sms->notify(new WelcomeSmsNotification);
        return view('sms.sms')->with('message','wow!');*/
    }

    public function fetchStaff(Request $request)
    {
        $data['staffs'] = Staff::where('role_id',$request->role_id)->get(['full_name','id']);
        return response()->json($data);
    }
    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $itemIssue = ItemIssue::where('id', \request("id"))->first();
        $itemIssue->status = $itemIssue->status==1?0:1;
        $itemIssue->save();
        return redirect(route('voyager.item-issues.index'));
    }


    public function forceDelete($id)
    {

        $itemIssue = ItemIssue::findorfail($id);
        $itemIssue->forceDelete();

        return redirect(route('voyager.item-issues.index'));

    }


}



