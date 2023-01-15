<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class BaseService
{
    protected bool $status = true;

    protected string $error = '';

    public function create(array $data, Model $model): array
    {
        try {
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
                $model->$key = $value;
            }
            $model->save();
        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }

    public function destroy(Model $model): array
    {
        try {
            $model->delete();
        } catch (\Exception $th) {
            $this->status = false;
            $this->error = $th->getMessage();
        }

        return $this->response();
    }

    protected function response(): array
    {
        return [
            'status' => $this->status,
            'error' => $this->error
        ];
    }
}