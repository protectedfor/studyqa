<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedsController extends Controller
{

    /**
     * FeedsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = Feed::orderby('created_at', 'desc')->paginate(5);
        return view('news.index', compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('news.createEdit');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules(), $this->validationMessages());

        Feed::create($request->all());

        return redirect()->route('news.index')->with('success', 'Новость успешно создана!');
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required|max:10000',
            'author' => 'required|max:255'
        ];
    }

    /**
     * @return array
     */
    private function validationMessages()
    {
        return [
            'title.required' => 'Введите заголовок',
            'title.max' => 'Заголовок не может быть длиннее :max символов',
            'body.required' => 'Введите текст новости',
            'body.max' => 'Текст новости не может быть длиннее :max символов',
            'author.required' => 'Введите имя автора',
            'author.max' => 'Имя автора не может быть длиннее :max символов',
        ];
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $feed = Feed::findOrFail($id);
        return view('news.createEdit', compact('feed'));
    }

    public function show(Request $request, $id)
    {
        $feed = Feed::findOrFail($id);
        return view('news.show', compact('feed'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validationRules(), $this->validationMessages());

        $feed = Feed::findOrFail($id);
        $feed->update($request->all());

        return redirect()->route('news.index')->with('success', 'Новость успешно обновлена!');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $feed = Feed::findOrFail($id);
        $feed->delete();
        return back()->with('success', 'Новость успешно удалена!');
    }
}
