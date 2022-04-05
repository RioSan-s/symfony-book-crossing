<?php

namespace NonEfTech\BookCrossing\Controller;


use NonEfTech\BookCrossing\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Контроллер реализующий логику обработки запроса добавление логина
 */
class LoginController extends AbstractController
{


    /**
     * @param Request $serverRequest
     * @return Response
     */
    public function __invoke(Request $serverRequest): Response
    {
        try {
            $response = $this->doLogin($serverRequest);
        } catch (Throwable $e) {
            $response = $this->buildErrorResponse($e);
        }
        return $response;
    }

    /**
     * Реализация процесса аутентификации
     *
     * @param Request $serverRequest
     *
     * @return Response
     */
    private function doLogin(Request $serverRequest): Response
    {
        $formLogin = $this->createForm(LoginForm::class);
        $formLogin->handleRequest($serverRequest);
        $response = null;
        $context =
            ['form_login' => $formLogin];


        if ($formLogin->isSubmitted() && $formLogin->isValid()) {
            $authData = $formLogin->getData();
            if ($this->isAuth($authData['login'], $authData['password'])) {
                $response =
                    $serverRequest->query->has('redirect')
                        ? $this->redirect($serverRequest->query->get('redirect'))
                        : $this->redirect('/');
            } else {
                $context['errMessage'] = 'Пользователь не найден';
            }
        }

        if (null === $response) {
            $response = $this->renderForm('login.twig', $context);
        }
        return $response;

    }

    /**
     * Проводит аутентификацию пользователя
     *
     * @param string $login    - логин пользователя
     * @param string $password - пароль пользователя
     *
     * @return bool
     */
    private function isAuth(string $login, string $password): bool
    {
        return true;
    }

    /**
     * Создает http ответ для ошибки
     *
     * @param Throwable $e
     *
     * @return Response
     */
    private function buildErrorResponse(Throwable $e): Response
    {
        $httpCode = 500;
        $context = [
            'errors' => [
                $e->getMessage(),
            ],
        ];
        $response = $this->render(
            'errors.twig',
            $context
        );
        $response->setStatusCode($httpCode);
        return $response;
    }
}
