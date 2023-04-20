<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Scopes\CommonScope;

class BaseModel extends Model
{
    use CommonScope;

    /**
     * getTableName
     *
     * @return String
     */
    public function getTableName()
    {
        return $this->getTable() . '.';
    }

    /**
     * getTableColumns
     *
     * @return void
     */
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
