<?php

    namespace App\Repositories\FavoriteRepository;
    use App\Repositories\InterfaceBaseRepository;

    interface InterfaceFavoriteRepository extends InterfaceBaseRepository {
        public function getUserFavorites($userId);
        public function checkUserFavorite($userId,$newsId);
    }

?>
