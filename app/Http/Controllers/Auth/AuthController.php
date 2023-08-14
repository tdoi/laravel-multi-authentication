<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private ?string $role;
    private string $package;

    public function __construct() {
        $this->role = detect_role();
        $this->package = empty($this->role) ? '' : Str::camel($this->role);
    }

    public function route($route): string
    {
        if (empty($this->role)) {
            return $route;
        }
        return $this->role . '.' . $route;
    }

    public function resource($path): string
    {
        if (empty($this->role)) {
            return $path;
        }
        return $this->package . '/' . $path;
    }

    public function modelName() {
        if (empty($this->role)) {
            return User::class;
        }
        return '\\App\\Models\\' . $this->package;
    }

    public function user(Request $request) {
        return $request->user($this->role);
    }
}
