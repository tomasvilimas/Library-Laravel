<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->id) && $request->id !== 0)
            $Authors = \App\Models\Author::where('id', $request->id)->orderBy('name')->get();
        else
            $Authors = \App\Models\Author::orderBy('name')->get();
        $Books = \App\Models\Book::orderBy('title')->get();
        return view('authors.index', ['authors' => $Authors, 'books' => $Books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:100',
            'surname' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:150',

        ];

        $this->validate($request, $rules);


        $author = new Author();
        $author->fill($request->all());


        $author->save();
        return ($author->save() == 1) ?
            redirect('/author')->with('status_success', 'Autorius sukurtas!') :
            redirect('/author')->with('status_error', 'Autorius nesukurtas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $author->fill($request->all());
        $author->save();

        return ($author->save() !== 1) ?
            redirect('/author/')->with('status_success', 'Autorius atnaujintas!') :
            redirect('/author/')->with('status_error', 'Autorius nebuvo atnaujintas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/author')->with('status_success', 'Autorius ištrintas!');
    }
}
