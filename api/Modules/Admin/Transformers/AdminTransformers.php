<?php

namespace Modules\Admin\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Admin;
use Carbon\Carbon;

class AdminTransformers extends TransformerAbstract
{
    /**
     * transform
     *
     * @param  Admin $entity
     * @return Array
     */
    public function transform(Admin $entity)
    {
        return [
            'id' => $entity->id,
            'avatar' => $entity->avatar,
            'name' => $entity->name,
            'email' => $entity->email,
            'phone' => $entity->phone,
            'status' => $entity->status,
            'role_id' =>  $entity->role_id,
            'address' =>  $entity->address,
            'note' =>  $entity->note,
            'locations' =>  $entity->locations,
            'created_at' => Carbon::parse($entity->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($entity->updated_at)->format('Y-m-d H:i:s')
        ];
    }
}
