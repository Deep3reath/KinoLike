<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $name
 * @property string|null $username
 * @property string|null $password
 * @property string|null $avatar
 * @property int|null $id_role
 *
 * @property Comments[] $comments
 * @property Favorites[] $favorites
 * @property Rating[] $ratings
 * @property Roles $role
 * @property Viewed[] $viewed
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @var mixed|null
     */
    private static $users;
    /**
     * @var mixed|null
     */
    private $auth_key;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'username', 'password'], 'required'],
//            [['avatar'], 'string', 'max' => 60],
            [['username', 'email'], 'unique'],
            [['name'], 'match', 'pattern' => '/^[а-яА-ЯёЁ ]+$/u'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => ['jpg', 'png', 'jpeg']],
            [['email'], 'email'],
            [['username'], 'string','max' => 31],
            [['password'], 'string', 'max' => 63],
            [['id_role'], 'default', 'value' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Почта',
            'name' => 'Имя',
            'username' => 'Логин',
            'password' => 'Пароль',
            'avatar' => 'Аватар',
            'id_role' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['id_user' => 'id']);
    }

    public function beforeSave($insert)
    {
        #$this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'id_role']);
    }

    /**
     * Gets query for [[Viewed]].
     *
     * @return ActiveQuery
     */
    public function getViewed()
    {
        return $this->hasMany(Viewed::className(), ['id_user' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @param null $type
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function getRolesList($id_user = null)
    {
        $model = new Roles();
        return !empty($id_user) ?
            $model->find()
            ->join('JOIN', 'user', 'roles.id = id_role')
            ->where(['user.id' => $id_user])
            ->one() :
            $model->find()
            ->join('JOIN', 'user')
            ->all() ;
    }

    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
