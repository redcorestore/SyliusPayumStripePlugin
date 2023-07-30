<?php

declare(strict_types=1);

namespace FluxSE\SyliusPayumStripePlugin\Action;

use FluxSE\SyliusPayumStripePlugin\Provider\DetailsProviderInterface;
use FluxSE\SyliusPayumStripePlugin\PaymentMethodTypes;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\Convert;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Webmozart\Assert\Assert;

final class ConvertPaymentAction implements ActionInterface
{
    /** @var DetailsProviderInterface */
    private $detailsProvider;

    public function __construct(DetailsProviderInterface $detailsProvider)
    {
        $this->detailsProvider = $detailsProvider;
    }

    /**
     * {@inheritdoc}
     *
     * @param Convert|mixed $request
     */
    public function execute($request): void
    {
        RequestNotSupportedException::assertSupports($this, $request);

        /** @var PaymentInterface $payment */
        $payment = $request->getSource();
        /** @var OrderInterface $order */
        $order = $payment->getOrder();

        $details = $this->detailsProvider->getDetails($order);
        $details['payment_method_types'] = $this->getPaymentMethodTypes();

        $request->setResult($details);
    }

    private function getPaymentMethodTypes(PaymentInterface $payment): array
    {
        $method = $payment->getMethod();
        Assert::notNull($method);

        $gatewayConfig = $method->getGatewayConfig();
        Assert::notNull($gatewayConfig);

        $paymentMethodTypes = $gatewayConfig->getConfig['payment_method_types'];
        if (empty($paymentMethodTypes)) {
            $paymentMethodTypes = [PaymentMethodTypes::PAYMENT_METHOD_TYPE_CARD];
        }

        return $paymentMethodTypes;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($request): bool
    {
        return
            $request instanceof Convert &&
            $request->getSource() instanceof PaymentInterface &&
            $request->getTo() === 'array'
        ;
    }
}
