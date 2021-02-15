<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DefaultAdminUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // Check for default password, redirect to force change password page...
      if ( (Hash::check('Passw0rd1!', auth()->user()->password)) && ($request->route()->getName() !== 'panel.get.users.edit' && $request->route()->getName() !== 'panel.post.users.update')) {
        //Session::flash('message', 'Default admin user must not have default password!');
        return redirect()->route('panel.get.users.edit', [auth()->user()->id]);
      }

      // Make sure a user doesn't have a password the same as the ENV VAR for ADMIN_USER_PASSWORD
      if (!empty(env('ADMIN_USER_PASSWORD'))) {
        if ( (Hash::check(env('ADMIN_USER_PASSWORD'), auth()->user()->password)) && ($request->route()->getName() !== 'panel.get.users.edit' && $request->route()->getName() !== 'panel.post.users.update')) {
          return redirect()->route('panel.get.users.edit', [auth()->user()->id]);
        }
      }

      // Make sure a user doesn't have a password the same as the admin generated password
      try {
        $gitChecksum = \File::get(storage_path('app/generated_admin_password'));
        if (!empty(trim($gitChecksum))) {
          if ( (Hash::check(trim($gitChecksum), auth()->user()->password)) && ($request->route()->getName() !== 'panel.get.users.edit' && $request->route()->getName() !== 'panel.post.users.update')) {
            return redirect()->route('panel.get.users.edit', [auth()->user()->id]);
          }
        }  
      } catch (\Exception $e) {
        // No file found most likely, continue
      }

      return $next($request);
    }
}
