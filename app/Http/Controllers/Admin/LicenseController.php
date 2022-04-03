<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Artisan;
use Auth;
use Redirect;
use LicenseBoxAPI;
use App\Models\AdminSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{

    public function installer()
    {
        return view("installer");
    }
    public function saveEnvData(Request $request)
    {
        $data['DB_HOST'] = $request->db_host;
        $data['DB_DATABASE'] = $request->db_name;
        $data['DB_USERNAME'] = $request->db_user;
        $data['DB_PASSWORD'] = $request->db_pass;

        $envFile = app()->environmentFilePath();
        if ($envFile) {
            $str = file_get_contents($envFile);
            if (count($data) > 0) {
                foreach ($data as $envKey => $envValue) {
                    $str .= "\n";
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                return response()->json(['data' => null, 'success' => false], 200);
            }
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            return response()->json(['data' => null, 'success' => true], 200);
        }
    }

    public function saveAdminData(Request $request)
    {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        $setting['license_status'] = 1;
        $setting['license_key'] = $request->license_code;
        $setting['license_name'] = $request->client_name;
        AdminSetting::find(44)->update(['value' => $request->license_code]);
        AdminSetting::find(43)->update(['value' => $request->client_name]);
        AdminSetting::find(42)->update(['value' => 1]);

        $u = User::find(1);
        $u->email = $request->email;
        $u->password = $request->password;
        $u->save();


        return response()->json(['data' => url('admin/login'), 'success' => true], 200);
    }

    public function activeLicence(Request $request)
    {
        $api = new LicenseBoxAPI();

        $result =  $api->activate_license($request->license_code, $request->name);
        if ($result['status'] === true) {
            AdminSetting::find(44)->update(['value' => $request->license_code]);
            AdminSetting::find(43)->update(['value' => $request->name]);
            AdminSetting::find(42)->update(['value' => 1]);
            return redirect('/')->withStatus("License is active");
        }
        return back()->withStatus($result['message']);
    }
    public function activeLicenceGet()
    {
        return view("license.active");
    }

    public function adminLogin(Request $request)
    {

        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if (Auth::attempt($userdata)) {
            $api = new LicenseBoxAPI();
            $res = $api->verify_license();

            if ($res['status'] !== true) {
                AdminSetting::find(24)->update(['value' => 0]);
                return redirect('admin/home');
            } else {
                AdminSetting::find(24)->update(['value' => 1]);
                return redirect('admin/home');
            }
        } else {
            return Redirect::back()->with('error_msg', 'Invalid Username or Password');
        }
    }
}
