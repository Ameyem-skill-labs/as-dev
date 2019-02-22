<?php

namespace App\Http\Controllers;
use App\Subjects;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('Subject.index');
    }
    
    public function create()
    {
        return view('Subject.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'subject' => 'required',
            ]);


        Subjects::create($request->all());
        return redirect()->route('AdminTasks.index')
                        ->with('success','Subject created successfully');
    }



}
