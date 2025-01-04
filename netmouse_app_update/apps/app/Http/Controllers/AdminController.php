<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); 
    
        return view('admin.edit-user', compact('user', 'roles')); // Kirim $user dan $roles ke view
    }
    public function index(Request $request)
{
    if (!$request->user()->hasRole('admin')) {
        abort(403, 'You are not authorized to access this page.');
    }
    $students = \App\Models\User::where('role', 'student')->get();
    $mentors = User::role('mentor')->get();

    return view('admin.index', compact('students', 'mentors'));
}
    public function deleteUser($userId)
{
    $user = User::findOrFail($userId);

    // Pastikan user yang dihapus bukan admin atau mentor dengan role 'admin'
    if ($user->hasRole('admin')) {
        return redirect()->route('admin_index')->with('error', 'Tidak dapat menghapus admin');
    }

    $user->delete();

    return redirect()->route('admin_index')->with('success', 'User deleted successfully');
}
public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id], // Unique, kecuali user ini sendiri
        'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Password opsional saat update
        'role' => ['required', 'exists:roles,name'] // Validasi role
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Update password jika diisi
    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    // Update role (jika diubah)
    $user->syncRoles([$request->role]);

    return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');
}public function registerMentor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('mentor');

        return back()->with('success', 'Mentor registered successfully!');
    }


}
