<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

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
}