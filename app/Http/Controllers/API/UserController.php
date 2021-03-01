<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use PasswordValidationRules;

    /**
     * Login api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $credentials = $request->only(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error($credentials, 'Authentication Failed', 500);
            }

            $user = User::where('email', $credentials['email'])->first();
            if (!Hash::check($credentials['password'], $user->password)) {
                throw new Exception('Invalid Credentials');
            }

            $token = $user->createToken('authToken')->plainText;

            return ResponseFormatter::success([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (Exception $exception) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $exception
            ], 'Authentication Failed', $exception->getMessage() == 'Invalid Credential' ? 401 : 500);
        }
    }

    /**
     * Register api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:100', 'unique:users'],
                'password' => $this->passwordRules()
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'phone_number' => $request->phone_number,
            ]);

            $token = $user->createToken('authToken')->plainText;

            return ResponseFormatter::success([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Registered');
        } catch (Exception $exception) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $exception
            ], 'Register Failed', 500);
        }
    }

    /**
     * Logout api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $result = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success(['status' => $result], 'Token Revoked');
    }

    public function profile(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'User Fetched');
    }

    /**
     * Update profile api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $user->update($request->all());

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    /**
     * Update photo profile api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|max:2048'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'errors' => $validator->errors()
            ], 'Update Photo Failed', 422);
        }

        if ($request->file('file')) {
            $file = $request->file('file')->store('assets/users', 'public');

            $user = $request->user();
            $user->profile_photo_path = $file;
            $user->update();

            return ResponseFormatter::success($file, 'File Successfully Uploaded');
        }

        return ResponseFormatter::error([], 'No File Available', 422);
    }
}
