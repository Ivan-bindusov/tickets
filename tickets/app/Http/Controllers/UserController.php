<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketsRequest;
use App\Repositories\Interfaces\TicketsRepositoryInterface;
use App\Repositories\TicketsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends BaseController
{
    /**
     * UserController constructor.
     */
    public function __construct(){
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TicketsRepositoryInterface $ticketsRepository)
    {
        $user = Auth::user();
        if($user) {
            if($user->isAdmin()){
                $tickets = $ticketsRepository->all();
            }else{
                $tickets = $ticketsRepository->getByUser($user);
            }
            return view('layouts.tickets.tickets-list', ['tickets' => $tickets]);
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.tickets.ticket-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketsRequest $request, TicketsRepositoryInterface $ticketsRepository)
    {
        $user = Auth::user();
        $data = $request->except(['_token']);
        if($id = $ticketsRepository->save($data, $user)) {
            return redirect()->route('ticket.show', $id)->with(['success' => 'Тикет сохранен']);
        }else{
            return back()->withErrors(['message' => 'Произошла ошибка']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TicketsRepositoryInterface $ticketRepository, $id)
    {
        $ticket = $ticketRepository->getById($id);
        return view('layouts.tickets.ticket', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketsRepository $ticketsRepository, $id)
    {
        $ticket = $ticketsRepository->getById($id);
        if(Gate::allows('update-ticket', $ticket)) {
            return view('layouts.tickets.ticket-edit', ['ticket' => $ticket]);
        }else{
            return back()->withErrors(['message' => 'Ошибка доступа']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketsRequest $request, TicketsRepositoryInterface $ticketRepository, $id)
    {
        $data = $request->except(['_token', '_method']);
        $ticket = $ticketRepository->getById($id);
        if(Gate::allows('update-ticket', $ticket)) {
            $ticket->title = $data['title'];
            $ticket->content = $data['content'];
            $ticket->published = isset($data['published']) ? 'yes' : 'no';
            if($ticket->save()) {
                return back()->with(['success' => 'Изменения сохранены']);
            }
        }else{
            return back()->withErrors(['message' => 'Ошибка доступа']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketsRepositoryInterface $ticketsRepository, $id)
    {
        $ticket = $ticketsRepository->getById($id);
        if(Gate::allows('destroy-ticket', $ticket)) {
            if($ticketsRepository->delete($ticket)) {
                return redirect()->route('ticket.index')->with(['success' => 'Тикет удален']);
            }else{
                return back()->withError(['message' => 'Ошибка']);
            }
        }else{
            return back()->withError(['message' => 'Ошибка доступа']);
        }
    }
}
