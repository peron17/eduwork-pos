<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function create(array $data, Model $model): bool
    {
        $status = true;

        try {
            $model::create($data);
        } catch (\Exception $th) {
            $status = false;
        }

        return $status;
    }

    public function update(array $data, Model $model): bool
    {
        $status = true;

        try {
            foreach ($data as $key => $value) {
                $model->$key = $value;
            }
            $model->save();
        } catch (\Exception $th) {
            $status = false;
        }

        return $status;
    }
}