<?php

    namespace App\Repositories\CommentRepository;
    use App\Models\Comment;
    use App\Repositories\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCommentRepository to register the rules
 *********************************************************************************/

    class CommentRepository extends BaseRepository implements InterfaceCommentRepository{

        /***********************
         * @var Comment $model
         ***********************/
        protected Comment $model;

        /*************************
         * @param Comment $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Comment $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
