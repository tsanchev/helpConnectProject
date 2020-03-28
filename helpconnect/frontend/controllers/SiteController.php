<?php
namespace frontend\controllers;

use backend\modules\giver\models\Giver;
use backend\modules\giver\models\GiverSearch;
use backend\modules\offer\models\Offer;
use backend\modules\request\models\Request;
use backend\modules\seeker\models\Seeker;
use backend\modules\seeker\models\SeekerSearch;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays seeker page.
     *
     * @return mixed
     */
    public function actionSeekHelp()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $seeker = Seeker::findOne(['user_id' => Yii::$app->user->id]);
        if(!$seeker) {
            $seeker = new Seeker();
            $seeker->user_id = Yii::$app->user->id;

            $giver = Giver::findOne(['user_id' => Yii::$app->user->id]);
            if($giver){
                $seeker->name = $giver->name;
                $seeker->phone = $giver->phone;
            }
        }
        if ($seeker->load(Yii::$app->request->post()) && $seeker->save()) {
            Yii::$app->session->addFlash('success', "Записът е успешен!");
            $this->refresh();
        }

        $request = new Request();
        $request->seeker_id = $seeker->seeker_id;
        if ($request->load(Yii::$app->request->post()) && $request->save()) {
            Yii::$app->session->addFlash('success', "Записът е успешен!");
            $this->refresh();
        }

        $seekerRequestsDataProvider = null;
        if( $seeker->seeker_id != 0) {
            $seekerRequestsDataProvider = new ActiveDataProvider([
                'query' => Request::find()->andWhere(['seeker_id' => $seeker->seeker_id]),
                'sort' => [
                    'attributes' => ['request_id',],
                    'defaultOrder' => ['request_id' => SORT_DESC,],
                ]
            ]);
        }

        return $this->render('seekHelp', [
            'seeker' => $seeker,
            'request' => $request,
            'seekerRequestsDataProvider' => $seekerRequestsDataProvider,
        ]);
    }

    /**
     * Displays giver page.
     *
     * @return mixed
     */
    public function actionGiveHelp()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $giver = Giver::findOne(['user_id' => Yii::$app->user->id]);
        if(!$giver) {
            $giver = new Giver();
            $giver->user_id = Yii::$app->user->id;

            $seeker = Seeker::findOne(['user_id' => Yii::$app->user->id]);
            if($seeker){
                $giver->name = $seeker->name;
                $giver->phone = $seeker->phone;
            }
        }
        if ($giver->load(Yii::$app->request->post()) && $giver->save()) {
            Yii::$app->session->addFlash('success', "Записът е успешен!");
            $this->refresh();
        }

        $offer = new Offer();
        $offer->giver_id = $giver->giver_id;
        if ($offer->load(Yii::$app->request->post()) && $offer->save()) {
            Yii::$app->session->addFlash('success', "Записът е успешен!");
            $this->refresh();
        }

        $giverOffersDataProvider = null;
        if( $giver->giver_id != 0) {
            $giverOffersDataProvider = new ActiveDataProvider([
                'query' => Offer::find()->andWhere(['giver_id' => $giver->giver_id]),
                'sort' => [
                    'attributes' => ['offer_id',],
                    'defaultOrder' => ['offer_id' => SORT_DESC,],
                ]
            ]);
        }


        return $this->render('giveHelp', [
            'giver' => $giver,
            'offer' => $offer,
            'giverOffersDataProvider' => $giverOffersDataProvider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Благодаря, че се свързахте с нас. Ние ще ви отговорим възможно най-скоро.');
            } else {
                Yii::$app->session->setFlash('error', 'При изпращането на съобщението ви възникна грешка.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Благодаря ви за регистрацията. Моля, проверете входящата си поща за имейл за потвърждение.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверете имейла си за допълнителни инструкции.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'За съжаление не можем да зададем нова парола за предоставения имейл адрес.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Запазена е нова парола.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Вашият имейл е потвърден!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'За съжаление не можем да потвърдим вашия акаунт с предоставен токен.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверете имейла си за допълнителни инструкции.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'За съжаление не можем да изпратим отново имейл за потвърждение за предоставения имейл адрес.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
