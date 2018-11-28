<?php

namespace App\Http\Controllers;

use App\Models\HomeText;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeText = HomeText::first();
        return view('home', compact('homeText'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateHomeText(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|max:20000'
        ], [
            'text.required' => 'Пожалуйста введите текст',
            'text.max' => 'Длина текста не может быть длиннее :max символов'
        ]);

        HomeText::updateOrCreate([
            'id' => 1
        ], [
            'text' => $request->get('text')
        ]);

        return back()->with('success', 'Текст успешно обновлен!');

    }
}
