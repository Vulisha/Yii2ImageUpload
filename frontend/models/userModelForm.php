<?php 
namespace frontend\models;

use Yii;
use yii\base\Model;

class userModelForm extends Model{
	public $name; 
	public $email;
	public $password;

	public function rules(){
		return [[['name','email','password'],'required'],
				['email','email'],
				['password','string','min'=>5]
		];


	}



}