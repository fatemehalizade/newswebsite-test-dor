<?php

    namespace App\Repositories\PermissionRepository;
    use App\Repositories\BaseRepository;
    use Spatie\Permission\Models\Permission;

/**********************************************************************************
 *  It's a class for repository of Permission Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfacePermissionRepository to register the rules
 *********************************************************************************/

    class PermissionRepository extends BaseRepository implements InterfacePermissionRepository {

        /***********************
         * @var Permission $model
         ***********************/
        protected Permission $model;

        /*************************
         * @param Permission $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Permission $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
