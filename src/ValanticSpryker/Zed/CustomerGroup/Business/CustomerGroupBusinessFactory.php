<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerGroup\Business;

use Spryker\Zed\CustomerGroup\Business\CustomerGroupBusinessFactory as SprykerCustomerGroupBusinessFactory;
use Spryker\Zed\CustomerGroup\Business\Model\CustomerGroupInterface;
use ValanticSpryker\Zed\CustomerGroup\Business\Model\CustomerGroup;
use ValanticSpryker\Zed\CustomerGroup\CustomerGroupDependencyProvider;

/**
 * @method \Spryker\Zed\CustomerGroup\Persistence\CustomerGroupRepositoryInterface getRepository()
 * @method \Spryker\Zed\CustomerGroup\Persistence\CustomerGroupQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\CustomerGroup\CustomerGroupConfig getConfig()
 */
class CustomerGroupBusinessFactory extends SprykerCustomerGroupBusinessFactory
{
    /**
     * @return \Spryker\Zed\CustomerGroup\Business\Model\CustomerGroupInterface
     */
    public function createCustomerGroup(): CustomerGroupInterface
    {
        return new CustomerGroup(
            $this->getQueryContainer(),
            $this->getCustomerGroupDeleteEventPlugins(),
        );
    }

    /**
     * @return array<\ValanticSpryker\Zed\CustomerGroup\Dependency\Plugin\CustomerGroupDeleteEventPluginInterface>
     */
    public function getCustomerGroupDeleteEventPlugins(): array
    {
        return $this->getProvidedDependency(CustomerGroupDependencyProvider::PLUGINS_CUSTOMER_GROUP_DELETE);
    }
}
