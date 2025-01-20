<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    // Tampilkan halaman daftar user
    public function index()
    {
        $users = User::where('status', 'PENDING')->get();
        return view('admin.user_approval', compact('users'));
    }

    // Approve user
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'APPROVE';
        $user->save();

        return redirect()->back()->with('success', 'User has been approved.');
    }

    // Reject user
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'REJECT';
        $user->save();

        return redirect()->back()->with('success', 'User has been rejected.');
    }
}
