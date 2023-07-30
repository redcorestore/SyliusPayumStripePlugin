<?php

declare(strict_types=1);

namespace FluxSE\SyliusPayumStripePlugin;

interface PaymentMethodTypes
{
    public const PAYMENT_METHOD_TYPE_CARD = 'card';

    public const PAYMENT_METHOD_TYPE_BANCONTACT = 'bancontact';

    public const PAYMENT_METHOD_TYPE_BLIK = 'blik';

    public const PAYMENT_METHOD_TYPE_EPS = 'eps';

    public const PAYMENT_METHOD_TYPE_FPX = 'fpx';

    public const PAYMENT_METHOD_TYPE_GIROPAY = 'giropay';

    public const PAYMENT_METHOD_TYPE_IDEAL = 'ideal';

    public const PAYMENT_METHOD_TYPE_PRZELEWY24 = 'p24';

    public const PAYMENT_METHOD_TYPE_SOFORT = 'sofort';
}
