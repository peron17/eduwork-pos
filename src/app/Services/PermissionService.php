<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionService extends BaseService
{
    public function create(array $data, Model $model): array
    {
        try {
            $data['name'] = strtolower(str_replace(" ", "-", $data['name']));
            $model::create($data);
        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }

    public function update(array $data, Model $model): array
    {
        try {
            foreach ($data as $key => $value) {
                if ($key == 'name') {
                    $value = strtolower(str_replace(" ", "-", $value));
                }
                $model->$key = $value;
            }
            $model->save();
        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }

    public static function groupListing(User $user = null): array
    {
        $list = [];

        $permissions = Permission::orderBy('id')->pluck('name');
        
        $allowed = [];
        if ($user) {
            $allowed = $user->getPermissionNames()->toArray();
        }
        
        foreach ($permissions as $value) {
            $explode = explode('.', $value);
            $group = ucwords($explode[0]);
            array_shift($explode);
            $name = ucwords(implode(' ', str_replace('-', ' ', $explode)));

            $checked = in_array($value, $allowed);

            if (!array_key_exists($group, $list)) {
                $list[$group] = [
                    $value => [
                        'name' => $name,
                        'checked' => $checked
                    ]
                ];
            } else {
                $list[$group][$value] = [
                    'name' => $name,
                    'checked' => $checked
                ];
            }
        }

        return $list;
    }
}