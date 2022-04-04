<?php

namespace NonEfTech\BookCrossing\Controller;

use NonEfTech\BookCrossing\Exception\RuntimeException;

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
        $response = null;
        $context = [];
        if ('POST' === $serverRequest->getMethod()) {
            $authData = $serverRequest->request->all();
//            $this->validateAuthData($authData);

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
            $response= $this->render('login.twig', $context);
        }
        return $response;
    }

//    /**
//     * Логика валидации
//     *
//     * @param array $authData
//     */
//    private function validateAuthData(array $authData): void
//    {
//        if (false === array_key_exists('login', $authData)) {
//            throw new RuntimeException('Отсутсвует логин');
//        }
//        if (false === is_string($authData['login'])) {
//            throw new RuntimeException('неправильный тип логина');
//        }
//
//        if (false === array_key_exists('password', $authData)) {
//            throw new RuntimeException('Отсутсвует пароль');
//        }
//        if (false === is_string($authData['password'])) {
//            throw new RuntimeException('неправильный тип пароля');
//        }
//    }

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
