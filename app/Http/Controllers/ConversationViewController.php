<?php

namespace App\Http\Controllers;

use App\ConversationView;
use App\User;
use Illuminate\Http\Request;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use Illuminate\Support\Facades\DB;

class ConversationViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    for conversation view index
    public function index()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $last_message = ConversationView::where('hcv_receiver_user_id', $user)->whereNotNull('hcv_message_status')->get();
        $find_last_message = ConversationView::where('hcv_receiver_user_id', $user)->whereNotNull('hcv_message_status')->get()->last();
        $counter = ConversationView::where('hcv_receiver_user_id', $user)->where('hcv_message_status', null)->count();
        $user_name = User::all();
        $user_admin = User::where('name', 'admin')->get();
        $message_send = ConversationView::where('hcv_request_user_id', $user)->Where('hcv_request_user_id', $user_admin)->Where('hcv_receiver_user_id', $user_admin)->Where('hcv_receiver_user_id', $user)->get();
        return view('conversation_view.index', compact('type', 'priority', 'help_desk', 'message_receive', 'message_send', 'user_name', 'user', 'counter', 'last_message', 'find_last_message'));

    }


    public function show(Request $request,$id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $conversation = ConversationView::find($id);
        $conversation_name = User::select('name')->where('id',$conversation->hcv_request_user_id)->get()->last();
        return view('conversation_view.show',compact('conversation','conversation_name','help_desk','type','priority','user'));
    }

    public function inbox()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return view('conversation_view.inbox', compact('type', 'priority', 'help_desk', 'user'));

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
        $size_name = count(collect($request)->get('user_receive_id'));
        if ($size_name == 1) {
            $message_request = new ConversationView();
            $message_request->hcv_receiver_user_id = $request->user_receive_id[0];
            $message_request->hcv_request_user_id = auth()->user()->id;
            $message_request->hcv_message = $request->message;
            $message_request->save();
        } else {
            $item = $request->user_receive_id;
            $index = 0;
            foreach ($item as $items) {
                $message_request = new ConversationView();
                $message_request->hcv_receiver_user_id = $request->user_receive_id[$index];
                $message_request->hcv_request_user_id = auth()->user()->id;
                $message_request->hcv_message = $request->message;
                $message_request->save();
                $index++;
            }
        }
        return json_encode(["response" => "OK"]);
    }

    public function conversation_view_store(Request $request)
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
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $last_message = ConversationView::where('hcv_receiver_user_id', $user)->whereNotNull('hcv_message_status')->get();
        $find_last_message = ConversationView::where('hcv_receiver_user_id', $user)->where('hcv_request_user_id', $id)->whereNotNull('hcv_message_status')->get()->last();
        $counter = ConversationView::where('hcv_receiver_user_id', $user)->where('hcv_message_status', null)->where('hcv_request_user_id', $id)->count();
        ConversationView::where('hcv_request_user_id', $id)->where('hcv_receiver_user_id', $user)
            ->update(['hcv_message_status' => '1']);
        $message_send = ConversationView::where('hcv_request_user_id', $id)->orWhere('hcv_receiver_user_id', $id)->get();
        return view('conversation_view.index', compact('type', 'priority', 'help_desk', 'message_send', 'user_name', 'user', 'counter', 'last_message', 'find_last_message'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hcv_message_receive' => 'required',
        ]);
        $message_receive = ConversationView::find($id);
        $message_receive->hr_name = $request->hr_name;
        $message_receive->hcv_message_receive = $request->hcv_message_receive;
        $message_receive->hcv_message_status = 1;
        $message_receive->save();
        return json_encode(["response" => "OK"]);

    }

    public function update_status(Request $request, $id)
    {
        $message_receive = ConversationView::find($id);
        $message_receive->hcv_message_status = 1;
        $message_receive->save();
        return json_encode(["response" => "OK"]);

    }

    public function destroy($id)
    {
        $message = ConversationView::find($id);
        $message->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }


    public function fill_unread_message(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $current_user = auth()->user()->id;
        if ($search == '') {
            $message_conv_view = DB::table('hnt_conversation_view')
                ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                ->where('hnt_conversation_view.hcv_message_status', '=', 0)
                ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                ->where('hnt_conversation_view.deleted_at', '=', Null)
                ->orderBy('hnt_conversation_view.created_at', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $message_conv_view = DB::table('hnt_conversation_view')
                ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                ->where('hnt_conversation_view.hcv_message_status', '=', 0)
                ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                ->where('hnt_conversation_view.deleted_at', '=', Null)
                ->where('hnt_conversation_view.hcv_message', 'LIKE', "%$search%")
                ->orderBy('hnt_conversation_view.created_at', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($message_conv_view as $message_conv_views) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $message_conv_views->name . '",' . '"' . $message_conv_views->hcv_message . '",' . '"' . Verta($message_conv_views->created_at) . '",' . '"' . $message_conv_views->id . '",' . '"' . $message_conv_views->hcv_request_user_id . '"],';
        }
        $data = substr($data, 0, -1);
        $message_conv_views_count = ConversationView::all()->count();
        return response('{ "recordsTotal":' . $message_conv_views_count . ',"recordsFiltered":' . $message_conv_views_count . ',"data": [' . $data . ']}');
    }

    public function fill_receive(Request $request)
    {
        $sort = $request->order[0]["column"];
        $orderable = $request->order[0]["dir"];
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $current_user = auth()->user()->id;

        if ($search == '') {
            if ($sort && $orderable != '') {
                if($sort == 1){
                    $message_conv_view = DB::table('hnt_conversation_view')
                        ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                        ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                        ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                        ->where('hnt_conversation_view.deleted_at', '=', Null)
                        ->orderBy('users.name', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if($sort == 2){
                    $message_conv_view = DB::table('hnt_conversation_view')
                        ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                        ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                        ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                        ->where('hnt_conversation_view.deleted_at', '=', Null)
                        ->orderBy('hnt_conversation_view.hcv_message', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
                if($sort == 3){
                    $message_conv_view = DB::table('hnt_conversation_view')
                        ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                        ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                        ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                        ->where('hnt_conversation_view.deleted_at', '=', Null)
                        ->orderBy('hnt_conversation_view.created_at', $orderable)
                        ->skip($start)
                        ->take($length)
                        ->get();
                }
            }else{
                $message_conv_view = DB::table('hnt_conversation_view')
                    ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                    ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                    ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                    ->where('hnt_conversation_view.deleted_at', '=', Null)
                    ->orderBy('hnt_conversation_view.created_at', 'desc')
                    ->skip($start)
                    ->take($length)
                    ->get();
            }

        } else {
            $message_conv_view = DB::table('hnt_conversation_view')
                ->join('users', 'hnt_conversation_view.hcv_request_user_id', '=', 'users.id')
                ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_request_user_id')
                ->where('hnt_conversation_view.hcv_receiver_user_id', '=', $current_user)
                ->where('hnt_conversation_view.deleted_at', '=', Null)
                ->where('hnt_conversation_view.hcv_message', 'LIKE', "%$search%")
                ->orderBy('hnt_conversation_view.created_at', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($message_conv_view as $message_conv_views) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $message_conv_views->name . '",' . '"' . $message_conv_views->hcv_message . '",' . '"' . Verta($message_conv_views->created_at) . '",' . '"' . $message_conv_views->id . '",' . '"' . $message_conv_views->hcv_request_user_id . '"],';
        }

        $data = substr($data, 0, -1);
        $message_conv_views_count = ConversationView::all()->count();
        return response('{ "recordsTotal":' . $message_conv_views_count . ',"recordsFiltered":' . $message_conv_views_count . ',"data": [' . $data . ']}');
    }

    public function fill_send(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        $current_user = auth()->user()->id;
        if ($search == '') {
            $message_conv_view = DB::table('hnt_conversation_view')
                ->join('users', 'hnt_conversation_view.hcv_receiver_user_id', '=', 'users.id')
                ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_receiver_user_id')
                ->where('hnt_conversation_view.hcv_request_user_id', '=', $current_user)
                ->where('hnt_conversation_view.deleted_at', '=', Null)
                ->orderBy('hnt_conversation_view.created_at', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
        } else {
            $message_conv_view = DB::table('hnt_conversation_view')
                ->join('users', 'hnt_conversation_view.hcv_receiver_user_id', '=', 'users.id')
                ->select('hnt_conversation_view.hcv_message', 'hnt_conversation_view.id', 'users.name', 'hnt_conversation_view.created_at', 'hnt_conversation_view.hcv_receiver_user_id')
                ->where('hnt_conversation_view.hcv_request_user_id', '=', $current_user)
                ->where('hnt_conversation_view.deleted_at', '=', Null)
                ->where('hnt_conversation_view.hcv_message', 'LIKE', "%$search%")
                ->orderBy('hnt_conversation_view.created_at', 'desc')
                ->get();
        }

        $data = '';
        $key = 0;
        foreach ($message_conv_view as $message_conv_views) {
            $key++;
            $data .= '["' . $key . '",' . '"' . $message_conv_views->name . '",' . '"' . $message_conv_views->hcv_message . '",' . '"' . Verta($message_conv_views->created_at) . '",' . '"' . $message_conv_views->id . '",' . '"' . $message_conv_views->hcv_receiver_user_id . '"],';
        }
        $data = substr($data, 0, -1);
        $message_conv_views_count = ConversationView::all()->count();
        return response('{ "recordsTotal":' . $message_conv_views_count . ',"recordsFiltered":' . $message_conv_views_count . ',"data": [' . $data . ']}');
    }

}
