<?php

namespace App\Http\Controllers;

use App\ConversationView;
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
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();

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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConversationView  $conversationView
     * @return \Illuminate\Http\Response
     */
    public function show(ConversationView $conversationView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConversationView  $conversationView
     * @return \Illuminate\Http\Response
     */
    public function edit(ConversationView $conversationView)
    {
        $type=HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status','1')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConversationView  $conversationView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConversationView $conversationView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConversationView  $conversationView
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConversationView $conversationView)
    {
        //
    }
}
