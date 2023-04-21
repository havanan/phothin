<?php

namespace Modules\Admin\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class UserTransformers extends TransformerAbstract
{
    /**
     * transform
     *
     * @param  User $entity
     * @return array
     */
    public function transform(User $entity)
    {
        return [
            'id' => $entity->id,
            'name' => $entity->name,
            'email' => $entity->email,
            'phone' => $entity->phone,
            'status' => $entity->status,
            'avatar' => $entity->avatar,
            'gender' => $entity->gender,
            'birthday' => $entity->birthday,
            'about_me' => $entity->about_me,
            'jp_name' => $entity->jp_name,
            'jp_level' => $entity->jp_level,
            'is_notifiable' => $entity->is_notifiable,
            'is_notifiable_updated_at' => $entity->is_notifiable_updated_at,
            'last_active' => $entity->last_active,
            'point' => $entity->point,
            'is_free_trial' => $entity->is_free_trial,
            'phone_verified_at' => Carbon::parse($entity->phone_verified_at)->format('Y-m-d H:i:s'),
            'email_verified_at' => Carbon::parse($entity->email_verified_at)->format('Y-m-d H:i:s'),
            'created_at' => Carbon::parse($entity->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($entity->updated_at)->format('Y-m-d H:i:s'),
            'deleted_at' =>  $entity->deleted_at ? Carbon::parse($entity->deleted_at)->format('Y-m-d H:i:s') : null
        ];
    }
}
