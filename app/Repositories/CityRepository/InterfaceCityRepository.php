<?php

    namespace App\Repositories\CityRepository;
    use App\Repositories\InterfaceBaseRepository;

    interface InterfaceCityRepository extends InterfaceBaseRepository {
        public function getByProvinceId($provinceId);
    }

?>
