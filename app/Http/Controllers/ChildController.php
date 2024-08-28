<?php

// app/Http/Controllers/ChildController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child; // Ganti dengan model yang sesuai

class ChildController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data jika diperlukan
        $validated = $request->validate([
            'parent_form_id' => 'required|integer|exists:forms,id',
            // Validasi untuk field lainnya jika diperlukan
        ]);

        // Simpan data ke database
        $child = new Child();
        $child->parent_form_id = $request->parent_form_id;
        // Set field lainnya sesuai dengan data yang diterima
        $child->save();

        // Redirect atau beri response
        return redirect()->back()->with('success', 'Child data saved successfully!');
    }
}

