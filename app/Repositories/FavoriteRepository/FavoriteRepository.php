<?php

    namespace App\Repositories\FavoriteRepository;
    use App\Enums\BoolStatus;
    use App\Models\Favorite;
    use App\Repositories\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of Province Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceFavoriteRepositoryto register the rules
 *********************************************************************************/

    class FavoriteRepository extends BaseRepository implements InterfaceFavoriteRepository {

        /***********************
         * @var Favorite $model
         ***********************/
        protected Favorite $model;

        /*************************
         * @param Favorite $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Favorite $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function getUserFavorites($userId){
            return $this->query()->where("user_id",$userId)->where("is_active",BoolStatus::yes);
        }

        public function checkUserFavorite($newsId,$userId){
            return $this->query()->where("user_id",$userId)->where("news_id",$newsId);
        }

    }

?>
