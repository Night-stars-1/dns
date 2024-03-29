<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2019/4/14
 * Time: 16:34
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder|static whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|static create(array $attributes)
 */
class UserPointRecord extends Model
{
    protected $guarded = ['id'];
    const UPDATED_AT = null;


    public function scopeSearch($query, $guard = 'web')
    {
        if ($guard === 'admin') {
            $uid = intval(request()->post('uid'));
            if ($uid) $query->where('uid', $uid);
        }
        $action = request()->post('act');
        if ($action == 'increase') {
            $query->where('point', '>', 0);
        } elseif ($action == 'reduce') {
            $query->where('point', '<', 0);
        } elseif ($action != 'all') {
            $query->where('action', $action);
        }
    }
}
