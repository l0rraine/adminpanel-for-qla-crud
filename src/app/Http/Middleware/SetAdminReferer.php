<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 17-11-1
 * Time: 上午9:22
 */

namespace Qla\AdminPanel\app\Http\Middleware;


use Closure;

/**
 * 访问admin节点下连接时，session失效重登录后一律重定向至admin_home
 * @package App\Http\Middleware
 */
class SetAdminReferer
{
    /**
     * Handle an incoming request.
     *q
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixedqla.base
     */
    public function handle($request, Closure $next)
    {
        if (str_contains(session('url.intended'), '/' . config('qla.adminpanel.route_prefix', 'admin') . '/')) {
            $request->headers->set('referer', \URL::route('Crud.AdminPanel.home'));
            session(['url.intended' => \URL::route('Crud.AdminPanel.home')]);
        }

        return $next($request);

    }
}