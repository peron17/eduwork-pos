<?php
namespace App\Services;

use App\Models\Unit;

class UnitService
{
    public function create(array $data): bool
    {
        $status = true;

        try {
            Unit::create($data);
        } catch (\Exception $th) {
            $status = false;
        }

        return $status;
    }

    public function update(array $data, Unit $unit): bool
    {
        $status = true;

        try {
            foreach ($data as $key => $value) {
                $unit->$key = $value;
            }
            $unit->save();
        } catch (\Exception $th) {
            $status = false;
        }

        return $status;
    }
}