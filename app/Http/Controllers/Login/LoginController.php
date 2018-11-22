<?php
namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TeacherDatabase;

class LoginController  extends Controller
{
    /**查询用户的账号和密码是否输入有误
     * @param Request $request
     * @return string
     */
    public function selectUserLogin(Request $request)
    {
        $usercount     = trim($request->usercount);
        $userpassword  = trim($request->userpassword);
        return TeacherDatabase::selectLogin($usercount,$userpassword);
    }

    /**用户退出登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function leaveLogin()
    {
        TeacherDatabase::emptyAccount();
        return redirect('/');
    }
}
