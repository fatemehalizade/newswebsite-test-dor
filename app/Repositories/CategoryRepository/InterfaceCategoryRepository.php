<?php

    namespace App\Repositories\CategoryRepository;
    use App\Repositories\InterfaceBaseRepository;

    interface InterfaceCategoryRepository extends InterfaceBaseRepository{
        public function getParentCategories();
        public function deleteTotal($idsList);
    }

?>
