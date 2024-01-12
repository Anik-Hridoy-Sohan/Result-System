<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProgramRequest;

class ProgramController extends Controller
{
    public function store(ProgramRequest $request)
    {
        Program::create(
            [
                'name' => $request['name'],
                'slug' => $request['slug'],
            ]
        );
        return response()->json(['message' => 'Successfully created'], 204);
    }

    public function edit(ProgramRequest $request, $id)
    {
        $program = Program::findOrFail($id);
        $program->name = $request['name'];
        $program->slug = $request['slug'];
        $program->save();
        return response()->json(['message' => 'Successfully edited'], 200);
    }

    public function delete($id)
    {
        if (Role::findOrFail(Auth::user()->role_id)->slug == 'master') {
            $program = Program::findOfFail($id);
            $program->delete();
            return response()->json(['message' => 'Successfully deleted']);
        }
        return response()->json(['message' => 'Permission not granted'], 400);
    }

    public function getPrograms()
    {
        return response()->json(['data' => Program::all()], 200);
    }
}
