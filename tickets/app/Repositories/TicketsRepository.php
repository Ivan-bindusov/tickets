<?php
namespace App\Repositories;

use App\Repositories\Interfaces\TicketsRepositoryInterface;
use App\User;
use App\Ticket;

class TicketsRepository implements TicketsRepositoryInterface
{
    public function all()
    {
        return Ticket::all();
    }

    public function getByUser(User $user)
    {
        return Ticket::where('user_id', $user->id)->get();
    }

    public function getById($id)
    {
        return Ticket::find($id);
    }

    public function save($data, $user)
    {
        $ticket = new Ticket;
        $ticket->title = $data['title'];
        $ticket->content = $data['content'];
        if($user->tickets()->save($ticket)) {
            return $ticket->id;
        }else{
            return 0;
        }
    }

    public function delete($ticket)
    {
        return $ticket->delete();
    }
}
