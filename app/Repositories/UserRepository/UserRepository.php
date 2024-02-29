<?php

    namespace App\Repositories\UserRepository;
    use App\Models\User;
    use App\Repositories\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of Province Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceProvinceRepository to register the rules
 *********************************************************************************/

    class UserRepository extends BaseRepository implements InterfaceUserRepository {

        /***********************
         * @var User $model
         ***********************/
        protected User $model;

        /*************************
         * @param User $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(User $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function getUsersByRole($role){
            return $this->query()->role($role)->orderBy("id","desc");
        }

        public function search($searchText,$role){
            return $this->query()->role($role)->where(function ($query) use ($searchText){
                $query->orWhere("first_name","like","%{$searchText}%")->
                orWhere("last_name","like","%{$searchText}%")->
                orWhere("nationalcode","like","%{$searchText}%")->
                orWhere("mobile","like","%{$searchText}%")->
                orWhere("email","like","%{$searchText}%")->
                orWhere("username","like","%{$searchText}%")->
                orWhereHas("province",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orWhereHas("city",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orderBy("id","desc");
            });
        }
    }

?>
