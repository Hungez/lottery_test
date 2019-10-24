<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseNumber;
use App\Winner;
use DB;

class AdminController extends Controller

{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function draw(Request $request) {

        $prize_type = $request->get('prize_type');
        $generate_type = $request->get('generate_type');
        $winning_number = $request->get('winning_number');

        // Random generate.
        if ($generate_type == '1') {
            // 6 is Grand prize.
            if ($prize_type == '6') {
                // Get total entries by user.
                $entries = PurchaseNumber::select('user_id', DB::raw('COUNT(user_id) as total_entries'))->groupBy('user_id')->get();
                $max_entries = $entries->where('total_entries', $entries->max('total_entries'))->first();
                $selected_user = PurchaseNumber::inRandomOrder()->select('purchase_number','user_id')->where('user_id', $max_entries->user_id)->first();
            } else {
                // Get random user haven't win the game.
                $selected_user = PurchaseNumber::leftJoin('winners as w', 'w.user_id', '=', 'purchase_numbers.user_id')
                        ->inRandomOrder()
                        ->select('purchase_numbers.user_id', 'purchase_numbers.purchase_number')
                        ->whereNull('w.user_id')
                        ->first();
                if (is_null($selected_user)) {
                    return redirect()->back()->withInput()->withFail('All user has got their prize.');
                }
            }

            $winner = $selected_user->user_id;
            $winning_number = $selected_user->purchase_number;

        } else {
            // Manually define.
            $winner = PurchaseNumber::where('purchase_number', $winning_number)->select('user_id')->first();
            if (is_null($winner)) {
                return redirect()->back()->withInput()->withFail('No winner for '.$winning_number.' number.');
            }
            $winner = $winner->user_id;
        }

        // If the prize won by user already.
        if (Winner::where('prize_type', $prize_type)->exists()) {
            return redirect()->back()->withInput()->withFail('Selected prize is not available anymore.');
        }

        // If user won the prize before.
        if (Winner::where('user_id', $winner)->exists()) {
            return redirect()->back()->withInput()->withFail('Winner for '.$winning_number.' already won a prize before.');
        }

        // Set price to winner.
        $new_winner = new Winner;
        $new_winner->user_id = $winner;
        $new_winner->winning_number = $winning_number;
        $new_winner->prize_type = $prize_type;
        $new_winner->save();

        return redirect()->back()->withSuccess('Successfully set the prize to winner.');
    }
}
