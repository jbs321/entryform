<?php

namespace App\Http\Controllers;

use App\Carving;
use App\Summernote;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        $users = User::all()->sortBy(['fname'])->map(function(User $user) {
            /** @var Carbon $pst */
            $pst =  Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at, 'UTC');
            $pst->setTimezone('America/Los_Angeles');
            $user->pst = $pst->toDateTimeString();
            return $user;
        });

        $carvings = Carving::select('carvings.*')
            ->join('users', 'carvings.user_id', '=', 'users.id')
            ->orderBy('users.fname')
            ->get();

        $categories = CarvingController::CATEGORIES;

        return view('admin', compact('carvings', 'users', 'categories'));
    }

    public function saveNote(Request $request)
    {
        $this->validate($request, [
            'note' => 'required',
        ]);
        $note = $request->input('note');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($note, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $note = $dom->saveHTML();
        $summerNote = new Summernote;
        $summerNote->content = $note;
        $summerNote->save();

        return redirect('home');
    }
}
