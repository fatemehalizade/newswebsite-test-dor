<?php

    namespace App\Repositories\UserRepository;
    use App\Repositories\InterfaceBaseRepository;

    interface InterfaceUserRepository extends InterfaceBaseRepository {

        public function getUsersByRole($role);
        public function search($searchText,$role);
    }

?>
