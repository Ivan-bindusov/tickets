<?php

use Illuminate\Database\Seeder;
use App\Ticket;
use App\User;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all()->last();

        $ticket = new Ticket();
        $ticket->title = 'Ticket 4';
        $ticket->content = 'Content ticket 4';
        $ticket->user_id = $user->id;
        $ticket->save();

        /*$i = 3;
        foreach($users as $user) {
            $ticket = new Ticket();
            $ticket->title = 'Ticket ' . $i;
            $ticket->content = 'Content ticket ' . $i;
            $ticket->user_id = $user->first()->id;
            $ticket->save();
            $i++;
        }*/
    }
}
