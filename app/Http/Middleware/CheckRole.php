<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {


        $user = $request->user();
        if (!$user) {
            abort(403, 'User not authenticated.');
        }
        
        if ($user->role->value !== $role) {
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
    
}

