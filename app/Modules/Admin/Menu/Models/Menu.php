<?php

namespace App\Modules\Admin\Menu\Models;

use App\Modules\Admin\Role\Models\Permission;
use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static frontMenu(\Illuminate\Contracts\Auth\Authenticatable|null $user)
 * @method static menuByType()
 */
class Menu extends Model
{
  use HasFactory;

  const MENU_TYPE_FRONT = "front";
  const MENU_TYPE_ADMIN = "admin";

  public function perms()
  {
    return $this->belongsToMany(Permission::class, 'permission_menu');
  }


  /**
   * @param \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeFrontMenu($query, User $user): \Illuminate\Database\Eloquent\Builder
  {
    return $query->where('type', self::MENU_TYPE_FRONT)
      ->whereHas('perms', function ($q) use ($user) {
        $arr = collect($user->getMergedPermissions())
          ->map(function ($item) {
            return $item['id'];
          });
        $q->whereIn('id', $arr->toArray());
      });
  }

  /**
   * @param \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeMenuByType($query, $type)
  {
    return $query->where('type', $type)
      ->orderBy('parent')
      ->orderBy('sort_order');
  }

}
