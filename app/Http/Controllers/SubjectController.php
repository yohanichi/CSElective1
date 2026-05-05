<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of subjects.
     */
    public function index()
    {
        $subjects = Subject::orderBy('code')->get();
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new subject.
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        return view('subjects.create');
    }

    /**
     * Store a newly created subject.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $request->validate(Subject::rules());

        Subject::create($request->only(['code', 'title', 'unit']));

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully!');
    }

    /**
     * Display the specified subject.
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified subject.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified subject.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $subject = Subject::findOrFail($id);
        $request->validate(Subject::rules($id));

        $subject->update($request->only(['code', 'title', 'unit']));

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully!');
    }

    /**
     * Remove the specified subject.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully!');
    }
}
