<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Show profile page
    public function index()
    {
        return view('profile');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    // Update profile info
    public function update(Request $request)
    {
        // Define a list of inappropriate words (case-insensitive)
        $inappropriateWords = [
            'fuck', 'fucking', 'fucked', 'motherfucker', 'shit', 'bullshit', 'ass', 'asshole', 'bastard', 'bitch', 'bitchy',
            'cock', 'pussy', 'dick', 'cunt', 'slut', 'whore', 'hoe', 'cum', 'jizz', 'dildo', 'anal', 'blowjob', 'handjob', 
            'penis', 'vagina', 'orgasm', 'porn', 'sex', 'suckmydick', 'tits', 'boobs', 'nude', 'naked', 'penis', 'vagina',
            'fag', 'faggot', 'nigger', 'nigga', 'retard', 'retarded', 'idiot', 'dumbass', 'moron', 'loser', 'dummy', 'fool', 
            'jackass', 'twat', 'prick', 'scumbag', 'shithead', 'asswipe', 'douche', 'douchebag', 'cretin', 'kill yourself', 
            'kys', 'kms', 'suicide', 'die', 'die bitch', 'die motherfucker','stupid', 'dumb', 'ugly', 'fat', 'slob', 'weirdo', 
            'loser', 'shitbag', 'fuckface', 'assface', 'damn', 'goddamn', 'hell', 'bastard', 'satan', 'jesusfucker', 'christfucker',
            'arse', 'bollocks', 'bugger', 'wanker', 'twat', 'tosser', 'slag', 'prat', 'numpty', 'pillock'

        ];

        // Custom validation closure
        $containsInappropriate = function ($attribute, $value, $fail) use ($inappropriateWords) {
            if ($value === null) return;
            $lowerValue = strtolower($value);
            foreach ($inappropriateWords as $word) {
                if (str_contains($lowerValue, strtolower($word))) {
                    $fail('Invalid name due to inappropriate, enter another name');
                }
            }
        };

        $user = Auth::user();

        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255', $containsInappropriate],
            'last_name'  => ['nullable', 'string', 'max:255', $containsInappropriate],
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->name       = trim(implode(' ', array_filter([$request->first_name, $request->last_name])));
        $user->email      = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
    
}
