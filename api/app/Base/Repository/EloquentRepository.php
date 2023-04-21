<?php

namespace App\Base\Repository;

use Illuminate\Database\Eloquent\Model;

class EloquentRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    public function count()
    {
        return $this->model->count();
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    /**
     * getModel
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Create
     * @param array $attributes
     * @return bool|mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->model->findOrFail($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }
    /**
     * @param array $fields
     * @return mixed
     */
    public function deleteByFields(array $fields)
    {
        return $this->model->where($fields)->delete();
    }
    /**
     * deleteByIds
     *
     * @param mixed $ids
     * @return void
     */
    public function deleteByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $input
     * @return Model
     */
    public function findByField(array $input)
    {
        return $this->model->where($input)
            ->first();
    }

    /**
     * @param $params
     * @return Model
     */
    public function findFirst(array $params)
    {
        return $this->model->where($params)
            ->firstOrFail();
    }

    public function findByFields(array $input)
    {
        return $this->model->where($input)
            ->get();
    }

    /**
     * Name: updateOrCreate
     * @param $params
     * @return mixed
     */
    public function updateOrCreate($params)
    {
        return $this->model->updateOrCreate($params);
    }

    /**
     * @param array $field
     * @param array $input
     * @return mixed
     */
    public function updateByField(array $field, array $input)
    {
        return $this->model->where($field)
            ->update($input);
    }

    /**
     * _getAllWithKeyName
     *
     * @return Collection
     */
    public function _getAllWithKeyName()
    {
        return $this->model->pluck('name', 'id');
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function findWith(array $input, array $with)
    {
        return $this->model->where($input)->with($with)->get();
    }

    public function with(array $with)
    {
        return $this->model->with($with)->get();
    }

    public function withQuery(array $with)
    {
        return $this->model->with($with);
    }

    public function conditions(array $params)
    {
        return $this->model->where($params);
    }

    /**
     * getEmptyRecordPaginate
     *
     * @return Paginate
     */
    public function getEmptyRecordPaginate()
    {
        return $this->model->where(['id' => 0])
            ->paginate();
    }

    /**
     * Name: max
     * @param string $column
     * @return integer
     */
    public function max($column)
    {
        return $this->model->max($column);
    }
    /**
     * Name: maxByField
     * @param string $column
     * @param array $field
     * @return integer
     */
    public function maxByField(array $field, $column)
    {
        return $this->model->where($field)->max($column);
    }
    /**
     * Name: createOrUpdate
     * @param $params
     * @return mixed
     */
    public function createOrUpdate($params)
    {
        if (!empty($params['id'])) {
            $id = $params['id'];
            unset($params['id']);
            return $this->update($id, $params);
        }
        return $this->create($params);
    }
}
