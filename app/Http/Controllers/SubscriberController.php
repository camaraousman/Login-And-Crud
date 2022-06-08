<?php

namespace App\Http\Controllers;


use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriberController extends Controller
{
    // set index page view
    public function index() {
        return view('users.admin');
    }

    // handle fetch all subscibers ajax request
    public function fetchAll() {
        $subs = Subscriber::all();
        $output = '';
        if ($subs->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>File</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Number Plate</th>
                <th>Phone</th>
                <th>Kimlik</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($subs as $sub) {
                $output .= '<tr>
                <td>' . $sub->id . '</td>
                <td><img src="storage/images/' . $sub->file . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $sub->first_name . ' ' . $sub->last_name . '</td>
                <td>' . $sub->email . '</td>
                <td>' . $sub->number_plate . '</td>
                <td>' . $sub->phone . '</td>
                <td>' . $sub->kimlik . '</td> 
                <td>' . $sub->address . '</td>
                <td>
                  <a href="#" id="' . $sub->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSubscriberModal"><i class="bi-pencil-square h4"></i></a>
   
                  <a href="#" id="' . $sub->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new subscriber ajax request
    public function store(Request $request) {

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $subData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'number_plate' => $request->number_plate, 'kimlik' => $request->kimlik, 'address' => $request->address, 'file' => $fileName];
        Subscriber::create($subData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an subscriber ajax request
    public function edit(Request $request) {
        $id = $request->id;
        $sub = Subscriber::find($id);
        return response()->json($sub);
    }

    // handle update an subscriber ajax request
    public function update(Request $request) {
        $fileName = '';
        $sub = Subscriber::find($request->sub_id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($sub->file) {
                Storage::delete('public/images/' . $sub->file);
            }
        } else {
            $fileName = $request->sub_file;
        }

        $subData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'number_plate' => $request->number_plate, 'kimlik' => $request->kimlik, 'address' => $request->address, 'file' => $fileName];

        $sub->update($subData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Subscriber ajax request
    public function delete(Request $request) {
        $id = $request->id;
        $sub = Subscriber::find($id);
        if (Storage::delete('public/images/' . $sub->file)) {
            Subscriber::destroy($id);
        }
    }
}
