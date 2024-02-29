<?php

    namespace App\Repositories\VisitRepository;
    use App\Repositories\InterfaceBaseRepository;

    interface InterfaceVisitRepository extends InterfaceBaseRepository {
        public function todayVisits();
    }

?>
