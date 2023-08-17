<?php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Http\Client\ConnectionException;

    if(!function_exists('isActiveMenu')) {
        function isActiveMenu($param_array) {
            $isActive = false;
            if(COUNT($param_array) > 0) {
                // check if we are on the active route
                foreach ($param_array as $key => $v) {
                    // 'users', 'users/create', 'users/*/edit'
                    if ( request()->is($v, $v.'/create', $v.'/*/edit') ) {
                        $isActive = true;
                    }
                }
                return $isActive;
            }
            return $isActive;
        }
    }
?>