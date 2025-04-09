<?php

namespace App\Http\Controllers;

use App\Models\Statue;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{   //private function isAdminByEmail($email)
    //{
    //    return Auth::check() && Auth::user()->email === $email;
    //}
    
  //  private function isAdmin()
  //  {
  //      return Auth::check() && Auth::user()->role === 'admin';
  //  }
    public function adminIndex()
    {
    //    if (!$this->isAdmin()) {
    //        abort(403, 'Недостаточно полномочий для доступа к этой странице.');
    //    }
    //if (!$this->isAdminByEmail('admin@example.com')) {
    //   abort(403, 'Недостаточно полномочий для доступа к этой странице.');
    //}
        $reports = Report::paginate(10);
        $statues = Statue::all();

        return view('admin', compact('reports', 'statues'));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->statues_id = $request->input('status_id');
        $report->save();

        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'statues_id' => 'required|exists:statues,id',
        ]);

        $report = Report::findOrFail($id);
        $report->statues_id = $request->statues_id;
        $report->save();

        return redirect()->route('admin.index')->with('success', 'Статус обновлён успешно!');
    }



    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->paginate(10);
        return view('welcome', ['reports' => $reports]);
    }

    public function create()
    {
        // $services = Service::all();
        $statues = Statue::all();

        return view('request', compact('statues')); //('services', 'statues')); 
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            '' => 'required|string|max:255',
            //   'service_id' => 'required|exists:services,id',
        ]);



        Report::create([
            '' => $data[''],
            //'service_id' => $data['service_id'],
            'statues_id' => 1,
            'user_id' => Auth::id(),
        ]);

        Log::info('Report created successfully.');

        return redirect('/')->with('message', 'Создание заявки успешно!');
    }
}
