<?php

    namespace App\Repositories\NewsRepository;
    use App\Models\News;
    use App\Repositories\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of News Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceNewsRepository to register the rules
 *********************************************************************************/

    class NewsRepository extends BaseRepository implements InterfaceNewsRepository {

        /***********************
         * @var News $model
         ***********************/
        protected News $model;

        /*************************
         * @param News $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(News $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function search($searchText){
            return $this->query()->
            orWhere("title","like","%{$searchText}%")->
            orWhere("summary","like","%{$searchText}%")->
            orWhere("description","like","%{$searchText}%")->
            orWhere("published_at","like","%{$searchText}%")->
            orWhereHas("category",function ($query) use($searchText){
                $query->where("name","like","%{$searchText}%");
            })->orderBy("id","desc");
        }
    }

?>
