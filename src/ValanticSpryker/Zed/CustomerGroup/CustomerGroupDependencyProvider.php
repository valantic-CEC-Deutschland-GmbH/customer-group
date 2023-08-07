<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerGroup;

use Spryker\Zed\CustomerGroup\CustomerGroupDependencyProvider as SprykerCustomerGroupDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerGroupDependencyProvider extends SprykerCustomerGroupDependencyProvider
{
    public const FACADE_LOCALE = 'FACADE_LOCALE';
    public const PLUGINS_CUSTOMER_GROUP_DELETE = 'PLUGINS_CUSTOMER_GROUP_DELETE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $this->addCustomerGroupDeletePlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addCustomerGroupDeletePlugins(Container $container): void
    {
        $container->set(static::PLUGINS_CUSTOMER_GROUP_DELETE, function () {
            return $this->getCustomerGroupDeletePlugins();
        });
    }

    /**
     * @return array<\ValanticSpryker\Zed\CustomerGroup\Dependency\Plugin\CustomerGroupDeleteEventPluginInterface>
     */
    protected function getCustomerGroupDeletePlugins(): array
    {
        return [ ];
    }
}
