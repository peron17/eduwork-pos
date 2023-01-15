<?php
namespace App\Services;

use App\Mail\RegisterMail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService extends BaseService
{
    public function create(array $data, Model $model): array
    {
        try {
            $body = $data;
            $data['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $data['remember_token'] = Str::random(10);
            $data['password'] = Hash::make($data['password']);

            if ($user = $model::create($data)) {
                // assign role
                $user->assignRole($data['role']);

                Mail::to($user->email)->send(new RegisterMail($body));
            }

        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }
}