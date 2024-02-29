<?php

    namespace App\Repositories\VisitRepository;
    use App\Models\Visit;
    use App\Repositories\BaseRepository;
    use Illuminate\Support\Carbon;

/**********************************************************************************
 *  It's a class for repository of Province Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceProvinceRepository to register the rules
 *********************************************************************************/

    class VisitRepository extends BaseRepository implements InterfaceVisitRepository {

        /***********************
         * @var Visit $model
         ***********************/
        protected Visit $model;

        /*************************
         * @param Visit $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Visit $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function todayVisits(){
            $minDate=Carbon::now()->toDateString()." 00:00:00";
            $maxDate=Carbon::now()->toDateString()." 23:59:59";
            return $this->query()->where("created_at",">=",$minDate)->where("created_at","<=",$maxDate)->orderBy("id","desc");
        }
    }

?>
