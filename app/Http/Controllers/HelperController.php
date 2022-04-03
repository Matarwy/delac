<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class HelperController extends Controller
{
    //
    public function twillioMsg($ph, $message)
    {
        try {
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_AUTH_TOKEN");
            $twilio_number = env("TWILIO_NUMBER");
        } catch (\Exception $e) {
        }
    }
    public function uploadfile($file, $path)
    {
        $name = uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/' . $path);
        $file->move($destinationPath, $name);
        return $path . '/' . $name;
    }
    public function deleteImage($fileName)
    {
        if ($fileName == "default.png") {
            return false;
        }
        $filePath = public_path() . '/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
