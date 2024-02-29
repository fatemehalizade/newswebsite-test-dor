<?php

    namespace App\Repositories\ActivityLogRepository;
    use App\Repositories\BaseRepository;
    use Spatie\Activitylog\Models\Activity;

/**********************************************************************************
 *  It's a class for repository of Activity Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceActivityLogRepository to register the rules
 *********************************************************************************/

    class ActivityLogRepository extends BaseRepository implements InterfaceActivityLogRepository {

        /***********************
         * @var Activity $model
         ***********************/
        protected Activity $model;

        /*************************
         * @param Activity $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Activity $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
