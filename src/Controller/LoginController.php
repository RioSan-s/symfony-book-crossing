<?php

namespace NonEfTech\BookCrossing\Controller;

use NonEfTech\BookCrossing\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Контроллер реализующий логику обработки запроса добавление логина
 */
class LoginController extends AbstractController
{

    /**
     * @param Request $serverRequest
     *
     * @return Response
     */
    public function __invoke(Request $serverRequest, AuthenticationUtils $utils): Response
    {
        $errs = $utils->getLastAuthenticationError();
        $formLogin = $this->createForm(LoginForm::class);
        $formLogin->setData([
            'login'=>$utils->getLastUsername()
                            ]);
        $context =
            [
                'form_login' => $formLogin,
                'errors'     => $errs,
            ];
        return $this->renderForm('login.twig', $context);
    }


}
