<?php
namespace app\commands;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "write" для юзера писать пост
        $writePost = $auth->createPermission('writePost');
        $writePost->description = 'Write a post';
        $auth->add($writePost);

        // добавляем разрешение "editPost" редактировать пост для админа
        $editPost = $auth->createPermission('editPost');
        $editPost->description = 'Edit post';
        $auth->add($editPost);

        // добавляем разрешение "editUser" редактировать роль юзера для админа
        $editUser = $auth->createPermission('editUser');
        $editUser->description = 'Edit user';
        $auth->add($editUser);

        // добавляем роль "user" и даём роли разрешение "writePost"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $writePost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $editPost);
        $auth->addChild($admin, $editUser);
        $auth->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }
}