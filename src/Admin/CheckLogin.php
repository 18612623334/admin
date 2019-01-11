<?php
namespace App\Http\Middleware;

use App\Models\Admin\AuthAdmin;
use Closure;

class CheckLogin{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = session('id');
        $username = session('username');

        $path = $request->path();

        if(!($id) || !$username){
            if(!($path=="login"||$path=="login/index"||$path=="login/login"||$path=="/")){
                return redirect()->route('login.index');
            }
        }

        if ($id && $username) {
            $result = AuthAdmin::checkAdminRule($id,$path);

            if (!$result) {
                if ($request->ajax()) {
                    $res = array('status' => 0, 'msg' => '权限不够');
                    return response()->json($res);
                } else {
                    return response()->view('Admin.Index.authError');
                }
            }
        }
        return  $next($request);
    }
}
