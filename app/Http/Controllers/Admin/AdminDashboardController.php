<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tryout;
use App\Models\Question;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalQuestions = Question::count();
        $totalTryouts = Tryout::count();

        return view(
            "admin.dashboard",
            compact("totalUsers", "totalQuestions", "totalTryouts"),
        );
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view("admin.users", compact("users"));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            "role" => "require|in:user,admin",
        ]);

        $user->update([
            "role" => $request->role,
        ]);

        return back() - with("Sukses");
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with("error,you cannot delete Yourself");
        }

        $user->delete();
        return back()->with("Success", "User Deleted succesfully");
    }

    public function trash()
    {
        $users = User::onlyTrashed()->latest()->paginate(10);

        return view("admin.users-trash", compact("users"));
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->forceDelete();

        return redirect()
            ->route("admin.users.trash")
            ->with("success", "User dihapus permanen.");
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->restore();

        return redirect()
            ->route("admin.users.trash")
            ->with("success", "User berhasil direstore.");
    }
}
