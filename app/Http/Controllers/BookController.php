<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller{
   
    public function index(Request $request){
    
        if(isset($request->author_id) && $request->author_id !== 0)
        $Books = \App\Models\Book::where('author_id', $request->author_id)->orderBy('title')->get();
    else
        $Books = \App\Models\Book::orderBy('title')->get();
    $Authors = \App\Models\Author::orderBy('name')->get();
    return view('books.index', ['books' => $Books, 'authors' => $Authors]);}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = \App\Models\Author::orderBy('name')->get();
        return view('books.create', ['authors' => $authors]);
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
            
            'title' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:100',
            'pages' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:150',
            'isbn' => 'required',
            'description' => 'required',
            'author_id' => 'required'
        ];

        $this->validate($request, $rules);

        $book = new Book();
     
        $book->fill($request->all());
        $book->save();
       
        return ($book->save() == 1) ?
        redirect('/book')->with('status_success', 'Knyga sukurta!') :
         redirect('/book')->with('status_error', 'Knyga sukurta!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

        

        $authors = \App\Models\Author::orderBy('name')->get();
        return view('books.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->fill($request->all());
        $book->save();
        
        return ($book->save() !== 1) ?
        redirect('/book/' )->with('status_success', 'Knyga atnaujinta!') :
        redirect('/book/' )->with('status_error', 'Knyga nebuvo atnaujinta!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/book')->with('status_success', 'Knyga ištrinta!');
    }
}
