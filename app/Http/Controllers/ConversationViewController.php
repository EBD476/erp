<?php

namespace App\Http\Controllers;

use App\ConversationView;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;

class ConversationViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $last_message=ConversationView::where('hcv_receiver_user_id',$user)->whereNotNull('hcv_message_status')->get();
        $find_last_message=ConversationView::where('hcv_receiver_user_id',$user)->whereNotNull('hcv_message_status')->get()->last();
        $counter=ConversationView::where('hcv_receiver_user_id',$user)->where('hcv_message_status',null)->count();
        $user_name = User::all();
        $user_admin =User::where('name','admin')->get();
        $message_send = ConversationView::where('hcv_request_user_id', $user)->Where('hcv_request_user_id', $user_admin)->Where('hcv_receiver_user_id', $user_admin)->Where('hcv_receiver_user_id', $user)->get();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        return view('conversation_view.index', compact('type', 'priority', 'help_desk', 'message_receive', 'message_send', 'user_name', 'user','counter','last_message','find_last_message'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);
        $message_request = new ConversationView();
        $message_request->hcv_receiver_user_id = $request->user_receive_id;
        $message_request->hcv_request_user_id = auth()->user()->id;
        $message_request->hcv_message = $request->message;
        $message_request->save();
        return json_encode(["response" => "OK"]);
    }

    public function edit($id)
    {
        $user_name = User::all();
        $user = auth()->user()->id;
        $last_message=ConversationView::where('hcv_receiver_user_id',$user)->whereNotNull('hcv_message_status')->get();
        $find_last_message=ConversationView::where('hcv_receiver_user_id',$user)->where('hcv_request_user_id',$id)->whereNotNull('hcv_message_status')->get()->last();
        $counter=ConversationView::where('hcv_receiver_user_id',$user)->where('hcv_message_status',null)->where('hcv_request_user_id',$id)->count();
        ConversationView::where('hcv_request_user_id', $id)->where('hcv_receiver_user_id', $user)
            ->update(['hcv_message_status'=>'1']);
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $message_send = ConversationView::where('hcv_request_user_id', $id)->orWhere('hcv_receiver_user_id', $id)->get();
        return view('conversation_view.index', compact('type', 'priority', 'help_desk' ,'message_send', 'user_name', 'user','counter','last_message','find_last_message'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hcv_message_receive' => 'required',
        ]);
        $message_receive = ConversationView::find($id);
        $message_receive->hr_name = $request->hr_name;
        $message_receive->hcv_message_receive = $request->hcv_message_receive;
        $message_receive->save();
        return json_encode(["response" => "OK"]);

    }

    public function destroy($id)
    {
        $message = ConversationView::find($id);
        $message->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
