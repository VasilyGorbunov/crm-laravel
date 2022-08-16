<?php


namespace App\Modules\Admin\Role\Services;


use App\Modules\Admin\Role\Requests\RoleRequest;
use Illuminate\Database\Eloquent\Model;

class RoleService
{
    /**
     * @param RoleRequest $request
     * @param Model $model
     * @return bool
     */
    public function save(RoleRequest $request, Model $model): bool
    {
        $model->fill($request->only($model->getFillable()));
        $model->save();
        return true;
    }
}
