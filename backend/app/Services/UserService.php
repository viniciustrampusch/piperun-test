<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UnauthorizedException;
use Carbon\Carbon;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAll($data)
    {
        return $this->userRepository->findAll($data['page'] ?? 1, $data['term'] ?? null);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedException('E-mail ou senha inválido');
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return $tokenResult;
    }
}
