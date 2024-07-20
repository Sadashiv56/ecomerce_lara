<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return datatables()
                ->of($data)
                ->addColumn("action", function (User $data) {
                    $edit = route("users.edit", $data->id);
                    $deleteLink = route("users.destroy", $data->id);
                    $btn = '<a href="' . $edit . '" class="edit btn btn-danger btn-sm">Edit</a>';
                    $btn .= '<form action="' . $deleteLink . '" method="POST" style="display:inline-block;" class="delete-form">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-primary btn-sm delete-button">Delete</button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(["action"])
                ->make(true);
        }
        return view('users.index');
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'required|digits_between:10,15',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }


    public function edit($id): View
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required',
            'password' => 'same:confirm-password',
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        return redirect()->route('users.index')
            ->with('info', 'User updated successfully');
    }
    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    /*public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('error','User deleted successfully');
    }*/
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('error', 'User deleted successfully');
    }
}
