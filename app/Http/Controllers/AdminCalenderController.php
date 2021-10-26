<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\event;

class AdminCalenderController extends Controller
{
    public function index()
    { 
        $events = event::all();
        return view('admin.calendar',compact('events'));
    }

     public function ajax(Request $request)
     {
        if($request->type=="add")
        {
            $title=$request->title;
            $evtStart=$request->evtStart;
            $evtEnd=$request->evtEnd;
            $evensave = new event;
            $evensave->title = $title;
            $evensave->evtStart = $evtStart;
            $evensave->evtEnd = $evtEnd;
            $evensave->save();
            $eventid=$evensave->id;
            
            $arr=array('id'=>$eventid,'title'=>$title,'start'=>$evtStart);
            echo json_encode($arr);
            //echo json_encode('Datainserted');
            die();
        }
        elseif($request->type=="update")
        {
            $id=$request->id;
            $title=$request->title;
            $start=$request->start;
            $end=$request->end;
            event::where('id', $id)->update(['title' => $title, 'evtStart' => $start,'evtEnd'=>$end]);
            echo json_encode('DataUpdated');
            die();
        }
        elseif($request->type=="delete")
        {
            $id=$_POST['id'];
            event::where('id',$id)->delete();
            echo json_encode('DataDeleted');
            die();
        }



        //  switch ($request->type) {
        //      case 'add':
        //          $event = event::create([
        //              'title' => $request->title,
        //              'start_date' => $request->start,
        //              'end_date' => $request->end,
        //          ]);
        //          return response()->json($event);
        //          break;
        //      case 'update':
        //          $event = event::find($request->id)->update([
        //              'title' => $request->title,
        //              'start_date' => $request->start,
        //              'end_date' => $request->end,
        //          ]);
        //          return response()->json($event);
        //          break;
        //      case 'delete':
        //          $event = event::find($request->id)->delete();
        //          return response()->json($event);
        //          break;
        //     default:
        //         break;
        //  }
     }
}