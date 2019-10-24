<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Winner;
use App\User;

class HomeController extends Controller
{
    public function winner()
    {
        $winnerList = Winner::leftJoin('users as u', 'u.id', '=', 'winners.user_id')
                        ->select('u.name', 'winners.winning_number', 'winners.prize_type')
                        ->orderBy('winners.prize_type', 'desc')
                        ->get();

        return view('winner', compact('winnerList'));
    }
}
