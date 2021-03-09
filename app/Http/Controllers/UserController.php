<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     *
     * @return Response|View
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param UserRequest $request
     * @return Response|RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['profile_photo_path'] = $request->file('profile_photo')->store('assets/users', 'public');

        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return Response|View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return Response|View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return Response|RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->file('picturePath')) {
            $data['picturePath'] = $request->file('picturePath')->store('assets/users', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
