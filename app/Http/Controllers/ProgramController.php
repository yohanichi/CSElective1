<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of programs.
     */
    public function index()
    {
        $programs = Program::orderBy('code')->get();
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        return view('programs.create');
    }

    /**
     * Store a newly created program.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $request->validate(Program::rules());

        Program::create($request->only(['code', 'title', 'years']));

        return redirect()->route('programs.index')
            ->with('success', 'Program created successfully!');
    }

    /**
     * Display the specified program.
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified program.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $program = Program::findOrFail($id);
        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified program.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $program = Program::findOrFail($id);
        $request->validate(Program::rules($id));

        $program->update($request->only(['code', 'title', 'years']));

        return redirect()->route('programs.index')
            ->with('success', 'Program updated successfully!');
    }

    /**
     * Remove the specified program.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->canManageSubjectsPrograms()) {
            abort(403, 'Unauthorized');
        }
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully!');
    }
}
