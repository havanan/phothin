<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AbstractFilter
{
    protected $request;
    protected $filters = [];
    protected $builder;
    protected $select = ["*"];

    /**
     * __construct
     *
     * @param  Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * filter
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            $filterBuilder = $this->resolveFilter($filter);

            if ($filterBuilder === true) {
                $params = array_values([$value]);
                call_user_func_array([$this, $filter],$params);
                continue;
            }

            $this->resolveFilter($filter)->filter($builder, $value);
        }
        $this->builder->select($this->select);
        $this->joins();
        $this->orders();
        $this->afterFilter();
        return $builder;
    }

    /**
     * joins
     *
     * @return Builder
     */
    public function joins()
    {
        return $this->builder;
    }

    /**
     * orders
     *
     * @return void
     */
    public function orders()
    {
        $model = $this->builder->getModel();
        $tableFieldList = $model->getTableColumns();
        $orderBy = $this->request->order_by ?? 'id';
        $sort = $this->request->sort ?? 'asc';
        $sort = $sort && in_array($sort, ['asc', 'desc']) ? $sort : 'asc';
        if ($orderBy && in_array($orderBy, $tableFieldList)) {
            $this->builder->orderBy($model->getTableName() . $orderBy, $sort);
        }
    }

    /**
     * afterFilter
     *
     * @return Builder
     */
    public function afterFilter()
    {
        // Do something after filter
        return $this->builder;
    }
    /**
     * getFilters
     */
    protected function getFilters()
    {
        $filterable = [];
        foreach ($this->filters as $key => $value) {
            if (is_int($key)) {
                $filterable[] = $value;
                continue;
            }
            $filterable[] = $key;
        }
        return $this->request->only($filterable);
    }

    /**
     * getQuery
     */
    protected function getQuery($key)
    {
        return $this->request->get($key);
    }

    /**
     * resolveFilter
     *
     * @param  mixed $filter
     * @return Filter
     */
    protected function resolveFilter($filter)
    {
        if (isset($this->filters[$filter])) {
            return new $this->filters[$filter];
        }
        return method_exists($this, $filter);
    }

    /**
     * hasJoin
     *
     * @param  Builder $builder
     * @param  mixed $table
     * @return void
     */
    public function hasJoin(Builder $builder, $table)
    {
        if (!$builder->getQuery()->joins) {
            return false;
        }
        foreach ($builder->getQuery()->joins as $joinClause) {
            if ($joinClause->table == $table) {
                return true;
            }
        }
        return false;
    }

    /**
     * getPerPage
     *
     * @return void
     */
    public function getPerPage(): int
    {
        $perPage = (int) $this->request->get('per_page');
        return $perPage <= LIMIT_PER_PAGE && $perPage > 0 ? $perPage : DEFAULT_PER_PAGE;
    }
}
