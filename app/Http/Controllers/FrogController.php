<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frog;

class FrogController extends Controller
{
    public function index()
    {
        $frogs = auth()->user()->frogs;
 
        return response()->json([
            'success' => true,
            'data' => $frogs
        ]);
    }
 
    public function show($id)
    {
        $frog = auth()->user()->frogs()->find($id);
 
        if (!$frog) {
            return response()->json([
                'success' => false,
                'message' => 'Frog not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $frog->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
 
        $frog = new Frog();
        $frog->name = $request->name;
 
        if (auth()->user()->frogs()->save($frog)) {
            return response()->json([
                'success' => true,
                'data' => $frog->toArray()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'frog not added'
            ], 500);
        }
    }
 
    public function update(Request $request, $id)
    {
        $post = auth()->user()->frogs()->find($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }
 
        $updated = $post->fill($request->all())->save();
 
        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
        }
    }
 
    public function destroy($id)
    {
        $post = auth()->user()->frogs()->find($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }
 
        if ($post->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post can not be deleted'
            ], 500);
        }
    }
}
