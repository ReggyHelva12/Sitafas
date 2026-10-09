<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * =====================================================
     * MENAMPILKAN DAFTAR USER
     * =====================================================
     */
    public function index(Request $request)
    {
        $query = User::query();

        // =========================
        // SEARCH
        // =========================
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('username', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');

            });
        }


        // =========================
        // FILTER ROLE
        // =========================
        if ($request->filled('role')) {

            $query->where(
                'role',
                $request->role
            );
        }


        // =========================
        // FILTER STATUS
        // =========================
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        // =========================
        // DATA USER
        // =========================
        $users = $query
            ->orderBy('id_user', 'desc')
            ->paginate(10)
            ->withQueryString();


        return view(
            'pages.User.index',
            compact('users')
        );
    }


    /**
     * =====================================================
     * FORM TAMBAH USER
     * =====================================================
     */
    public function create()
    {
        return view('pages.User.create');
    }


    /**
     * =====================================================
     * SIMPAN USER BARU
     * =====================================================
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:100',
        'username' => 'required|string|max:50|unique:users,username',
        'email' => 'required|email|max:100',
        'role' => 'required|in:admin,petugas',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = new User();

    $user->nama = $validated['nama'];
    $user->username = $validated['username'];
    $user->email = $validated['email'];
    $user->role = 'admin';
    $user->password = Hash::make($validated['password']);
    $user->status = 'aktif';

    $user->save();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User berhasil ditambahkan!');
}

    /**
     * =====================================================
     * FORM EDIT USER
     * =====================================================
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view(
            'pages.User.edit',
            compact('user')
        );
    }


    /**
     * =====================================================
     * UPDATE USER
     * =====================================================
     */
    public function update(
        Request $request,
        $id
    ) {

        $user = User::findOrFail($id);


        // =========================
        // VALIDASI
        // =========================
        $validated = $request->validate([

            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')
                    ->ignore($user->id_user, 'id_user')
            ],

            'nama' => [
                'required',
                'string',
                'max:100'
            ],

            'email' => [
                'nullable',
                'email',
                'max:100'
            ],

            'status' => [
                'nullable',
                Rule::in([
                    'aktif',
                    'nonaktif'
                ])
            ],

        ]);


        // =========================
        // UPDATE DATA
        // =========================
        $user->username =
            $validated['username'];

        $user->nama =
            $validated['nama'];

        $user->email =
            $validated['email'] ?? null;

        // ROLE SELALU ADMIN
        $user->role = 'admin';


        // Status hanya diubah jika
        // dikirim dari form edit
        if (
            isset($validated['status'])
        ) {

            $user->status =
                $validated['status'];

        }


        // =========================
        // UPDATE PASSWORD
        // =========================
        if ($request->filled('password')) {

            $request->validate([

                'password' => [
                    'string',
                    'min:6',
                    'confirmed'
                ]

            ]);


            $user->password =
                Hash::make(
                    $request->password
                );
        }


        // =========================
        // SIMPAN
        // =========================
        $user->save();


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Data user berhasil diperbarui.'
            );
    }


    /**
     * =====================================================
     * AKTIF / NONAKTIF USER
     * =====================================================
     */
    public function toggle($id)
    {
        $user = User::findOrFail($id);


        // =========================
        // CEK AKUN SENDIRI
        // =========================
        if (
            Auth::check() &&
            Auth::id() == $user->id_user
        ) {

            return back()
                ->with(
                    'error',
                    'Anda tidak dapat menonaktifkan akun sendiri.'
                );
        }


        // =========================
        // UBAH STATUS
        // =========================
        if ($user->status === 'aktif') {

            $user->status = 'nonaktif';

        } else {

            $user->status = 'aktif';

        }


        $user->save();


        return back()
            ->with(
                'success',
                'Status user berhasil diperbarui.'
            );
    }


    /**
     * =====================================================
     * HAPUS USER
     * =====================================================
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);


        // =========================
        // CEK AKUN SENDIRI
        // =========================
        if (
            Auth::check() &&
            Auth::id() == $user->id_user
        ) {

            return back()
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun sendiri.'
                );
        }


        // =========================
        // HAPUS USER
        // =========================
        $user->delete();


        return back()
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }


}