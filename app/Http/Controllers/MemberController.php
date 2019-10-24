<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\PurchaseNumber;
use Faker;


class MemberController extends Controller
{
    // all lucky numbers are unique per user.
    public function index() {
        return view('member');
    }

    public function purchase_number(Request $request) {

        $generate_member = $request->get('generate_member');
        $member_name = $request->get('member_name');
        $lucky_number = $request->get('lucky_number');

        // All lucky numbers are unique per users.
        if (PurchaseNumber::where('purchase_number', $lucky_number)->exists()) {
            return redirect()->back()->withInput()->withFail('Lucky number '.$lucky_number.' is not available anymore.');
        }

        // Random generate member.
        if ($generate_member == '1') {
            $faker = Faker\Factory::create();
            $member_name = $faker->lastName;

            // All lucky numbers are unique per users.
            if (User::where('name', $member_name)->exists()) {
                return redirect()->back()->withInput()->withFail('This member '.$lucky_number.' has been created already.');
            }

            // Register user.
            $user = User::create([
                'name' => $member_name,
                'email' => $member_name.'@test.com',
                'password' => Hash::make('abcd1234')
            ]);
            $user_id = $user->id;
        } else {
            // Get exist user id else create one.
            $matchThese = array('name' => $member_name);
            $user = User::updateOrCreate($matchThese, ['email' => $member_name.'@test.com', 'password' => Hash::make('abcd1234')]);
            $user_id = $user->id;
        }

        // Insert new purchase number.
        PurchaseNumber::create([
            'user_id' => $user_id,
            'purchase_number' => $lucky_number
        ]);

        return redirect()->back()->withSuccess($member_name.' sucessfully purchase lucky number '.$lucky_number);
    }
}
