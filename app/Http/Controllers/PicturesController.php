<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;

class PicturesController extends Controller
{

    /**
     * FeedsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $pictures = Picture::orderBy('created_at', 'desc')->get();
        return view('pictures.index', compact('pictures'));
    }

    public function store(Request $request)
    {
        $path = $request->image->store('images', 'public');
        Picture::create([
            'image' => $path
        ]);
        return $path;
    }

    public function destroy(Request $request, $id)
    {
        $picture = Picture::findOrFail($id);
        $picture->delete();
        return back()->with('success', 'Изображение успешно удалено!');
    }
}
