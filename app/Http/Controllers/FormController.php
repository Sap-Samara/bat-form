<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_name' => 'required|string|max:255',
            'label.*' => 'required|string|max:255',
            'name.*' => 'required|string|max:255',
            'type.*' => 'required|string|in:text,email,password,textarea,select,radio,checkbox,hidden',
            'value.*' => 'nullable|string',
            'required.*' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save form
        $form = Form::create(['name' => $request->form_name]);

        // Save fields
        foreach ($request->label as $index => $label) {
            FormField::create([
                'form_id' => $form->id,
                'label' => $label,
                'name' => $request->name[$index],
                'type' => $request->type[$index],
                'values' => $request->value[$index] ?? null,
                'required' => $request->required[$index] ?? false,
            ]);
        }

        return redirect()->route('forms.index')->with('success', 'Form created successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $forms = Form::paginate(10); // Adjust the number per page as needed
        return view('forms.index', compact('forms'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Form deleted successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\View\View
     */
    public function show(Form $form)
    {
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for adding child forms.
     *
     * @param \App\Models\Form $form
     * @return \Illuminate\View\View
     */
    public function addChild(Form $form)
{
    // Fetch fields related to the form
    $fields = FormField::where('form_id', $form->id)->get();

    // Fetch all forms if you need to display them in a dropdown or for some other purpose
    $forms = Form::all();

    return view('forms.add_child', compact('form', 'fields', 'forms'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $formId
     * @return \Illuminate\View\View
     */
    public function edit($formId)
    {
        $form = Form::findOrFail($formId);
        $fields = FormField::where('form_id', $formId)->get();

        return view('forms.edit', compact('form', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Form $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Form $form)
    {
        $validator = Validator::make($request->all(), [
            'form_name' => 'required|string|max:255',
            'label.*' => 'required|string|max:255',
            'name.*' => 'required|string|max:255',
            'type.*' => 'required|string|in:text,email,password,textarea,select,radio,checkbox,hidden',
            'value.*' => 'nullable|string',
            'required.*' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update form name
        $form->update(['name' => $request->form_name]);

        // Delete old fields
        $form->fields()->delete();

        // Save new fields
        foreach ($request->label as $index => $label) {
            FormField::create([
                'form_id' => $form->id,
                'label' => $label,
                'name' => $request->name[$index],
                'type' => $request->type[$index],
                'values' => $request->value[$index] ?? null,
                'required' => $request->required[$index] ?? false,
            ]);
        }

        return redirect()->route('forms.index')->with('success', 'Form updated successfully!');
    }
}
