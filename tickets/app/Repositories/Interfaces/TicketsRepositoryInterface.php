<?php
namespace App\Repositories\Interfaces;

use App\User;

interface TicketsRepositoryInterface
{
    public function all();

    public function getByUser(User $user);

    public function getByID($id);
}
