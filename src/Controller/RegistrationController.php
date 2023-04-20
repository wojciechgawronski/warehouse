<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/dashboard/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            throw new AccessDeniedException('403 Fobridden', 403);
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $role = $form->get('Roles')->getData();
            $allowedRoles = ['ROLE_USER'];

            if (!$this->_isInArray($allowedRoles, $role)) {
                // @TODO handle form validation:
                dd('User role no allowed');
            }

            $user->setRoles($role); 

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $route = $request->headers->get('referer');
            return $this->redirect($route);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    private function _isInArray(array $haystack, string|array $nedlle): bool
    {
        if (is_string($nedlle)) {
            if (in_array($nedlle, $haystack)) {
                return true;
            }
            return false;
        }
    
        if (is_array($nedlle)) {
            foreach ($nedlle as $str) {
                if (in_array($str, $haystack)) {
                    return true;
                }
            }
            return false;
        }
    }
}
