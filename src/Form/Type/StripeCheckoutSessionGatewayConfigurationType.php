<?php

declare(strict_types=1);

namespace FluxSE\SyliusPayumStripePlugin\Form\Type;

use Sylius\Bundle\PayumBundle\Form\Type\StripeGatewayConfigurationType as BaseStripeGatewayConfigurationType;
use FluxSE\SyliusPayumStripePlugin\PaymentMethodTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class StripeCheckoutSessionGatewayConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('webhook_secret_keys', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'label' => 'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.webhook_secret_keys',
                'constraints' => [
                    new NotBlank([
                        'message' => 'flux_se_sylius_payum_stripe_plugin.stripe.webhook_secret_keys.not_blank',
                        'groups' => 'sylius',
                    ]),
                ],
            ])
            ->add('payment_method_types', ChoiceType::class, [
                'label' => 'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_type',
                'constraints' => [
                    new NotBlank([
                        'groups' => 'sylius',
                    ]),
                ],
                'multiple' => true,
                'choices' => [
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.card' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_CARD,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.bancontact' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_BANCONTACT,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.blik' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_BLIK,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.eps' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_EPS,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.fpx' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_FPX,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.giropay' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_GIROPAY,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.ideal' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_IDEAL,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.przelewy24' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_PRZELEWY24,
                    'flux_se_sylius_payum_stripe_plugin.form.gateway_configuration.stripe.payment_method_types.sofort' => PaymentMethodTypes::PAYMENT_METHOD_TYPE_SOFORT,
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return BaseStripeGatewayConfigurationType::class;
    }
}
