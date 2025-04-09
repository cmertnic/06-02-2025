<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class ReportController extends Controller
{
    private function isAdminByEmail($email)
    {
        return Auth::check() && Auth::user()->email === $email;
    }

    public function adminIndex()
    {
        if (!$this->isAdminByEmail('admin@mail.com')) {
            abort(403, 'Недостаточно полномочий для доступа к этой странице.');
        }
        $reports = Report::paginate(10);
        $sections = Section::all();

        return view('admin', compact('reports', 'sections'));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->section_id = $request->input('section_id');
        $report->save();

        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
        ]);

        $report = Report::findOrFail($id);
        $report->section_id = $request->section_id;
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

        $sections = Section::all();

        return view('request', compact('sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'fullname' => 'required|string|max:255',
            'path_img' => 'image|mimes:png,jpg,jpeg,gif|max:800',
            'theme' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
        ]);
        $imageName = Storage::disk('public')->put('/requets', $request->file('path_img'));
        $imageName = time() . '.' . $request['path_img']->extension();
        $request['path_img']->move(public_path('storage'), $imageName);



        Report::create([
            'fullname' => $data['fullname'],
            'path_img' => $imageName,
            'theme' => $data['theme'],
            'section_id' => $data['section_id'],
            'user_id' => Auth::id(),
        ]);

        Log::info('Report created successfully.');

        return redirect('/')->with('message', 'Создание заявки успешно!');
    }
}
