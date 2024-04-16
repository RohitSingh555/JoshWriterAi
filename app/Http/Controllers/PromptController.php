<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function prompt_index()
    {
        $prompts = Prompt::all();
        return view('admin.prompts.index', compact('prompts'));
    }

    public function prompt_create()
    {
        return view('admin.prompts.create');
    }

    public function prompt_edit(Prompt $prompt)
    {
        return view('admin.prompts.edit', compact('prompt'));
    }

    public function prompt_store(Request $request)
    {
        // Validation logic here

        $request->validate([
            'prompt_type' => 'required|string',
            'request' => 'required|string',

        ]);

        Prompt::create($request->all());

        return redirect()->route('prompts.prompt_index'); // Adjust the route name
    }

    public function prompt_update(Request $request, Prompt $prompt)
    {
        // Validation logic here

        $request->validate([
            'prompt_type' => 'required|string',
            'request' => 'required|string',
        ]);

        $prompt->update($request->all());

        return redirect()->route('prompts.prompt_index'); // Adjust the route name
    }

    public function prompt_destroy(Prompt $prompt)
    {
        $prompt->delete();
        return redirect()->route('prompts.prompt_index'); // Adjust the route name
    }
}
