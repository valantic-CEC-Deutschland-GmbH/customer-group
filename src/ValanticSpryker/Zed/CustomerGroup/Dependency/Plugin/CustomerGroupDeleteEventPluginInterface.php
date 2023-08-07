<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerGroup\Dependency\Plugin;

use Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer;

interface CustomerGroupDeleteEventPluginInterface
{
    /**
     * @param \Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer $customerGroupToCustomer
     *
     * @return void
     */
    public function raiseEvent(SpyCustomerGroupToCustomer $customerGroupToCustomer): void;
}
