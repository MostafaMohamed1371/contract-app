<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $users = User::orderBy('id')->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('users.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,user'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    public function edit(User $user)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // prevent admin from demoting themselves accidentally
        if ($user->id === auth()->id() && $data['role'] !== 'admin') {
            return back()->withErrors(['role' => 'لا يمكنك إزالة صلاحيات المدير عن نفسك.']);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if (! empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    public function destroy(User $user)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'لا يمكنك حذف حسابك الحالي.']);
        }

        // prevent deleting the last admin
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->withErrors(['user' => 'لا يمكن حذف آخر مدير في النظام.']);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}

