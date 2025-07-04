<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public function render()
    {
        return auth()->guard('admin')->check()
            ? view('layouts.admin.app')
            : view('layouts.user.app');
    }
}
