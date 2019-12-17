<?php

namespace App\Http\Controllers;

use App\TicketStatus;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $ticket=TicketStatus::ALL();
        return view('ticket_status.index',compact('ticket','help_desk','priority','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        return view('ticket_status.create',compact('ticket','help_desk','priority','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'ts_name'=>'required'
        ]);
       $ticket=new TicketStatus();
       $ticket->ts_name=$request->ts_name;
       $ticket->save();
        return json_encode(["response"=>"ok"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TicketStatus $ticketStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketStatus $ticketStatus)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
        $ticket=TicketStatus::find($ticketStatus);
        return view('ticket_status.edit',compact('ticket','help_desk','priority','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketStatus $ticketStatus)
    {
        $this->validate($request,[
            'ts_name'=>'required'
        ]);
        $ticket=TicketStatus::find($ticketStatus);
        $ticket->ts_name=$request->ts_name;
        $ticket->save();
        return json_encode(["response"=>"ok"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketStatus  $ticketStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketStatus $ticketStatus)
    {
        $ticket=TicketStatus::find($ticketStatus);
        $ticket->delete();
        return redirect()->back()->with('successMSG', 'عملیات حذف اطلاعات با موفقیت انجام شد.');
    }
}
