<?php
namespace App\Http\Controllers\Define;


class DefineRoleController
{
    const TEACHER             = 0;      //普通老师
    const PRESIDENT           = 1;      //院长
    const VICE_PRESIDENT      = 2;      //副院长
    const TEACH_SECRETARY     = 3;      //教学秘书
    const RESEARCH_SECRETARY  = 4;      //科研秘书
    const GRADUATE_SECRETARY  = 5;      //研究生秘书
    const DEPUTY_DIRECTOR     = 6;      //副主任
    const DEPARTMENT_HEAD     = 7;      //系主任
    const OFFICE_DIRECTOR     = 8;      //办公室主任
    const TEACH_RESEARCH_HEAD = 9;      //教研室主任
}