<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleService extends BaseService
{
    public const SUPER_ADMIN = 'Super Admin';

    final public const GUARDS = [
        'web',
    ];

    public function create(array $data, Model $model): array
    {
        DB::beginTransaction();
        try {
            // create role
            $role = $model::create(['name' => $data['name']]);
            // assign permission
            foreach ($data['permission'] as $permission) {
                $permissionObj = Permission::find($permission);
                $role->givePermissionTo($permissionObj);
            }
        } catch (\Exception $th) {
            DB::rollBack();
            $this->status = false;
            $this->error = $th->getMessage();
        }
        DB::commit();

        return $this->response();
    }

    public function update(array $data, Model $model): array
    {
        DB::beginTransaction();
        try {
            // update role
            $model->name = $data['name'];
            $model->save();
            // get permission of role
            $ownedPermission = $model->permissions->pluck('id');
            // delete current permission
            foreach ($ownedPermission as $owned) {
                $permissionObj = Permission::find($owned);
                $model->revokePermissionTo($permissionObj);
            }
            // add new permission
            foreach ($data['permission'] as $value) {
                $permissionObj = Permission::find($value);
                $model->givePermissionTo($permissionObj);
            }
        } catch (\Exception $th) {
            DB::rollBack();
            $this->status = false;
            $this->error = $th->getMessage();
        }
        DB::commit();

        return $this->response();
    }

    public function destroy(Model $model): array
    {
        try {
            if ($model->name == self::SUPER_ADMIN) {
                $this->status = false;
                $this->error = "Role " . self::SUPER_ADMIN . " tidak boleh dihapus";
            } else
                $model->delete();
        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }
}