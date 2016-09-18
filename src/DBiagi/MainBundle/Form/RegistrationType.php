<?php

namespace DBiagi\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FormType;

class RegistrationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('email', FormType\EmailType::class, [
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('firstname', FormType\TextType::class, [
                'label' => 'form.firstname',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('lastname', FormType\TextType::class, [
                'label' => 'form.lastname',
                'translation_domain' => 'FOSUserBundle'
            ])
            ->add('plainPassword', FormType\RepeatedType::class, [
                'options' => ['translation_domain' => 'FOSUserBundle'],
                'first_options' => [
                    'label' => 'form.password',
                ],
                'second_options' => [
                    'label' => 'form.password_confirmation',
                ],
                'invalid_message' => 'fos_user.password.mismatch',
                'type' => FormType\PasswordType::class
            ])
            ->add('submit', FormType\SubmitType::class, [
                'label' => 'form.submit',
                'translation_domain' => 'FOSUserBundle',
                'attr' => [
                    'class' => 'btn bg_az'
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'DBiagi\MainBundle\Entity\User',
            'csrf_token_id' => 'registration',
        ]);
    }

    public function getBlockPrefix() {
        return 'app_user_registration';
    }

}
