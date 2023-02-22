<?php
namespace App\Services;

use App\Mail\RegisterMail;
use App\Models\User;
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
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'remember_token' => Str::random(10),
            ]);

            if ($data['role'] != null) 
                $user->assignRole($data['role']);
            
            if (count($data['permissions']) > 0) {
                foreach ($data['permissions'] as $key => $value) {
                    $user->givePermissionTo($value);
                }
            }

        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }

    public function updateUser(array $data, User $user)
    {
        try {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->is_active = $data['status'];
            if ($data['password'] != null) {
                $user->password = Hash::make($data['password']);
            }
            $user->save();

            $user->syncRoles([$data['role']]);

            $user->syncPermissions($data['permissions']);

        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }
}