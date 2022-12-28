<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class RoleService extends BaseService
{
    public const SUPER_ADMIN = 'Super Admin';

    final public const GUARDS = [
        'web',
    ];

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