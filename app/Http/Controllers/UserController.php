<?php

namespace App\Http\Controllers;

use App\Exports\CarvingsExports;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('edituser', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        return view('home');
    }

    public function delete(User $user)
    {
        $user->delete();

        return view('admin');
    }

    public function downloadExcel()
    {
        $users = User::all();

        $users = $users->map(function(User $user){
            unset($user->created_at);
            unset($user->updated_at);
            $user->is_admin = ($user->is_admin) ? "Yes" : "No";
            return $user;
        });

        return Excel::download(new CarvingsExports($users, [
            'Id',
            'First Name',
            'Last Name',
            'Address',
            'City',
            'Province',
            'Postal Code',
            'Phone Number',
            'Email',
            'Is Administrator',
        ]), 'users.xlsx');
    }

    public function recordPayment(User $user, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user->recordPayment($request->amount);

        return new JsonResponse("recorded");
    }

    public function viewPayments(User $user)
    {
        return view('payments', ['totalPaid' => $user->payments(), 'payments' => $user->paymentList()]);
    }
}
