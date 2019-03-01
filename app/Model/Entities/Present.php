<?php

namespace App\Model\Entities;

use App\Model\Base\ModelSoftDelete;

class Present extends ModelSoftDelete
{
    use \App\Model\Presenters\Present;
    use \App\Model\Scopes\PresentScope;

    protected $table = 'presents';
    protected $urlAttributes = ['image'];

    protected static $_destroyRelations = ['applications'];

    public function applications()
    {
        return $this->hasMany(Application::class, 'present_id', 'id');
    }
}
