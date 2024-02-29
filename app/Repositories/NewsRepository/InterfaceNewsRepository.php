<?php

    namespace App\Repositories\NewsRepository;
    use App\Repositories\InterfaceBaseRepository;

    interface InterfaceNewsRepository extends InterfaceBaseRepository {

        public function search($searchText);
    }

?>
