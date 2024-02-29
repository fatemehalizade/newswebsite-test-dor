<?php

    namespace App\Repositories\CityRepository;
    use App\Models\City;
    use App\Repositories\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of Province Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceProvinceRepository to register the rules
 *********************************************************************************/

    class CityRepository extends BaseRepository implements InterfaceCityRepository {

        /***********************
         * @var City $model
         ***********************/
        protected City $model;

        /*************************
         * @param City $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(City $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function getByProvinceId($provinceId)
        {
            return $this->query()->where("province_id",$provinceId);
        }

    }

?>
