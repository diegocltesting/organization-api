<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Division::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:divisions,name|max:45',
            'ambassador' => 'present',
            'collaborators' => 'required|integer|gt:0',
            'level' => 'required|integer|gt:0',
            'parent_id' => 'required|integer|gte:0|exclude_if:parent_id,0|exists:divisions,id'
        ]);

        $newDivision = new Division([
            'name' => $request->input('name'),
            'ambassador' => $request->input('ambassador'),
            'collaborators' => $request->input('collaborators'),
            'level' => $request->input('level'),
            'parent_id' => $request->input('parent_id'),
        ]);

        $newDivision->save();

        return $newDivision;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        return $division->where('id', $division->id)->with('children')->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required|integer|gt:0|exists:divisions,id',
            'name' => 'required|unique:divisions,name|max:45',
            'ambassador' => 'present',
            'collaborators' => 'required|integer|gt:0',
            'level' => 'required|integer|gt:0',
            'parent_id' => 'required|integer|gte:0|exclude_if:parent_id,0|exists:divisions,id'
        ]);

        $division = Division::findOrFail($id);
        $division->name = $request->input('name');
        $division->ambassador = $request->input('ambassador');
        $division->collaborators = $request->input('collaborators');
        $division->level = $request->input('level');
        $division->parent_id = $request->input('parent_id');

        $division->save();
        return $division;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        return response()->json(['message' => 'Student deleted successfully.']);
    }

    public function subDivisions($id)
    {
        return Division::with('children')->where('parent_id', $id)->get();
    }
}
