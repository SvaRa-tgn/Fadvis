<?php

namespace App\Http\Controllers\WEB\Index;

use App\Actions\IndexAction;
use App\Http\Controllers\Controller;
use App\Interfaces\IUserRepository;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __construct(
        private readonly IUserRepository $userRepository,
    )
    {
    }

    public function index(IndexAction $action): View
    {
        return $action->execute();
    }

    public function check(): View
    {
        /**$string = '123123123';
        $this->userRepository->update(
            new UpdateUserDTO(
                user: User::find(5),
                password: $string,
            ),
        );**/

        return view('auth.passwords.reset')->with(
            ['token' => 'token', 'email' => 'mmm']);
    }
}
